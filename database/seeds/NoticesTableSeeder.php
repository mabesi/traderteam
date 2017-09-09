<?php

use Illuminate\Database\Seeder;
use App\Notice;

class NoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Notice::truncate();
      factory(App\Notice::class, 35)->create();
    }
}
