<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        DB::table('users')->insert([
          'name' => "Plinio Mabesi",
          'email' => "pliniomabesi@gmail.com",
          'password' => bcrypt('lisa02'),
          'type' => 'S',
          'avatar' => '1.jpg',
          'remember_token' => str_random(10),
          'created_at' => date("Y-m-d H:i:s"),
          'updated_at' => date("Y-m-d H:i:s")
        ]);

        factory(App\User::class, 2)->create(['type' => 'A','avatar' => 'default.png']);

        factory(App\User::class, 17)->create(['avatar' => 'default.png']);

    }
}
