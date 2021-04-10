<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\QueryBuilder\QueryBuilder;
use SHOP\Admin\Models\LogsUserAction;

/**
 * Class LogsUserAction
 * @package App\Jobs
 */
class LogsUserActionWorker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $role_id;
    protected $user_id;
    protected $username;
    protected $resource;
    protected $action;
    protected $ip;
    protected $platform;
    protected $browser;
    protected $user_agent;

    protected $logs_user_action = LogsUserAction::class;

    public $tries = 1;

    /**
     * LogsUserActionWorker constructor.
     * @param $role_id
     * @param $user_id
     * @param $username
     * @param $resource
     * @param $action
     * @param $ip
     * @param $platform
     * @param $browser
     * @param $user_agent
     */
    public function __construct($role_id, $user_id, $username, $resource, $action, $ip, $platform, $browser, $user_agent)
    {
        $this->role_id = $role_id;
        $this->user_id = $user_id;
        $this->username = $username;
        $this->resource = $resource;
        $this->action = $action;
        $this->ip = $ip;
        $this->platform = $platform;
        $this->browser = $browser;
        $this->user_agent = $user_agent;
    }

    public function handle()
    {
        $this->storeLogsUserAction([
            'role_id' => $this->role_id,
            'user_id' => $this->user_id,
            'username' => $this->username,
            'resource' => $this->resource,
            'action' => $this->action,
            'ip' => $this->ip,
            'platform' => $this->platform,
            'browser' => $this->browser,
            'user_agent' => $this->user_agent,
        ]);
    }

    /**
     * @param $data
     */
    private function storeLogsUserAction($data)
    {
        //('storeLogsUserAction', $data);
        try {
            $this->logs_user_action::create($data);
        } catch (Exception $e) {

        }
    }

    /**
     * @param Exception $exception
     */
    public function failed(Exception $exception)
    {
        print_r($exception->getMessage());
    }
}
