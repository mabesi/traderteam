<?php

use Illuminate\Database\Seeder;
use App\Configuration;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Configuration::truncate();
      factory(App\Configuration::class, 15)->create();
    }
}
