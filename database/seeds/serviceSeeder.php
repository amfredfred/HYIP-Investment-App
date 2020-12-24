<?php

use Illuminate\Database\Seeder;
use App\service;

class serviceSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $service = new service();
        $service->title = 'Data Protection';
        $service->description = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at
                        its layout.';
        $service->icon = 'flaticon-analytics';
        $service->save();
        $service1 = new service();
        $service1->title = 'Security Protected';
        $service1->description = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at
                        its layout.';
        $service1->icon = 'flaticon-secure-shield';
        $service1->save();
        $service2 = new service();
        $service2->title = 'Support 24/7';
        $service2->description = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at
                        its layout.';
        $service2->icon = 'flaticon-credit-card';
        $service2->save();
        $service3 = new service();
        $service3->title = 'Registered Company';
        $service3->description = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at
                        its layout.';
        $service3->icon = 'flaticon-money-2';
        $service3->save();

        $service4 = new service();
        $service4->title = 'Secured Company';
        $service4->description = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at
                        its layout.';
        $service4->icon = 'flaticon-money-1';
        $service4->save();
        $service5 = new service();
        $service5->title = 'Live Exchange Rates';
        $service5->description = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at
                        its layout.';
        $service5->icon = 'flaticon-bitcoin';
        $service5->save();
        $service6 = new service();
        $service6->title = 'Cryptocurrency Investments';
        $service6->description = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at
                        its layout.';
        $service6->icon = 'flaticon-bitcoin-1';
        $service6->save();
    }

}
