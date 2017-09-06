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

      Indicator::find(1)->strategies()->attach([1,3,5,6,9,14,20,22,33,34,41,43]);
      Indicator::find(2)->strategies()->attach([2,4,5,7,10,15,20,24,35,42,46]);
      Indicator::find(3)->strategies()->attach([1,2,5,6,15,20,24,35,37,42,46]);
      Indicator::find(4)->strategies()->attach([2,4,5,7,10,15,21,26,30,40,45]);
      Indicator::find(5)->strategies()->attach([11,13,17,31,37,25,27,32,44,48]);
      Indicator::find(6)->strategies()->attach([3,8,13,14,18,23,36,40,47,50]);
      Indicator::find(7)->strategies()->attach([3,8,11,14,15,31,25,27,32,44]);
      Indicator::find(8)->strategies()->attach([2,6,10,15,21,26,30,36,41,48]);
      Indicator::find(9)->strategies()->attach([1,9,12,18,22,25,29,33,40,44,45]);
      Indicator::find(10)->strategies()->attach([1,6,7,10,19,20,24,36,38,47,50]);
    }
}
