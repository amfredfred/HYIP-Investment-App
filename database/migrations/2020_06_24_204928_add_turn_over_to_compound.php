<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTurnOverToCompound extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::table('compounds', function (Blueprint $table) {
             $table->string('compound_turn_over')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compounds', function (Blueprint $table) {
             $table->dropColumn('compound_turn_over');
        });
    }
}
