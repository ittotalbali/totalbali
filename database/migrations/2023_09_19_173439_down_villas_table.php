<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DownVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('villas', function (Blueprint $table) {
            //
            $table->dropColumn('country_id');
            $table->dropColumn('area_id');
            $table->dropColumn('location_id');
            $table->dropColumn('sub_location_id');
            $table->dropColumn('user_id');
            $table->dropColumn('address');
            // $table->dropColumn('name');
            $table->dropColumn('link_map');
            $table->dropColumn('cor_lat');
            $table->dropColumn('cor_long');
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('villas', function (Blueprint $table) {
            $table->integer('country_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('sub_location_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('address')->nullable();
            $table->text('link_map')->nullable();
            $table->string('cor_lat')->nullable();
            $table->string('cor_long')->nullable();
            $table->enum('type_accomodation', ['house', 'guesthouse', 'hotel', 'apartment'])->nullable()->default('house');
            $table->enum('privacy_type', ['entireplace', 'room', 'sharedroom'])->nullable()->default('entireplace');
            $table->integer('guest')->nullable();
            $table->integer('bedroom')->nullable();
            $table->integer('bed')->nullable();
            $table->integer('bathroom')->nullable();
            $table->string('staff')->nullable();
            $table->string('landsize')->nullable();
            $table->string('buildingsize')->nullable();
            $table->integer('yearbuilt')->nullable();
            $table->enum('pets', ['yes', 'no'])->nullable()->default('yes');
            $table->string('internet')->nullable();
            $table->string('code')->nullable();
            $table->string('title')->nullable();
            $table->text('short')->nullable();
            $table->text('long')->nullable();
            $table->string('old_link')->nullable();
            $table->string('new_link')->nullable();
            $table->integer('base_rate')->nullable();
            $table->enum('camera', ['yes', 'no'])->nullable()->default('yes');
            $table->enum('weapon', ['yes', 'no'])->nullable()->default('yes');
            $table->enum('animal', ['yes', 'no'])->nullable()->default('yes');
            $table->enum('status', ['draft', 'post'])->nullable()->default('draft');
        });
    }
}
