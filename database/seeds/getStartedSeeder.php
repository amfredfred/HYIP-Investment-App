<?php

use Illuminate\Database\Seeder;
use App\GetStarted;

class getStartedSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $get = new GetStarted();
        $get->title = 'Choose your Wallet';
        $get->description = 'All the Lorem Ipsum generators on the Internet tend to rdefined chunks as making this the';
        $get->icon = 'flaticon-wallet';
        $get->save();
        $get1 = new GetStarted();
        $get1->title = 'Make Payment';
        $get1->description = 'All the Lorem Ipsum generators on the Internet tend to rdefined chunks as making this the';
        $get1->icon = 'flaticon-credit-card';
        $get1->save();
        $get2 = new GetStarted();
        $get2->title = 'Invest / Deposit';
        $get2->description = 'All the Lorem Ipsum generators on the Internet tend to rdefined chunks as making this the';
        $get2->icon = 'flaticon-money-1';
        $get2->save();
    }

}
