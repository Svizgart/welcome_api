<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Participant;
use App\Models\Event;

$factory->define(Participant::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
    ];
});
