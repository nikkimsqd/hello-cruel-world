<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentableproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentableproducts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('price');
            $table->string('depositAmount');
            $table->string('penaltyAmount');
            $table->string('limitOfDays');
            $table->string('fine');
            $table->string('locationsAvailable');
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
        Schema::dropIfExists('rentableproducts');
    }
}
