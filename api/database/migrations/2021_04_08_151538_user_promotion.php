<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserPromotion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('User_Promotion');
        Schema::create('User_Promotion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('user_id')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('code',100)->nullable();
            $table->tinyInteger('is_public')->nullable();
            $table->float('discount_value', 11, 0)->nullable();
            $table->float('min_commission_fee', 11, 0)->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('max_use_time')->nullable();
            $table->integer('used_time')->nullable();
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
        Schema::dropIfExists('User_Promotion');
    }
}
