<?php

namespace SHOP\Shopping\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use SHOP\CRM\Models\UserProfile;
use SHOP\CRM\Models\UserReferral;
use Exception;

class AddUserReferral implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $form_add;
    private $profile;

    private $request_expire = 120; // seconds ~ 2 minutes
    private $cache_expire = 1800; // seconds ~ 30 minutes

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 300; // 5 minutes

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($form, $profile)
    {
        $this->form_add = $form;
        $this->profile = $profile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->profile && $this->form_add['user_share_code'] && $this->form_add['referral_user']) {
            $count_referral = UserReferral::where('user_share_code', $this->form_add['user_share_code'])->count();
            if ($count_referral < $this->profile->total_referral) {
                UserReferral::create([
                    'user_share_id' => $this->form_add['referral_user'],
                    'user_share_code' => $this->form_add['user_share_code'],
                    'user_receive_id' => $this->profile->id,
                    'user_receive_code' => $this->profile->referral_code,
                    'status' => 1,
                ]);
            }
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        var_dump($exception->getMessage());
    }
}
