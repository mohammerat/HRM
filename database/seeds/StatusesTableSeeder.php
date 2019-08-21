<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'درانتظار',
            'next_status_id' => 2,
            'role_id' => 2
        ]);

        Status::create([
            'name' => 'مشاهده توسط سوپروایزر',
            'next_status_id' => 0,
            'role_id' => 2
        ]);

        Status::create([
            'name' => 'تایید توسط سوپروایزر',
            'next_status_id' => -1,
            'role_id' => 2
        ]);

        Status::create([
            'name' => 'رد توسط سوپروایزر',
            'next_status_id' => -1,
            'role_id' => 2
        ]);

        Status::create([
            'name' => 'ارسال به مدیر',
            'next_status_id' => 0,
            'role_id' => 2
        ]);
    }
}
