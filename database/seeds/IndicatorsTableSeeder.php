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

      Indicator::find(1)->strategies()->attach([1,3,5,6,9,14,20,22,34,41,43]);
      Indicator::find(2)->strategies()->attach([2,4,5,7,10,15,20,24,35,42,46]);
      Indicator::find(3)->strategies()->attach([1,2,5,6,15,20,24,35,42,46]);
      Indicator::find(4)->strategies()->attach([2,4,5,7,10,15,21,27,30,40,45]);
      Indicator::find(5)->strategies()->attach([1,3,7,10,15,21,27,30,41,48]);
    }
}
