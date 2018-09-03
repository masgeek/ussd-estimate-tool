<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHarvestingDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harvesting_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->string("display");
            $table->string("value");
        });

        Schema::table('u_s_s_d_sessions', function (Blueprint $table) {
            $table->foreign("harvesting_date_id")
                ->references('id')->on('harvesting_dates')
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
        Schema::dropIfExists('harvesting_dates');
    }
}
