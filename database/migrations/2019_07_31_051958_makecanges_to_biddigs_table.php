<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakecangesToBiddigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('biddings', function (Blueprint $table) {
            $table->renameColumn('maxPriceLimit', 'quotationPrice');
            $table->dropColumn('height');
            $table->string('category')->nullable()->change();
            $table->string('quantity');
            $table->string('fabChoice');
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
