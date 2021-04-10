<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Country extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('Country');
        Schema::create('Country', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('country_id');
            $table->string('iso',2)->nullable();
            $table->string('country_name',80)->nullable();
            $table->string('iso3',3)->nullable();
            $table->integer('phonecode')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Country');
    }
}
