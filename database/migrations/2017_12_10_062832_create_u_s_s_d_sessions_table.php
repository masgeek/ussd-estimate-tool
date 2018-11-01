<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUSSDSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_s_s_d_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('session_id')->nullable();
            $table->string('path')->default("");
            $table->string('phone_no');
            $table->string("currency")->nullable();
            $table->string("locale")->nullable();
            $table->unsignedInteger("planting_date_id")->nullable();
            $table->unsignedInteger("field_area_id")->nullable();
            $table->unsignedInteger("harvesting_date_id")->nullable();
            $table->unsignedInteger("unit_of_sale_id")->nullable();
            $table->unsignedInteger("unit_price_id")->nullable();
            $table->unsignedInteger("investment_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('u_s_s_d_sessions');
    }
}
