<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wedding_villas', function (Blueprint $table) {
            $table->id();
            $table->integer('standing_guests')->nullable();
            $table->integer('seated_guests')->nullable();
            $table->string('additional_function_fee')->nullable();
            $table->string('banjar_fee')->nullable();
            $table->string('security_deposit')->nullable();
            $table->string('other_informasion')->nullable();
            $table->string('music_curfew')->nullable();
            $table->string('wedding_packages')->nullable();
            $table->string('wedding_packages_information')->nullable();
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
        Schema::dropIfExists('wedding_villas');
    }
}
