<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableDataSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = 'Tasc';
        $user->type = 'admin';
        $user->code = true;
        $user->last_name = 'tasm';
        $user->email = 'tasc@invest.com';
        $user->password = bcrypt('secret');
        $user->save();
    }
}
