<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->float('min');
            $table->float('max');
            $table->decimal('percentage');
            $table->decimal('deposit_fee');
            $table->decimal('ref')->nullable();
            $table->string('note')->nullable();
            $table->unsignedBigInteger('compound_id');
            $table->timestamps();
            $table->foreign('compound_id')
                    ->references('id')->on('compounds')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('plans');
    }

}
