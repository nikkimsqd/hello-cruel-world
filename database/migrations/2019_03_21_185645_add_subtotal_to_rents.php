<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubtotalToRents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rents', function($table) {
            $table->string('subtotal');
            $table->string('total');
            $table->string('deliveryFee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rents', function($table) {
            $table->dropColumn('subtotal');
            $table->dropColumn('total');
            $table->dropColumn('deliveryFee');
        });
    }
}
