<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnsToRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->dropColumn('boutiqueID');
            $table->dropColumn('locationToBeUsed');
            $table->dropColumn('addressOfDelivery');
            $table->dropColumn('subtotal');
            $table->dropColumn('deliveryFee');
            $table->dropColumn('total');
            $table->dropColumn('paymentStatus');
            $table->dropColumn('amountDeposit');
            $table->dropColumn('amountPenalty');
            $table->dropColumn('paypalOrderID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rents', function (Blueprint $table) {
            //
        });
    }
}
