<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInformationToVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('villas', function (Blueprint $table) {
            $table->enum('type_accomodation', ['house', 'guesthouse','hotel','apartment'])->default('house');
            $table->enum('privacy_type', ['entireplace', 'room','sharedroom'])->default('entireplace');
            $table->integer('guest');
            $table->integer('bedroom');
            $table->integer('bed');
            $table->integer('bathroom');
            $table->string('staff');
            $table->string('landsize');
            $table->string('buildingsize');
            $table->integer('yearbuilt');
            $table->enum('pets', ['yes', 'no'])->nullable()->default('yes');
            $table->string('internet');
            $table->string('code');
            $table->string('title');
            $table->text('short');
            $table->text('long');
            $table->string('old_link');
            $table->string('new_link');
            $table->integer('base_rate');
            $table->enum('camera', ['yes', 'no'])->nullable()->default('yes');
            $table->enum('weapon', ['yes', 'no'])->nullable()->default('yes');
            $table->enum('animal', ['yes', 'no'])->nullable()->default('yes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('villas', function (Blueprint $table) {
            //
            $table->dropColumn('type_accomodation');
            $table->dropColumn('privacy_type');
            $table->dropColumn('guest');
            $table->dropColumn('bedroom');
            $table->dropColumn('bed');
            $table->dropColumn('bathroom');
            $table->dropColumn('staff');
            $table->dropColumn('landsize');
            $table->dropColumn('buildingsize');
            $table->dropColumn('yearbuilt');
            $table->dropColumn('pets');
            $table->dropColumn('internet');
            $table->dropColumn('code');
            $table->dropColumn('title');
            $table->dropColumn('short');
            $table->dropColumn('long');
            $table->dropColumn('old_link');
            $table->dropColumn('new_link');
            $table->dropColumn('base_rate');
            $table->dropColumn('camera');
            $table->dropColumn('weapon');
            $table->dropColumn('animal');
        });
    }
}
