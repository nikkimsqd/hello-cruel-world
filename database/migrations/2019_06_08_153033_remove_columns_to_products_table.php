<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('rpID');
            $table->dropColumn('customizable');
            $table->dropColumn('forRent');
            $table->dropColumn('forSale');
            $table->dropColumn('rentPrice');
            $table->renameColumn('productPrice', 'price');
            $table->renameColumn('productID', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
