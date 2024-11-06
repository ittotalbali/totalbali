<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffAtVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_at_villas', function (Blueprint $table) {
            $table->id();
            $table->integer('house_keeper')->nullable();
            $table->string('satpam')->nullable();
            $table->string('manager')->nullable();
            $table->string('chef')->nullable();
            $table->string('gardener')->nullable();
            $table->string('driver')->nullable();
            $table->string('other')->nullable();
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
        Schema::dropIfExists('staff_at_villas');
    }
}
