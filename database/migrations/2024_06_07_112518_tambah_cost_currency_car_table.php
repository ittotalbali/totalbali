<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahCostCurrencyCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_and_drives', function (Blueprint $table) {
            $table->enum('car_currency', ['USD', 'IDR', 'AUD', 'EUR'])->nullable()->default('IDR');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_and_drives', function (Blueprint $table) {
            $table->dropColumn('car_currency');
        });
    }
}
