<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(CoinTableDataSeeder::class);
        $this->call(UserTableDataSeeder::class);
        $this->call(UserCoinTableDataSeeder::class);
        $this->call(CompoundTableDataSeeder::class);
        $this->call(PlanTableDataSeeder::class);
        $this->call(getStartedSeeder::class);
        $this->call(homePageTextSeeder::class);
        $this->call(homePageSliderSeeder::class);
        $this->call(serviceSeeder::class);
        $this->call(settingsSeeder::class);
         $this->call(pagesSeeder::class);
    }

}
