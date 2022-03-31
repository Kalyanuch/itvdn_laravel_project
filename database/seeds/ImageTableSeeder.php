<?php

use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Gallery::all()->each(function($gallery) {
            $images = factory(\App\Image::class, (int)mt_rand(1, 8))->create();

            $gallery->images()->saveMany($images);
        });
    }
}
