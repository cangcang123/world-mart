<?php

namespace SHOP\Admin\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;
use SHOP\CRM\Models\LogImportFile;
use App\Imports\ExcelImport;
use Illuminate\Support\Str;
use Excel;

class AdminImportFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;
    protected $model;
    protected $columns;
    protected $id;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($table, $path, $id, $columns)
    {
        $this->model   = $this->getModelByTablename($table);
        $this->path    = $path;
        $this->columns = $columns;
        $this->id      = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            LogImportFile::where('id', $this->id)
                        ->update(['state' => 3,
                                  'import_time' => date("Y-m-d H:i:s"),
                                  'status_log' => 'Processing'
                        ]);

            Excel::import(new ExcelImport($this->model, $this->columns, $this->id, $this->path), storage_path($this->path));

            LogImportFile::where('id', $this->id)
                        ->update(['state' => 4,
                                  'status_log' => 'import thành công'
                        ]);
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(\Exception $exception)
    {
        if (env('APP_ENV') != 'local') {
            \Log::channel('telegram')->info($exception->getMessage(), []);
        }
        // $log_import = LogImportFile::where('id', $this->id)->first();
        // if (!empty($log_import)) {
        //     var_dump($log_import['description']);
        // }
        // var_dump($exception->getMessage());
    }

    public function getModelByTablename($tableName) {
        $name   =  Str::studly(Str::singular($tableName));
        $model  = 'SHOP\CRM\Models\\' . $name;
        return $model;
    }

}
