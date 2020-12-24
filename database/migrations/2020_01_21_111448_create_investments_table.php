<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('investments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('coin_id');
            $table->decimal('deposit_investment_charge')->default(0);
            $table->decimal('amount', 24, 2)->default(0);
            $table->decimal('amount_check', 24, 2)->default(0);
            $table->decimal('earn', 24, 2)->default(0);
            $table->string('run_count')->default(0);
            $table->dateTime('due_pay')->nullable();
            $table->boolean('status_deposit')->default(0);
            $table->boolean('settled_status')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('plan_id')
                    ->references('id')->on('plans')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('coin_id')
                    ->references('id')->on('coins')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('investments');
    }

}
