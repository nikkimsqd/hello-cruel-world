<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumofpersonToBiddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('biddings', function (Blueprint $table) {
            $table->string('numOfPerson');
            $table->string('nameOfWearers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biddings', function (Blueprint $table) {
            //
        });
    }
}
