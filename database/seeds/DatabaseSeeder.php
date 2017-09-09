<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");

        $this->call(UsersTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(StrategiesTableSeeder::class);
        $this->call(IndicatorsTableSeeder::class);
        $this->call(NoticesTableSeeder::class);
        $this->call(OperationsTableSeeder::class);

        DB::statement("SET foreign_key_checks=1");
    }
}
