<?php

namespace App\Imports;

use Exception;
use App\Events\UserProfileUpdated;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use SHOP\Admin\Library\StatusHelper;
use Maatwebsite\Excel\Concerns\WithStartRow;
use SHOP\CRM\Models\LogImportFile;

class ExcelImport implements ToCollection, WithBatchInserts, WithChunkReading, WithStartRow
{
    use Importable;
    protected $model;
    protected $headings;
    protected $table;
    protected $import_id;
    protected $file_path;
    protected $index = 0;
    protected $count_success = 0;
    protected $count_failure = 0;

    public function __construct($model, $columns, $import_id, $file_path) {
        $columns = explode(",", $columns);
        $this->model    = $model;
        $this->import_id = $import_id;
        $this->table    = call_user_func([new $model, 'getTable']);
        $this->headings  = StatusHelper::formatHeading($columns, $this->table);
        $this->createImportLog($file_path);

    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $query = [];
        foreach ($collection as $key => $row)
        {
            for( $i = 0; $i < count($this->headings); $i++) {
                if ($this->headings[$i] == 'dob') {
                    if (is_numeric ($row[$i])) {
                        $query[$this->headings[$i]] =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[$i])->format('Y-m-d');
                    } else {
                        $query[$this->headings[$i]] = $row[$i];
                    }
                } else {
                    $query[$this->headings[$i]] = $row[$i];
                }
            };

            try {
                //Format input data
                $data = StatusHelper::formatImportFields($query, $this->table);
                $phone = $data['query_user']['phone'];

                if (!empty($phone)) {
                    //Get exist user
                    $user = $this->model::where($data['condition'])->first();
                    if (!empty($user)) {
                        // Trigger UserUpdated Event
                        event(new UserProfileUpdated($user));

                        $this->model::where($data['condition'])
                                    ->update($data['query_user']);

                        // Update User Changelog
                        $user['user_id'] = $user['id'];
                        unset($user['id']);
                        if ($this->table == 'user_profiles') {
                        }
                    } else {
                        $result = $this->model::create($data['query_user']);
                        if (!empty($result['id'])) {
                            // Trigger UserUpdated Event
                            event(new UserProfileUpdated($result));
                        }
                    }
                    $this->count_success++;
                    $this->index++;
                    $this->addImportLog($this->index, 'Successful', null);
                } else {
                    $this->count_failure++;
                    $this->index++;
                    $this->addImportLog($this->index, 'Unsuccessful', 'Phone number required', $query['phone']);
                }
            } catch (Exception $e) {
                var_dump($e->getMessage());
                $this->count_failure++;
                $this->index++;
                $this->addImportLog($this->index, 'Unsuccessful', null);
            }
        $this->updateRowsImport();
        }
    }

    public function batchSize(): int
    {
        return 30000;
    }

    public function chunkSize(): int
    {
        return 30000;
    }

    /**
    * @return int
    */
    public function startRow(): int
    {
        return 2;
    }

    public function updateRowsImport() {
        LogImportFile::where('id', $this->import_id)
        ->update([
            'description' => [
                'rows_inserted' => $this->count_success,
                'rows_error'    => $this->count_failure,
            ],
        ]);
    }

    public function createImportLog($file_path) {
        $arr  = explode('.', $file_path);
        $file = $arr[0];
        $url  = $file. '_result.csv';
        $fp   = fopen(storage_path($url), 'a+');
        $this->file_path = $url;

        fputs($fp, "\xEF\xBB\xBF" );
        fputcsv($fp, ['No', 'Status', 'Descirption', 'Phone']);
        fclose($fp);
    }

    public function addImportLog($num, $result, $mess = null, $phone = null) {
        $fp   = fopen(storage_path($this->file_path), 'a+');
        fputcsv($fp, [
            'No'          => $num + 1,
            'Status'      => $result,
            'Description' => $mess,
            'Phone'       => $phone,
        ]);

        fclose($fp);
    }
}
