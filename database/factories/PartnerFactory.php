<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Partner;
use Faker\Generator as Faker;

$factory->define(Partner::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->unique()->company,
        'abbreviation' => $faker->word,
        'location' => $faker->state,
        'type' => $faker->word,
        'address' => $faker->address,
        'country' => $faker->country,
        'field' => $faker->word,
        'logo' => imagecreatefromjpeg('https://picsum.photos/200'),
    ];
});
