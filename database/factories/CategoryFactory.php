<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Category 1', 'Category 2', 'Category 3', 'Category 4', 'Category 5'])
    ];
});
