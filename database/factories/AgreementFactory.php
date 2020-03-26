<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agreement;
use Faker\Generator as Faker;

$factory->define(Agreement::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->realText($maxNbChars = 200, $indexSize = 1),
        'type' => $faker->word,
        'tags' => $faker->word($nb = 5, $variableNbWords = true),
        'startdate' => $faker->dateTime($max = 'now', $timezone = null),
        'enddate' => $faker->dateTime($max = 'now', $timezone = null),
        'purpose' => $faker->realText($maxNbChars = 200, $indexSize = 1),
    ];
});
