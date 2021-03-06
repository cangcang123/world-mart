<?php

namespace SHOP\Admin\Jobs;

use Exception;
use Log;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AdminNotifyMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $context;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $context = [])
    {
        $this->message = $message;
        $this->context = $context;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (env('APP_ENV') != 'local') {
        }
    }
}
