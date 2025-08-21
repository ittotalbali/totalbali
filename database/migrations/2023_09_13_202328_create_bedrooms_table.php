<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bedrooms', function (Blueprint $table) {
            $table->id();
            $table->integer('number_of_bedrooms')->nullable();
            $table->enum('type_of_bedroom', ['double_bed', 'hollywood_twin', 'twin', 'single'])->nullable()->default('single');
            $table->integer('people_can_stay_per_room')->nullable();
            $table->string('extra_guest_charge')->nullable();
            $table->integer('max_guests')->nullable();
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
        Schema::dropIfExists('bedrooms');
    }
}
