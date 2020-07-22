<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Event::class, function (Faker $faker) {
    $name =  implode(' ', $faker->unique()->words(rand(1, 3)));

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'date' => $faker->dateTimeBetween('+1 week', '+1 month'),
        'address' => $faker->address,
        'description' => $faker->randomElement([null, $faker->text(rand(20, 255))])
    ];
});
