<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    $faker->addProvider(new App\Faker\Pessoa($faker));

    return [
        'name' => trim($faker->name),
        'email' => $faker->unique()->safeEmail,
        'type' => 'U',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Strategy::class, function (Faker\Generator $faker) {

    return [
        'user_id' => rand(1,20),
        'title' => $faker->sentence(3),
        'description' => $faker->paragraph(),
        'indicators' => implode($faker->randomElements(['MACD','MME','MMA','RSI','BB','FRACTAL','WILLIANS','ADF','OBV','A/D'],3),' '),
    ];
});
