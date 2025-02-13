<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMountainVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mountain_villas', function (Blueprint $table) {
            $table->id();
            $table->string('mountain_view')->nullable();
            $table->string('view_of_ricefield')->nullable();
            $table->string('river_closeby')->nullable();
            $table->string('waterfall_closeby')->nullable();
            $table->string('activities')->nullable();
            $table->string('track_information')->nullable();
            $table->string('birdwatching')->nullable();
            $table->string('guide')->nullable();
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
        Schema::dropIfExists('mountain_villas');
    }
}
