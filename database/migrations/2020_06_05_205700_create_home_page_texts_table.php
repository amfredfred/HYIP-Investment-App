<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageTextsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('home_page_texts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->longText('description');
            $table->text('photo')->nullable();
            $table->text('about_us_photo')->nullable();
            $table->text('video_text')->nullable();
            $table->text('get_start_text')->nullable();
            $table->text('get_start_text_image')->nullable();
            $table->text('why_us_text')->nullable();
            $table->text('benefit_text')->nullable();
            $table->text('why_us_text_image')->nullable();
            $table->text('files')->nullable();
            $table->text('files_1')->nullable();
            $table->text('files_2')->nullable();
            $table->text('get_beneift_text')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('home_page_texts');
    }

}
