<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('Oder_Product');
        Schema::create('Oder_Product', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('origin')->nullable();
            $table->string('product_name')->nullable();
            $table->string('oder_code')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->tinyInteger('quantity')->nullable();
            $table->float('price', 11, 0)->nullable();
            $table->integer('category')->nullable();
            $table->integer('brand')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('Oder_Product');
    }
}
