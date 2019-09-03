<?php

use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/createUser', function () {
    $faker = Faker\Factory::create();
    User::create([
        'firstname' => $faker->firstNameMale,
        'lastname' => $faker->lastName,
        'personal_number' => $faker->unique()->numerify('#######'),
        'melli_code' => $faker->unique()->numerify('##########'),
        'birthdate' => '1375-05-26',
        'user_level' => 3,
        'password' => 'secret'
    ]);

    User::create([
        'firstname' => $faker->firstNameMale,
        'lastname' => $faker->lastName,
        'personal_number' => $faker->unique()->numerify('#######'),
        'melli_code' => $faker->unique()->numerify('##########'),
        'birthdate' => '1377-02-18',
        'user_level' => 2,
        'password' => 'secret'
    ]);

    User::create([
        'firstname' => $faker->firstNameFemale,
        'lastname' => $faker->lastName,
        'personal_number' => $faker->unique()->numerify('#######'),
        'melli_code' => $faker->unique()->numerify('##########'),
        'birthdate' => '1375-01-06',
        'user_level' => 1,
        'password' => 'secret'
    ]);
});

Route::get('/', function () {
    return view('welcome');
});
