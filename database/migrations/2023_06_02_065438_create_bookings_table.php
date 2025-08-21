<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('rate_id');
            $table->integer('villa_id');
            $table->string('name');
            $table->string('address');
            $table->string('email');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('rate_type', ['base', 'high', 'low'])->default('base');
            $table->integer('rate_price');
            $table->integer('rate_total');
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
        Schema::dropIfExists('bookings');
    }
}
