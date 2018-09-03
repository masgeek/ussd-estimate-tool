<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string("display");
            $table->string("value");
        });

        Schema::table('u_s_s_d_sessions', function (Blueprint $table) {
            $table->foreign("field_area_id")
                ->references('id')->on('field_areas')
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
        Schema::dropIfExists('field_areas');
    }
}
