<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villas', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id');
            $table->integer('area_id');
            $table->integer('location_id');
            $table->integer('sub_location_id');
            $table->integer('user_id');
            $table->string('name');
            $table->text('address');
            $table->text('link_map');
            $table->string('cor_lat');
            $table->string('cor_long');
            $table->text('content');
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
        Schema::dropIfExists('villas');
    }
}
