<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLongTermPricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('pricings', function (Blueprint $table) {
            $table->enum('freehold', ['yes', 'no'])->nullable();
            $table->enum('leasehold', ['yes', 'no'])->nullable();
            $table->text('long_term_rental')->nullable();
            $table->text('long_term_sales')->nullable();
            $table->text('leasehold_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pricings', function (Blueprint $table) {
        //
            $table->dropColumn('freehold');
            $table->dropColumn('leasehold');
            $table->dropColumn('long_term_rental');
            $table->dropColumn('long_term_sales');
            $table->dropColumn('leasehold_description');
        });
    }
}
