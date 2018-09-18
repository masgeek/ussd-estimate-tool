<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrencyToSession extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_s_s_d_sessions', function (Blueprint $table) {
            $table->string("currency")->nullable()->after("phone_no");
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
            $table->dropColumn(["currency"]);
        });
    }
}
