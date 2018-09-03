<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantingDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planting_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->string("display");
            $table->string("value");
        });

        Schema::table('u_s_s_d_sessions', function (Blueprint $table) {
            $table->foreign("planting_date_id")
                ->references('id')->on('planting_dates')
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
        Schema::dropIfExists('planting_dates');
    }
}
