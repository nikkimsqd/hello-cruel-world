<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveLocationavailabelToRentableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rentableproducts', function (Blueprint $table) {
            $table->dropColumn('locationsAvailable');
            $table->dropColumn('depositAmount');
            $table->string('cashban');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rentableproducts', function (Blueprint $table) {
            //
        });
    }
}
