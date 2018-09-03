<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("min");
            $table->string("value");
        });

        Schema::table('u_s_s_d_sessions', function (Blueprint $table) {
            $table->foreign("unit_price_id")
                ->references('id')->on('unit_prices')
                ->onUpdate('CASCADE')->onDelete('SET NULL');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_prices');
    }
}
