<?php

use Illuminate\Database\Seeder;
use App\HomePageText;

class homePageTextSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $home = new HomePageText();
        $home->title = 'Welcome to  Investment';
        $home->description = 'A Global Investment Manager For Diverse Portfolios';
        $home->photo = 'images/homepage/photo/photo.jpg';
        $home->about_us_photo = 'images/homepage/about_us_photo/about_us_photo.jpg';
        $home->video_text = "<h3 class='mb-4'>
 You're in control
</h3>
<p>
Our sterling reputation, dedication to meeting our clients’ needs and innovative approach to
business development are some driving forces behind our success.
</p>
<p>
 Our dream today is for investors to testify and spread the word about Metall Investment
 fighting for the good course of making individuals wealthy.
 </p>";
        $home->get_start_text = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.';
        $home->get_start_text_image = 'images/homepage/get_start_text_image/get_start_text_image.jpg';
        $home->why_us_text = '<h3>
TASC is the number one choice for thousands of investors, seeking maximum returns with
 virtually no risks.
</h3>
<p>
TASC is built on the Bitcoin open source code. This guaranties complete security and
 transparency of any transactions that have become available thanks to the blockchain
technology and cryptocurrencies.
</p>';
        $home->benefit_text = "<h5 class='c-benefit__title'>
 Best benefits for you
</h5>
<p class='c-benefit__info'>
TASC offers the best investment benefits you can find
 </p>";
        $home->why_us_text_image = 'images/homepage/why_us_text_image/why_us_text_image.jpg';
        $home->files = '';
        $home->files_1 = '';
        $home->files_2 = '';
        $home->get_beneift_text = 'We are professionals when it comes to cryptocurrency investment';
        $home->about_us_title = 'Lorem ipsum dolor sit amet';
        $home->about_us_quote = ' Lorem ipsum dolor sit ametLorem ipsum dolor sit amet
                    <div class="author-address">Tanjil Ahmed - Owner, Bdtask</div>';
        $home->cal_title = 'Lorem ipsum dolor sit ametLorem ipsum dolor sit amet  ';
        $home->cal_photo = 'frontend/assets/img/calculate-img.png';
        $home->cal_description = " It is a long established fact that a reader will be distracted by the readable content of a page when looking
                            at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, 
                            as opposed to using 'Content here, content here', making it look like readable English.";
        $home->service_text = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.';

        $home->save();
    }

}
