<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColCompoundToInvest extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('investments', function (Blueprint $table) {
            $table->decimal('com_earn', 24)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn('com_earn');
        });
    }

}
