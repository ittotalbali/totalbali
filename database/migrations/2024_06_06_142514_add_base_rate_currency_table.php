<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBaseRateCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('villas', function (Blueprint $table) {
            $table->enum('base_rate_currency', ['USD', 'IDR', 'AUD', 'EUR'])->nullable()->default('IDR');
            $table->string('last_renovation')->nullable();
            $table->enum('wheelchair_friendly', ['yes', 'no'])->nullable();
        });
        DB::statement('ALTER TABLE `villas` MODIFY COLUMN `type_accomodation` ENUM("house", "guesthouse", "hotel", "apartment", "villa") DEFAULT "house"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('villas', function (Blueprint $table) {
            $table->dropColumn('base_rate_currency');
            $table->dropColumn('type_accomodation');
            $table->dropColumn('last_renovation');
            $table->dropColumn('wheelchair_friendly');
        });
    }
}
