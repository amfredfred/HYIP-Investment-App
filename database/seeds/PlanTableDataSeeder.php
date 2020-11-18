<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlanTableDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $plan = new Plan();
        $plan->name = 'PLAN 1';
        $plan->percentage = 15;
        $plan->min = 10;
        $plan->max = 600;
        $plan->deposit_fee = 600;
        $plan->ref = 6;
        $plan->compound_id = 1;
        $plan->save();

//        //plan2
//        $plan2 = new Plan();
//        $plan2->name = 'PLAN 2';
//        $plan2->percentage = 20;
//        $plan2->min = 705;
//        $plan2->max = 25005;
//        $plan2->compound_id = 2;
//        $plan2->ref = 6;
//        $plan2->save();
//        //plan3
//        $plan3 = new Plan();
//        $plan3->name = 'PLAN 3';
//        $plan3->percentage = 45;
//        $plan3->min = 2005;
//        $plan3->max = 50005;
//        $plan3->compound_id = 3;
//        $plan3->ref = 6;
//        $plan3->save();
//        //plan4
//        $plan4 = new Plan();
//        $plan4->name = 'PLAN 4';
//        $plan4->min = 3005;
//        $plan4->percentage = 60;
//        $plan4->max = 100005;
//        $plan4->compound_id = 4;
//        $plan4->ref = 6;
//        $plan4->save();
//        //plan5
//        $plan5 = new Plan();
//        $plan5->name = 'PLAN 5';
//        $plan5->percentage = 80;
//        $plan5->min = 10005;
//        $plan5->max = 100000;
//        $plan5->compound_id = 5;
//        $plan5->ref = 6;
//        $plan5->save();
//        //plan6
//        $plan6 = new Plan();
//        $plan6->name = 'PLAN 6';
//        $plan6->percentage = 20;
//        $plan6->min = 1;
//        $plan6->max = 108;
//        $plan6->ref = 6;
//        $plan6->compound_id = 6;
//        $plan6->save();
    }

}
