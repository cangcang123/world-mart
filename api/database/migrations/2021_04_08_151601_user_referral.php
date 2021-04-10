<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserReferral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::dropIfExists('User_Referral');
        Schema::create('User_Referral', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('user_share_code',100)->nullable();
            $table->string('user_receive_code',100)->nullable();
            $table->integer('user_share_id')->nullable();
            $table->integer('user_receive_id')->nullable();
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
        Schema::dropIfExists('User_Referral');
    }
}
