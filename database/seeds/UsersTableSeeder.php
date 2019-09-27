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
        // $faker = \Faker\Factory::create();
        $manager = Role::find(1);
        $supervisor = Role::find(2);
        $employee = Role::find(3);

        $melli_code = '1234567890';
        $user = User::create([
            'firstname' => 'Mohammad',
            'lastname' => 'Saadat',
            'personal_number' => '24680136',
            'melli_code' => $melli_code,
            'birthdate' => '1375-05-26',
            'password' => $melli_code
        ]);
        $user->assignRole($manager);

        $melli_code = '1023456789';
        $user = User::create([
            'firstname' => 'Ali',
            'lastname' => 'Zarei',
            'personal_number' => '87676234',
            'melli_code' => $melli_code,
            'birthdate' => '1377-02-18',
            'password' => $melli_code
        ]);
        $user->assignRole($supervisor);

        $melli_code = '4234987035';
        $user = User::create([
            'firstname' => 'Maryam',
            'lastname' => 'Mirasi',
            'personal_number' => '56471408',
            'melli_code' => $melli_code,
            'birthdate' => '1375-01-06',
            'password' => $melli_code
        ]);
        $user->assignRole($employee);
    }
}
