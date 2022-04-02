<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        factory(\App\User::class)->create([
            'name' => $faker->userName,
            'lastName' => $faker->lastName,
            'email' => 'admin@none.no',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            'is_admin' => true,
            'is_manager' => true
        ]);

        for($i = 0; $i < 5; $i++)
        {
            factory(\App\User::class)->create([
                'name' => $faker->userName,
                'lastName' => $faker->lastName,
                'email' => $faker->email,
                'password' => \Illuminate\Support\Facades\Hash::make('secret'),
            ]);
        }
    }
}
