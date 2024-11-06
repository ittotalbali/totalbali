<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlbumGaleriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('galeris', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->text('image')->nullable();
            $table->integer('villa_id')->nullable();
            $table->integer('album_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('galeris', function (Blueprint $table) {
        //
            $table->dropColumn('title');
            $table->dropColumn('image');
            $table->dropColumn('villa_id');
        });
    }
}
