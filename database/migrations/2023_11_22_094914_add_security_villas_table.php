<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSecurityVillasTable extends Migration
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
            $table->enum('security_cctv', ['yes', 'no'])->nullable();
            $table->enum('security_night', ['yes', 'no'])->nullable();
            $table->enum('security_day', ['yes', 'no'])->nullable();
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
            $table->dropColumn('security_cctv');
            $table->dropColumn('security_night');
            $table->dropColumn('security_day');
        });
    }
}
