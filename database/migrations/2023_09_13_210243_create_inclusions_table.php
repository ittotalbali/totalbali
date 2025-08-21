<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInclusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inclusions', function (Blueprint $table) {
            $table->id();
            $table->enum('breakfast', ['yes', 'no'])->nullable()->default('no');
            $table->string('breakfast_description')->nullable();
            $table->enum('airport', ['yes', 'no'])->nullable()->default('no');
            $table->string('airport_description')->nullable();
            $table->enum('pijet', ['yes', 'no'])->nullable()->default('no');
            $table->string('pijet_description')->nullable();
            $table->enum('anything_else', ['yes', 'no'])->nullable()->default('no');
            $table->string('anything_else_description')->nullable();
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
        Schema::dropIfExists('inclusions');
    }
}
