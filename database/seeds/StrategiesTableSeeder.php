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
        factory(App\Strategy::class, 30)->create();
    }
}
