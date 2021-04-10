<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Oder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('Oder');
        Schema::create('Oder', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('description',100)->nullable();
            $table->longText('order_content')->nullable();
            $table->longText('delivery_info')->nullable();
            $table->string('order_code',100)->nullable();
            $table->integer('user_id')->nullable();
            $table->float('discount', 11, 0)->nullable();
            $table->float('promo_code', 11, 0)->nullable();
            $table->float('total_price_by_item', 11, 0)->nullable();
            $table->float('grand_total', 11, 0)->nullable();
            $table->tinyInteger('payment_method')->nullable();
            $table->float('shipping_fee', 11, 0)->nullable();
            $table->tinyInteger('delivery_method')->nullable();
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
        Schema::dropIfExists('Oder');
    }
}
