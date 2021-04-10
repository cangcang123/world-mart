<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Skus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('Skus');
        Schema::create('Skus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name',100)->nullable();
            $table->float('price', 11, 0)->nullable();
            $table->string('slug',100)->nullable();
            $table->string('sku',100)->nullable();
            $table->float('bonus_rating', 11, 0)->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('product_id')->nullable();
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
        Schema::dropIfExists('Skus');
    }
}
