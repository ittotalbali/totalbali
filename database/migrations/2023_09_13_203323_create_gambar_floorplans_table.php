<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGambarFloorplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar_floorplans', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('id_floorplan')->nullable();
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
        Schema::dropIfExists('gambar_floorplans');
    }
}
