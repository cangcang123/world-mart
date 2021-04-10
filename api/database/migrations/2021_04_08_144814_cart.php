<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('Cart');
        Schema::create('Cart', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->tinyInteger('state')->nullable()->default('0');
            $table->tinyInteger('status')->nullable()->default('0');
            $table->integer('user_id')->nullable();
            $table->string('name',10)->nullable();
            $table->string('description',50)->nullable();
            $table->string('firt_name',10)->nullable();
            $table->string('last_name',10)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('mail',15)->nullable();
            $table->string('address',30)->nullable();
            $table->string('second_address',30)->nullable();
            $table->string('city',10)->nullable();
            $table->string('province',10)->nullable();
            $table->string('country',10)->nullable();
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
        Schema::dropIfExists('Cart');
    }
}
