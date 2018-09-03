<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitOfSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_of_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string("display");
            $table->string("value");
        });



        Schema::table('u_s_s_d_sessions', function (Blueprint $table) {
            $table->foreign("unit_of_sale_id")
                ->references('id')->on('unit_of_sales')
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
        Schema::dropIfExists('unit_of_sales');
    }
}
