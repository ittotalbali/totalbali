<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetreatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retreats', function (Blueprint $table) {
            $table->id();
            $table->string('workout_deck')->nullable();
            $table->string('exclusive_rental')->nullable();
            $table->string('house_chef')->nullable();
            $table->string('views_from_workout')->nullable();
            $table->string('gym')->nullable();
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
        Schema::dropIfExists('retreats');
    }
}
