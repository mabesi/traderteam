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
        'name' => trim($faker->firstName.' '.$faker->lastName),
        'email' => $faker->unique()->safeEmail,
        'type' => 'U',
        'confirmed' => $faker->randomElement([True,False]),
        'locked' => $faker->randomElement([True,False]),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Strategy::class, function (Faker\Generator $faker) {

    return [
        'user_id' => rand(1,10),
        'title' => $faker->sentence(3),
        'description' => $faker->paragraph(),
    ];
});

$factory->define(App\Indicator::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->sentence(3),
        'acronym' => $faker->word(),
        'description' => $faker->paragraph(),
        'type' => $faker->randomElement(['T','V','O','M']),
        'image' => 'loading.gif',
    ];
});

$factory->define(App\Notice::class, function (Faker\Generator $faker) {

    return [
        'user_id' => rand(1,10),
        'title' => $faker->sentence(3),
        'content' => $faker->paragraph(),
        'onlyadmin' => $faker->randomElement([True,False,False,False,False,False]),
    ];
});

$factory->define(App\Configuration::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->sentence(2),
        'value' => $faker->word(),
        'content' => $faker->paragraph(),
    ];
});

$factory->define(App\Operation::class, function (Faker\Generator $faker) {

    return [
        'user_id' => rand(1,10),
        'strategy_id' => rand(1,50),
        'stock' => $faker->randomElement(['WINFUT','WDOFUT','PETR4','VALE5','ABEV3','BBAS3','ITUB4','USIM5','CMIG4','ELET6']),
        'amount' => $faker->randomElement([1000,500,800,600,300]),
        'buyorsell' => 'C',
        'realorsimulated' => $faker->randomElement(['R','S']),
        'gtime' => 'D',
        'preventry' => $faker->randomFloat(2, 10, 13),
        'prevtarget' => $faker->randomFloat(2, 15, 24),
        'prevstop' => $faker->randomFloat(2, 5, 8.9),
        'preanalysis' => '|||',
        'preimage' => '|||',
        'postanalysis' => '|||',
        'postimage' => '|||',
        'result' => $faker->randomFloat(2, -2, 6),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {

    return [
        'user_id' => rand(1,15),
        'operation_id' => rand(1,50),
        'content' => $faker->sentence(20),
        'like' => rand(1,50),
        'dislike' => rand(1,20),
    ];
});

$factory->define(App\Answer::class, function (Faker\Generator $faker) {

    return [
        'user_id' => rand(1,15),
        'comment_id' => rand(1,300),
        'content' => $faker->sentence(20),
    ];
});
