<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('cartID');
            $table->dropColumn('rentID');
            $table->dropColumn('mtoID');
            $table->dropColumn('biddingID');
            $table->dropColumn('deliveryAddress');
            $table->dropColumn('paypalOrderID');
            $table->dropColumn('billingName');
            $table->dropColumn('phoneNumber');
            $table->string('transactionID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
