<?php

use Illuminate\Database\Seeder;
use App\Indicator;

class IndicatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Indicator::truncate();
      factory(App\Indicator::class, 10)->create();
    }
}
