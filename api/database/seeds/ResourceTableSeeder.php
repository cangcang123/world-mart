<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ResourceTableSeeder
 *
 *
 * php artisan db:seed --class=ResourceTableSeeder
 *
 *
 */
class ResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo 'ResourceTableSeeder' . "\n";
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            foreach ($table as $key => $value) {
                echo 'Table: -> ' . $value . "\n";

                $prefix_table = explode('_', $value);
                $prefix_table = $prefix_table[0];

                if ($prefix_table != 'admin') {
                    try {
                        DB::table('admin_resources')->insert([
                            'created_at' => date("Y-m-d H:i:s"),
                            'modified_at' => date("Y-m-d H:i:s"),
                            'package_id' => 2,
                            'name' => $value,
                            'is_publish' => 1,
                            'state' => 1,
                            'status' => 1,
                        ]);
                    } catch (Exception $e) {
                        // echo 'Caught exception: ', $e->getMessage(), "\n";
                    }

                    try {
                        DB::table('admin_permission_roles')->insert([
                            'created_at' => date("Y-m-d H:i:s"),
                            'modified_at' => date("Y-m-d H:i:s"),
                            'role_id' => 3,
                            'resource' => $value,
                            'permissions' => '{"count":false,"list":false,"create":false,"detail":false,"update":false,"delete":false,"import":false,"export":false}',
                            'is_publish' => 1,
                            'state' => 1,
                            'status' => 1,
                        ]);
                    } catch (Exception $e) {

                    }

                    try {
                        DB::table('admin_permission_roles')->insert([
                            'created_at' => date("Y-m-d H:i:s"),
                            'modified_at' => date("Y-m-d H:i:s"),
                            'role_id' => 4,
                            'resource' => $value,
                            'permissions' => '{"count":false,"list":false,"create":false,"detail":false,"update":false,"delete":false,"import":false,"export":false}',
                            'is_publish' => 1,
                            'state' => 1,
                            'status' => 1,
                        ]);
                    } catch (Exception $e) {

                    }
                }
            }
        }
    }
}
