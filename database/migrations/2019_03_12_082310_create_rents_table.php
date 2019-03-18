<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->increments('rentID');
            $table->string('boutiqueID');
            $table->string('customerID');
            $table->string('status');
            $table->string('productID');
            $table->string('dateToUse');
            $table->string('locationToBeUsed');
            $table->string('addressOfDelivery');
            $table->string('additionalNotes');
            $table->date('dateToBeReturned')->nullable();
            $table->date('approved_at')->nullable();
            $table->date('completed_at')->nullable();
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
        Schema::dropIfExists('rents');
    }
}
