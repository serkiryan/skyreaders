<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Book;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Book::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('ru_RU');
    return [
        'author' => $faker->name,
        'title' => $faker->realText($maxNbChars = 20, $indexSize = 2)
    ];
});
