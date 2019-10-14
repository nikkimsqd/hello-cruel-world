<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnsFromFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('productID');
            $table->dropColumn('biddingID');
            $table->dropColumn('galleryID');
            $table->dropColumn('mtoID');
            $table->dropColumn('complainID');
            $table->dropColumn('filename');
            $table->string('type');
            $table->string('typeID');
            $table->string('filepath');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            //
        });
    }
}
