<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
        Schema::create('Products', function (Blueprint $table) {
            $table->string('productID');
            $table->string('fileID');
            $table->string('productName');
            $table->string('productDesc');
            $table->string('productPrice');
=======
        Schema::create('products', function (Blueprint $table) {
            $table->increments('productID');
            $table->string('userID');
            $table->string('productName');
            $table->string('productDesc');
            $table->string('productPrice');
            $table->string('category');
            $table->string('productStatus');
>>>>>>> master
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
        Schema::dropIfExists('Products');
    }
}
