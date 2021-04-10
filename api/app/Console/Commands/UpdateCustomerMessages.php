<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SHOP\CRM\Models\CustomerMessage;
use SHOP\CRM\Models\ZoaInfo;

class UpdateCustomerMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:update-customer-ms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update customer messages by Zalo OA';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $oas = ZoaInfo::all();
        foreach ($oas as $oa) {
            CustomerMessage::firstOrCreate(
                [
                    'type' => 1,
                    'channel' => 'zalo',
                    'oa_id' => $oa->oa_id
                ],
                [
                    'name' => "{$oa->name} Zalo Welcome",
                    'message_data' => '[]',
                    'status' => 1,
                    'deleted' => 0
                ]
            );

            CustomerMessage::firstOrCreate(
                [
                    'type' => 1,
                    'channel' => 'sms',
                    'oa_id' => $oa->oa_id
                ], [
                    'name' => "{$oa->name} SMS Welcome",
                    'message_data' => '',
                    'status' => 1,
                    'deleted' => 0
                ]
            );
        }
        $this->info("Updated successfully!");
    }
}
