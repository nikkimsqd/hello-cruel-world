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
            $table->string('deadlineOfProduct');
            $table->string('measurementID')->nullable();
            $table->string('notes');
            $table->string('quantity');
            $table->string('numOfPerson');
            $table->string('fabChoice'); //"provide" | "askboutique"
            $table->string('price')->nullable();
            $table->string('orderID')->nullable();
            $table->string('status'); //"active" | "cancelled" | {declinedtransactionID}
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
