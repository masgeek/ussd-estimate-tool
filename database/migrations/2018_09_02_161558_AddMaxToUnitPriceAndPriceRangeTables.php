<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaxToUnitPriceAndPriceRangeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('price_ranges', function (Blueprint $table) {
            $table->integer("max")->after("min");
        });
        Schema::table('unit_prices', function (Blueprint $table) {
            $table->integer("max")->after("min");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('price_ranges', function (Blueprint $table) {
            //
        });
    }
}
