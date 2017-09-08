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
        DB::table('followers')->truncate();
        DB::table('operation_user')->truncate();
        User::truncate();

        DB::table('users')->insert([
          'name' => "Plinio Mabesi",
          'email' => "pliniomabesi@gmail.com",
          'password' => bcrypt('lisa02'),
          'type' => 'S',
          'rank' => '3',
          'avatar' => '1.jpg',
          'remember_token' => str_random(10),
          'created_at' => date("Y-m-d H:i:s"),
          'updated_at' => date("Y-m-d H:i:s")
        ]);

        factory(App\User::class, 1)->create(['type' => 'A','rank' => 1,'avatar' => 'default.png']);
        factory(App\User::class, 1)->create(['type' => 'A','rank' => 2,'avatar' => 'default.png']);
        factory(App\User::class, 1)->create(['type' => 'A','rank' => 3,'avatar' => 'default.png']);
        factory(App\User::class, 1)->create(['type' => 'A','rank' => 4,'avatar' => 'default.png']);
        factory(App\User::class, 1)->create(['type' => 'A','rank' => 5,'avatar' => 'default.png']);

        factory(App\User::class, 15)->create(['type' => 'U','rank' => 1,'avatar' => 'default.png']);
        factory(App\User::class, 10)->create(['type' => 'U','rank' => 2,'avatar' => 'default.png']);
        factory(App\User::class, 8)->create(['type' => 'U','rank' => 3,'avatar' => 'default.png']);
        factory(App\User::class, 5)->create(['type' => 'U','rank' => 4,'avatar' => 'default.png']);
        factory(App\User::class, 2)->create(['type' => 'U','rank' => 5,'avatar' => 'default.png']);

        factory(App\User::class, 120)->create(['avatar' => 'default.png']);

        User::find(1)->followers()->attach([2,3,7,9,14]);
        User::find(2)->followers()->attach([3,8,10,15]);
        User::find(3)->followers()->attach([2,3,5,6,7,9,10,14,20]);
        User::find(1)->following()->attach([2,4,6,7,15]);
        User::find(2)->following()->attach([4,5,6,9,12]);
        User::find(3)->following()->attach([22,3,4,5,7,8,9,12,16]);
        User::find(8)->followers()->attach([2,3,7,9,14]);
        User::find(9)->followers()->attach([3,8,10,15]);
        User::find(15)->followers()->attach([2,3,5,6,7,9,10,14,20]);
        User::find(20)->following()->attach([2,4,6,7,15]);
        User::find(34)->following()->attach([4,5,6,9,12]);
        User::find(43)->following()->attach([1,3,4,5,7,8,9,12,16]);

    }
}
