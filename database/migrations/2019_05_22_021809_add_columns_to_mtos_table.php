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
            $table->string('height');
            $table->string('categoryID');
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
            $table->dropColumn('height');
            $table->dropColumn('categoryID');
        });
    }
}
