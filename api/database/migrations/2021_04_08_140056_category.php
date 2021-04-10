<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Category extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('Category');
        Schema::create('Category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name',20)->nullable();
            $table->longText('description')->nullable();
            $table->string('meta_title',50)->nullable();
            $table->string('image_url',50)->nullable();
            $table->string('slug',50)->nullable();
            $table->tinyInteger('status')->nullable()->unsigned();
            $table->tinyInteger('deleted')->nullable()->unsigned();
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
        Schema::dropIfExists('Category');
    }
}
