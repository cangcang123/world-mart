<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('User_Profiles');
        Schema::create('User_Profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('full_name')->nullable();
            $table->date('dob')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
            $table->string('address')->nullable();
            $table->string('password')->nullable();
            $table->string('referral_code')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('referral_user')->nullable();
            $table->string('token')->nullable();
            $table->integer('total_referral')->nullable();
            $table->integer('wallet')->nullable();
            $table->tinyInteger('deleted')->nullable()->default('0');
            $table->tinyInteger('status')->nullable()->default('0');
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
        Schema::dropIfExists('User_Profiles');
    }
}
