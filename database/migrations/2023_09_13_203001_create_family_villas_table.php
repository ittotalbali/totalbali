<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_villas', function (Blueprint $table) {
            $table->id();
            $table->string('pool_fence')->nullable();
            $table->string('baby_cot')->nullable();
            $table->string('infant_cot')->nullable();
            $table->string('baby_high_chair')->nullable();
            $table->enum('chef', ['yes', 'no'])->nullable()->default('no');
            $table->string('costs_for_chef')->nullable();
            $table->string('nanny_cost')->nullable();
            $table->string('included')->nullable();
            $table->string('photos')->nullable();
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
        Schema::dropIfExists('family_villas');
    }
}
