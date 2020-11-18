<?php

use Illuminate\Database\Seeder;
use App\Compound;

class CompoundTableDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $com = new Compound();
        $com->name = '24 HOURS';
        $com->compound = 24;
        $com->save();
        //compound 2
        $com2 = new Compound();
        $com2->name = '30 HOURS';
        $com2->compound = 30;
        $com2->save();
         //compound 3
        $com3 = new Compound();
        $com3->name = '48 HOURS';
        $com3->compound = 48;
        $com3->save();
          //compound 4
        $com4 = new Compound();
        $com4->name = '72 HOURS';
        $com4->compound = 72;
        $com4->save();
           //compound 5
        $com5 = new Compound();
        $com5->name = '1 DAY';
        $com5->compound = 24;
        $com5->save();
          //compound 6
        $com6 = new Compound();
        $com6->name = '14 DAYS';
        $com6->compound = 336;
        $com6->save();
    }

}
