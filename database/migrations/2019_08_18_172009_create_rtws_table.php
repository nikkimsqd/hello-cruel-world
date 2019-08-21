<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtwsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtws', function (Blueprint $table) {
            $table->increments('id');
            $table->string('productID');
            $table->string('xs')->nullable();
            $table->string('s')->nullable();
            $table->string('m')->nullable();
            $table->string('l')->nullable();
            $table->string('xl')->nullable();
            $table->string('xxl')->nullable();
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
        Schema::dropIfExists('rtws');
    }
}
