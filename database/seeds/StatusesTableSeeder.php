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
            'parent_status_id' => 0,
            'next_status_id' => 1,
            'role_id' => 2
        ]);

        Status::create([
            'name' => 'مشاهده توسط سوپروایزر',
            'parent_status_id' => 1,
            'role_id' => 2
        ]);

        Status::create([
            'name' => 'تایید توسط سوپروایزر',
            'parent_status_id' => 2,
            'next_status_id' => 8,
            'role_id' => 2
        ]);

        Status::create([
            'name' => 'رد توسط سوپروایزر',
            'parent_status_id' => 2,
            'next_status_id' => 8,
            'role_id' => 2
        ]);

        Status::create([
            'name' => 'ارسال به مدیر',
            'parent_status_id' => 2,
            'role_id' => 2
        ]);

        Status::create([
            'name' => 'تایید توسط مدیر',
            'parent_status_id' => 5,
            'next_status_id' => 8,
            'role_id' => 3
        ]);

        Status::create([
            'name' => 'رد توسط مدیر',
            'parent_status_id' => 5,
            'next_status_id' => 8,
            'role_id' => 3
        ]);

        Status::create([
            'name' => 'اتمام فرایند',
            'role_id' => 1
        ]);
    }
}
