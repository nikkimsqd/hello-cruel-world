<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToMtosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mtos', function (Blueprint $table) {
            $table->string('paymentStatus');
            $table->string('paypalOrderID')->nullablle();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mtos', function (Blueprint $table) {
            $table->dropColumn('paymentStatus');
            $table->dropColumn('paypalOrderID');
        });
    }
}
