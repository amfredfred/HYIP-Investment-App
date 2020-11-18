<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coin_id');
            $table->unsignedBigInteger('usercoin_id');
            $table->longText('description');
            $table->longText('withdraw_from');
            $table->longText('comment')->nullable();
            $table->decimal('withdraw_charge')->nullable();
            $table->longText('amount_check')->nullable();
            $table->longText('amount')->nullable();
            $table->decimal('total_amount');
            $table->longText('message')->nullable();
            $table->boolean('confirm')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('status_withdraw')->default(0);
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('coin_id')
                    ->references('id')->on('coins')
                    ->onDelete('cascade')->onUpdate('cascade');
               $table->foreign('usercoin_id')
                    ->references('coin_id')->on('user_coins')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('withdraws');
    }

}
