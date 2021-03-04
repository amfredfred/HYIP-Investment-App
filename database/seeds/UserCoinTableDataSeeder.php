<?php

use Illuminate\Database\Seeder;
use App\UserCoin;

class UserCoinTableDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user_coin = new UserCoin();
        $user_coin->user_id = 1;
        $user_coin->address = 'Ethudsdjhdjhdhjhhrhejhdjhje';
        $user_coin->coin_id = 1;
        $user_coin->amount = 10;
        $user_coin->earn = 2;
        $user_coin->save();

//        $user_coin2 = new UserCoin();
//        $user_coin2->user_id = 1;
//        $user_coin2->address = 'Ethudsdjhdjhdhjhhrhejhdjhje';
//        $user_coin2->coin_id = 2;
//        $user_coin2->amount = 10;
//        $user_coin2->earn = 2;
//        $user_coin2->save();
//
//        $user_coin3 = new UserCoin();
//        $user_coin3->user_id = 1;
//        $user_coin3->address = 'Ethudsdjhdjhdhjhhrhejhdjhje';
//        $user_coin3->coin_id = 3;
//        $user_coin3->amount = 10;
//        $user_coin3->earn = 2;
//        $user_coin3->save();
//
//        $user_coin4 = new UserCoin();
//        $user_coin4->user_id = 1;
//        $user_coin4->address = 'Ethudsdjhdjhdhjhhrhejhdjhje';
//        $user_coin4->coin_id = 4;
//        $user_coin4->amount = 10;
//        $user_coin4->earn = 2;
//        $user_coin4->save();
//
//        $user_coin5 = new UserCoin();
//        $user_coin5->user_id = 1;
//        $user_coin5->address = 'Ethudsdjhdjhdhjhhrhejhdjhje';
//        $user_coin5->coin_id = 5;
//        $user_coin5->amount = 10;
//        $user_coin5->earn = 2;
//        $user_coin5->save();
    }

}
