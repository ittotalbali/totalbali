<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->enum('monthly_rental', ['yes', 'no'])->nullable()->default('no');
            $table->text('monthly_description')->nullable();
            $table->enum('yearly_rental', ['yes', 'no'])->nullable()->default('no');
            $table->text('yearly_description')->nullable();
            $table->enum('available_for_sales_rental', ['yes', 'no'])->nullable()->default('no');
            $table->text('available_for_sales_description')->nullable();
            $table->integer('id_villa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricings');
    }
}
