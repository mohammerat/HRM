<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supervisor_role = Role::where('name', 'supervisor')->first();
        $roles = Role::whereIn('name', ['supervisor', 'employee'])->get();
        $permission = Permission::create([
            'name' => 'update users'
        ]);
        $permission->syncRoles($supervisor_role);

        $permission = Permission::create([
            'name' => 'create user'
        ]);
        $permission->syncRoles($supervisor_role);

        $permission = Permission::create([
            'name' => 'create dismissal'
        ]);
        $permission->syncRoles($roles);

        $permission = Permission::create([
            'name' => 'update dismissal'
        ]);
        $permission->syncRoles($roles);

        $permission = Permission::create([
            'name' => 'create demand'
        ]);
        $permission->syncRoles($roles);

        $permission = Permission::where('name', 'update demand')->first();
        $permission->syncRoles($roles);

        $permission = Permission::create([
            'name' => 'create attendance'
        ]);
        $permission->syncRoles($roles);

        $permission = Permission::create([
            'name' => 'update attendance'
        ]);
        $permission->syncRoles($roles);

        $permission = Permission::create([
            'name' => 'delete attendance'
        ]);
        $permission->syncRoles($roles);
    }
}
