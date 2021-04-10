<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SHOP\Admin\Models\AdminUser as User;
use Cache;

class ResetAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset-pass {pass?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset SupperAdmin Password';

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
        $newPass = $this->argument('pass');
        if (empty($newPass)) $newPass = '123456';

        $admin = User::find(1);
        if (empty($admin)) {
            $this->error('Admin user not found!');
        }
        else {
            $admin->password = bcrypt($newPass);

            if ($admin->save()) {
                Cache::delete('shop-users.' . $admin->id);
                $this->info("Admin's password has been reset successfully!");
            } else {
                $this->error("Can't update password!");
            }
        }
    }
}
