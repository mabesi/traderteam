<?php

use Illuminate\Database\Seeder;
use App\Strategy;

class StrategiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Strategy::truncate();
        DB::table('indicator_strategy')->truncate();
        factory(App\Strategy::class, 100)->create();
    }
}
