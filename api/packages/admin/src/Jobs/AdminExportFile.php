<?php

namespace SHOP\Admin\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\QueryBuilder;
use SHOP\Admin\Library\StatusHelper;
use SHOP\CRM\Models\LogExportFile;
use Rap2hpoutre\FastExcel\FastExcel;
use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use SHOP\CRM\Models\UserProfile;
use DB;

class AdminExportFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $model;
    protected $condition;

    private $chunk_limit = 100;

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
    public function __construct($model, $condition)
    {
        $this->model = $model;
        $this->condition = $condition;
    }

    public function generator($condition) {
        $table_name = call_user_func([new $this->model, 'getTable']);
        if ($condition['type'] == 'all') {
            $list = QueryBuilder::for($this->model)
                ->allowedFilters($condition['filter'])
                ->allowedSorts($condition['sort'])
                ->cursor();

            foreach ($list as $item) {
                $item = $table_name == 'user_profiles' ? StatusHelper::formatExportField($item, $table_name, false) : $item;
                yield $item;
            }
        } else if($condition['type'] == 'all-follower') {
            $list_followers = array();
            $list = QueryBuilder::for($this->model)
                ->chunk($this->chunk_limit, function ($followers) use (&$list_followers) {
                    $followers = $followers->toArray();
                    foreach ($followers as $i => $user) {
                        $phone = UserProfile::where('zalo_id_by_oa', $user["zalo_id_by_oa"])
                                            ->select('phone')
                                            ->first();
                        if(!is_null($phone)) {
                            $phone = $phone->toArray()['phone'];
                            $followers[$i]['phone'] = $phone;
                        } else {
                            $followers[$i]['phone'] = '';
                        }
                    }
                    $list_followers = array_merge($list_followers, $followers);
                });
            foreach ($list_followers as $item) {
                $item = StatusHelper::formatExportField($item, $table_name, true);
                yield $item;
            }
        } else {
            $request = new Request([
                'filter' => $condition['request_filter'],
                'sort'   => $condition['request_sort']
            ]);

            $list = QueryBuilder::for($this->model, $request)
                ->select($condition['select_fields'])
                ->allowedFilters($condition['filter'])
                ->allowedSorts($condition['sort']);

            if ($condition['time']) {
                $start = $condition['time'][0];
                $end   = $condition['time'][1];
                $list->whereBetween(DB::raw("DATE_FORMAT(modified_at, '%Y-%m-%d')") , [$start, $end]);
            }

            $list = $list->cursor();

            foreach ($list as $item) {
                $item = $table_name == 'user_profiles' ? StatusHelper::formatExportField($item, $table_name, false) : $item;
                yield $item;
            }
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $table_name     = call_user_func([new $this->model, 'getTable']);
        $file_extension = 'xlsx';
        $filename       = Str::studly($table_name) . '_' . time();
        $file_path      = 'exports' .'/'. date('Y/m/d');
        $url            = 'app' .'/'. $file_path .'/'. $filename . '.' . $file_extension;

        try {
            Storage::makeDirectory($file_path);
            $result = LogExportFile::create([
                'name'      => $filename,
                'state'     => 0,
                'deleted'   => 0,
                'type'      => 1, //User Profiles
                'extension' => $file_extension
            ]);

            $style = (new StyleBuilder())
            ->setFontBold()
            ->setBackgroundColor(Color::YELLOW)
            ->build();

            if (isset($result->id)) {
                $path = (new FastExcel($this->generator($this->condition)))->headerStyle($style)->export(storage_path($url));
                if ($path) {
                    LogExportFile::updateOrCreate(['id' => $result->id], [
                        'path'  => $url,
                        'state' => 1
                    ]);
                }
            }
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(\Exception $exception)
    {
        var_dump($exception->getMessage());
    //     // Send user notification of failure, etc...
    }
}
