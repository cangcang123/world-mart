<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LocationDistrictInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('Location_District_Infos');
        Schema::create('Location_District_Infos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('code',20)->nullable();
            $table->string('name',20)->nullable();
            $table->string('class',20)->nullable();
            $table->string('province_code',20)->nullable();
            $table->string('province_name',20)->nullable();
            $table->string('status_log',20)->nullable();
            $table->string('created_by',20)->nullable();
            $table->string('modified_by',20)->nullable();
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
        Schema::dropIfExists('Location_District_Infos');
    }
}
