<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeachVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beach_villas', function (Blueprint $table) {
            $table->id();
            $table->string('what_beach')->nullable();
            $table->string('how_far_walking')->nullable();
            $table->string('views_of_ocean')->nullable();
            $table->enum('surf_villa', ['yes', 'no'])->nullable()->default('no');
            $table->string('waves_nearby')->nullable();
            $table->text('extra_information')->nullable();
            $table->text('other_information')->nullable();
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
        Schema::dropIfExists('beach_villas');
    }
}
