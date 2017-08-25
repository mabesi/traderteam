<?php

use Illuminate\Database\Seeder;
use App\Operation;

class OperationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Operation::truncate();
      factory(App\Operation::class, 100)->create();
    }
}
