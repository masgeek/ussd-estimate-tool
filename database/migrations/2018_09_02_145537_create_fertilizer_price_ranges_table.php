<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFertilizerPriceRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fertilizer_price_ranges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("session_id");
            $table->unsignedInteger("fertilizer_id");
            $table->unsignedInteger("price_range_id")->nullable();
        });

        Schema::table('fertilizer_price_ranges', function (Blueprint $table) {

            $table->foreign("session_id")
                ->references('id')->on('u_s_s_d_sessions')
                ->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->foreign("fertilizer_id")
                ->references('id')->on('fertilizers')
                ->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->foreign("price_range_id")
                ->references('id')->on('price_ranges')
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
        Schema::dropIfExists('fertilizer_price_ranges');
    }
}
