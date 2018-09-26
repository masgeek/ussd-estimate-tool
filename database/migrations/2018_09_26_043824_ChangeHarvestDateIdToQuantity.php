<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHarvestDateIdToQuantity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_s_s_d_sessions', function (Blueprint $table) {
            $table->unsignedInteger('harvest_quantity_id')->after('field_area_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_s_s_d_sessions', function (Blueprint $table) {
            $table->dropColumn(['harvest_quantity_id']);
        });
    }
}
