<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::dropIfExists('Product_Review');
        Schema::create('Product_Review', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->text('description')->nullable();
            $table->string('title',50)->nullable();
            $table->integer('product_id')->nullable();
            $table->float('rating', 11 ,0)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_name',10)->nullable();
            $table->string('images',50)->nullable();
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
        Schema::dropIfExists('Product_Review');
    }
}
