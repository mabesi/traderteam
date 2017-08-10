<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name' => "Plinio Mabesi",
          'email' => "pliniomabesi@gmail.com",
          'password' => bcrypt('lisa02'),
        ]);
    }
}
