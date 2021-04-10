<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CartProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('Cart_Product');
        Schema::create('Cart_Product', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name',20)->nullable();
            $table->string('description',100)->nullable();
            $table->tinyInteger('deleted')->nullable()->default('0');
            $table->tinyInteger('status')->nullable()->default('0');
            $table->integer('product_id')->nullable();
            $table->integer('cart_id')->nullable();
            $table->float('discount', 11, 0)->nullable();
            $table->tinyInteger('quantity')->nullable();
            $table->float('price', 11, 0)->nullable();
            $table->string('sku',20)->nullable();
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
        Schema::dropIfExists('Cart_Product');
    }
}
