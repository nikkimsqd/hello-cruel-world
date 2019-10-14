<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnsToRtwsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rtws', function (Blueprint $table) {
            $table->dropColumn('xs');
            $table->dropColumn('s');
            $table->dropColumn('m');
            $table->dropColumn('l');
            $table->dropColumn('xl');
            $table->dropColumn('xxl');
            $table->text('sizes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rtws', function (Blueprint $table) {
            //
        });
    }
}
