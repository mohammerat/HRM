<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $manager = Role::find(1);
        $supervisor = Role::find(2);
        $employee = Role::find(3);

        $user = User::create([
            'firstname' => $faker->firstNameMale,
            'lastname' => $faker->lastName,
            'personal_number' => $faker->unique()->numerify('#######'),
            'melli_code' => $faker->unique()->numerify('##########'),
            'birthdate' => '1375-05-26',
            'password' => 'secret'
        ]);
        $user->assignRole($manager);

        $user = User::create([
            'firstname' => $faker->firstNameMale,
            'lastname' => $faker->lastName,
            'personal_number' => $faker->unique()->numerify('#######'),
            'melli_code' => $faker->unique()->numerify('##########'),
            'birthdate' => '1377-02-18',
            'password' => 'secret'
        ]);
        $user->assignRole($supervisor);

        $user = User::create([
            'firstname' => $faker->firstNameFemale,
            'lastname' => $faker->lastName,
            'personal_number' => $faker->unique()->numerify('#######'),
            'melli_code' => $faker->unique()->numerify('##########'),
            'birthdate' => '1375-01-06',
            'password' => 'secret'
        ]);
        $user->assignRole($employee);
    }
}
