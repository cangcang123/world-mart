<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use SHOP\Admin\Library\ZaloOA;
use Rap2hpoutre\FastExcel\FastExcel;
use SHOP\CRM\Models\LogExportFile;

class ExcelImportPhoneNumber implements ToCollection, WithBatchInserts, WithChunkReading, ShouldQueue
{
    use Importable, Queueable, SerializesModels;

    protected $path;
    protected $name;
    protected $extension;

    public function __construct($path ,$file_name, $extension) {
        $this->path      = $path;
        $this->name      = $file_name;
        $this->extension = $extension;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $result = LogExportFile::create([
            'name'      => $this->name,
            'state'     => 0,
            'deleted'   => 0,
            'type'      => 2, //User Status
            'extension' => $this->extension
        ]);

        if (isset($result->id)) {
            $file_path = (new FastExcel($this->collectionGenerator($collection)))->export(storage_path($this->path));
            if ($file_path) {
                LogExportFile::updateOrCreate(['id' => $result->id], [
                    'path'  => $this->path,
                    'state' => 1
                ]);
            }
        }
    }

    public function collectionGenerator($collection)
    {
        foreach ($collection as $key => $row)
        {
                $status_follow  = 0;
                $phone = $row;
                $phone = preg_replace("/[^0-9]/", "", $phone);
                $zalo  = new ZaloOA();
                $res   = $zalo->getProfile($phone);

                if ($res) {
                    switch($res['error']) {
                        case 0:
                            $status_follow = 'Follow';
                            break;
                        case -213:
                            $status_follow = 'Not Follow';
                            break;
                        case -201:
                            $status_follow = 'Invalid Phone Number';
                            break;
                        default:
                            $status_follow = 'Undefined';
                    }
                } else {
                    $status_follow = 'Undefined';
                }

                yield collect(['Phone number' => $phone, 'Status follow' => $status_follow]);
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
}
