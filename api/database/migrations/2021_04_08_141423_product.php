<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::dropIfExists('Product');
        Schema::create('Product', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name',100)->nullable();
            $table->float('price',11,0)->nullable();
            $table->tinyInteger('status')->nullable()->default('0');
            $table->tinyInteger('deleted')->nullable()->default('0');
            $table->integer('quota')->nullable();
            $table->integer('promotion')->nullable();
            $table->float('bonus_rating',11,0)->nullable();
            $table->integer('brand')->nullable();
            $table->float('discount',11,0)->nullable();
            $table->float('bonus_referral',11,0)->nullable();
            $table->tinyInteger('is_hot')->nullable()->default('0');
            $table->integer('is_new')->nullable();
            $table->integer('is_profit')->nullable();
            $table->longText('usage')->nullable();
            $table->tinyInteger('best_seller')->nullable();
            $table->string('description',900)->nullable();
            $table->string('category',20)->nullable();
            $table->string('slug',50)->nullable();
            $table->string('meta_title',100)->nullable();
            $table->string('sku',10)->nullable();
            $table->string('origin',20)->nullable();
            $table->longText('meta_content',900)->nullable();
            $table->string('cover_photo',20)->nullable();
            $table->text('image_url',20)->nullable();
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
        Schema::dropIfExists('Product');
    }
}
