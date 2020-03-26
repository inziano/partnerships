<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {

    $gender = $faker->randomElement(['male', 'female']);
    return [
        //
        'firstname' => $faker->firstName($gender),
        'lastname' => $faker->lastName($gender),
        'email' => $faker->unique()->email,
        'gender' => $gender,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'organisation' =>$faker->company,
        'country' => $faker->country,
        'designation' => $faker->jobTitle,
    ];
});
