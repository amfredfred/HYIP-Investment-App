<?php

use Illuminate\Database\Seeder;
use App\homeSlider;

class homePageSliderSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $slider = new homeSlider();
        $slider->title = 'The Feature of <span class="outrageous-orange">Lorem ipsum</span> <br> ipsum dolor sit amet';
        $slider->description = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo <br> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo';
        $slider->image = 'img/slider/1920x1280-1.jpg';
        $slider->save();
        $slider1 = new homeSlider();
        $slider1->title = 'LL <span class="bright-turquoise">Lorem ipsum</span> <br> ipsum dolor sit amet';
        $slider1->description = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo <br> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo';
        $slider1->image = 'img/slider/1920x1280-2.jpg';
        $slider1->save();
        $slider2 = new homeSlider();
        $slider2->title = "Take the world's  best <br><span class='navy-blue'>Lorem ipsum dolor sit amet</span> sit amet";
        $slider2->description = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo <br> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo';
        $slider2->image = 'img/slider/1920x1280-3.jpg';
        $slider2->save();
    }

}
