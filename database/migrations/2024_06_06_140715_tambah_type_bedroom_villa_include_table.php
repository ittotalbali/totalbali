<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahTypeBedroomVillaIncludeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        //Schema::table('bedrooms', function (Blueprint $table) {
             // Drop the existing column to avoid conflicts during re-creation
             //$table->dropColumn('type_of_bedroom');
             //$table->enum('type_of_bedroom', ['double_bed', 'hollywood_twin', 'twin', 'single', 'sofa_bed', 'bunk_bed', 'queen', 'king'])->nullable()->change();
            
        //});
        DB::statement('ALTER TABLE bedrooms MODIFY COLUMN type_of_bedroom ENUM("double_bed", "hollywood_twin", "twin", "single", "sofa_bed", "bunk_bed", "queen", "king") DEFAULT NULL');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bedrooms', function (Blueprint $table) {
            $table->dropColumn('type_of_bedroom');
        });
    }
}
