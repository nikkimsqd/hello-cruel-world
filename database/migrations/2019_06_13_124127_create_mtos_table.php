<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMtosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userID');
            $table->string('boutiqueID');
            $table->date('dateOfUse');
            $table->string('notes');
            $table->string('height');
            $table->string('categoryID');
            $table->string('measurementID')->nullable();
            $table->string('fabricID')->nullable();
            $table->string('fabricSuggestion')->nullable();
            $table->string('fabricChoice')->nullable();
            $table->string('price')->nullable();
            $table->string('orderID')->nullable();
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
        Schema::dropIfExists('mtos');
    }
}
