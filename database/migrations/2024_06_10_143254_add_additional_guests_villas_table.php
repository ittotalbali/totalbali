<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalGuestsVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('villas', function (Blueprint $table) {
            $table->string('extra_guest_charge')->nullable();
            $table->integer('max_guests')->nullable();
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
            $table->dropColumn('extra_guest_charge');
            $table->dropColumn('max_guests');
        });
    }
}
