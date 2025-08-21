<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('villas', function (Blueprint $table) {
            $table->string('airbnb_link')->nullable();
            $table->string('bookingcom_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('villas', function (Blueprint $table) {
        //
            $table->dropColumn('airbnb_link');
            $table->dropColumn('bookingcom_link');
        });
    }
}
