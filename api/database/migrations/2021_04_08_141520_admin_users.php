<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('Admin_Users');
        Schema::create('Admin_Users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('role_id')->nullable()->default('0');
            $table->tinyInteger('gender')->nullable()->default('0');
            $table->date('dob')->nullable();
            $table->tinyInteger('state')->nullable()->default('0');
            $table->tinyInteger('status')->nullable()->default('0');
            $table->tinyInteger('locked')->nullable()->default('0');
            $table->tinyInteger('deleted')->nullable()->default('0');
            $table->string('username',20)->nullable();
            $table->string('password',20)->nullable();
            $table->string('avatar',20)->nullable();
            $table->string('full_name',20)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('mail',20)->nullable();
            $table->string('status_log',20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Admin_Users');
    }
}
