<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'gallery_id' => null,
        'path' => 'https://loremflickr.com/640/480/computer'
    ];
});
