<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserProfit extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('user_coins', function (Blueprint $table) {
            $table->decimal('earn_promo', 24, 2)->default(0)->after('earn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('user_coins', function (Blueprint $table) {
            $table->dropColumn('earn_promo');
        });
    }

}
