<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeRateVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('rates', function (Blueprint $table) {
        
        // $table->enum('type', ['base', 'high', 'low', 'peak', 'shoulder Season', 'special Rate', 'high Season', 'peak Season', 'low Season',])->default('base')->change();
        // });
        DB::statement('ALTER TABLE `rates` MODIFY COLUMN `type` ENUM("base", "high", "low", "peak", "shoulder Season", "special Rate", "high Season", "peak Season", "low Season") DEFAULT "base"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rates', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
