<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManagerPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [];
        array_push($permissions, Permission::create([
            'name' => 'create user'
        ]));

        array_push($permissions, Permission::create([
            'name' => 'read users'
        ]));

        array_push($permissions, Permission::create([
            'name' => 'delete user'
        ]));

        array_push($permissions, Permission::create([
            'name' => 'update user'
        ]));

        array_push($permissions, Permission::create([
            'name' => 'create work hour'
        ]));

        array_push($permissions, Permission::create([
            'name' => 'create salary'
        ]));

        array_push($permissions, Permission::create([
            'name' => 'update demand'
        ]));

        $role = Role::where('name', 'manager')->first();

        $role->syncPermissions($permissions);
    }
}
