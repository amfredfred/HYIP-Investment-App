<?php

use Illuminate\Database\Seeder;
use App\Page;

class pagesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $page = new Page();
        $page->title = 'All the Lorem Ipsum generators on the Internet';
        $page->description = 'All the Lorem Ipsum generators on the Internet tend to rdefined chunks as making this theAll the Lorem Ipsum generators on the Internet';
        $page->slug = 'about-us';
        $page->save();
    }

}
