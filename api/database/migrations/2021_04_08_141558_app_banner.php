<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('App_Banner');
        Schema::create('App_Banner', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name',20)->nullable();
            $table->string('url',20)->nullable();
            $table->tinyInteger('state')->nullable()->default('0');
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
        Schema::dropIfExists('App_Banner');
    }
}
