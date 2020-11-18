<?php

use Illuminate\Database\Seeder;
use App\Coin;

class CoinTableDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $coin = new Coin();
        $coin->name = 'Bitcoin';
        $coin->slug = 'bitcoin_address';
        $coin->address = 'dsdjhdjhdhjhhrhejhdjhje';
        $coin->status = true;
        $coin->photo = 'images/bitcoin.gif';
        $coin->save();
        //coin 2
        $coin2 = new Coin();
        $coin2->name = 'Litecoin';
        $coin2->slug = 'litecoin_address';
        $coin2->address = 'Ltdsdjhdjhdhjhhrhejhdjhje';
        $coin2->status = false;
        $coin2->photo = 'images/litecoin.gif';
        $coin2->save();
        //coin 3
        $coin3 = new Coin();
        $coin3->name = 'Ethereum';
        $coin3->slug = 'ethereum_address';
        $coin3->address = 'Ethudsdjhdjhdhjhhrhejhdjhje';
        $coin3->status = false;
        $coin3->photo = 'images/ethereum.gif';
        $coin3->save();
        //coin 4
        $coin4 = new Coin();
        $coin4->name = 'Bitcoin Cash';
        $coin4->slug = 'bitcoin_cash_address';
        $coin4->address = 'Btccdsdjhdjhdhjhhrhejhdjhje';
        $coin4->status = false;
        $coin4->photo = 'images/bitcoin-cash.png';
        $coin4->save();
        //coin 5
        $coin5 = new Coin();
        $coin5->name = 'Dash';
        $coin5->slug = 'dash_address';
        $coin5->address = 'ashhhdsdjhdjhdhjhhrhejhdjhje';
        $coin5->status = false;
        $coin5->photo = 'images/dash.png';
        $coin5->save();
    }

}
