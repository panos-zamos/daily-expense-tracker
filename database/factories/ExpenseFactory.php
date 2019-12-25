<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Expense;
use Faker\Generator as Faker;

$factory->define(Expense::class, function (Faker $faker) {
    return [
        'amount' => rand(3, 15) * 100,
        'gain' => false,
        'note' => $faker->words(3, true),
    ];
});
