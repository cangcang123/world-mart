<?php

namespace SHOP\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Queue;

class QueueController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function delayed(Request $request)
    {
        $page       = (int) $request->input('page', 1);
        $connection = null;
        $default = 'default';

        $from   =  max($page - 1, 0) * 12;
        $to     =  max($page * 12, 1) - 1;

        $count       = Queue::getRedis()->connection($connection)->zcard('queues:' . $default . ':delayed');
        $delayedJobs = Queue::getRedis()->connection($connection)->zrange('queues:' . $default . ':delayed', $from, $to);

        $jobs = array_map(function ($job) {
            $job = json_decode($job);
            $job->data->command = unserialize($job->data->command);
            return $job;
        }, $delayedJobs);

        return ['count' => $count, 'jobs' => $jobs];
    }

    public function removeDelayedJob($id)
    {
        $connection = null;
        $default = 'default';
        $n = 0;
        do {
            [$n, $jobs] = Queue::getRedis()->connection($connection)->zscan('queues:' . $default . ':delayed', $n, 'MATCH', "*$id*");
        } while (count($jobs) != 1 && $n != 0);

        if (count($jobs) == 1) {
            return Queue::getRedis()->connection($connection)->zrem('queues:' . $default . ':delayed', array_keys($jobs)[0]);
        }
        return [$n, $jobs];
    }
}
