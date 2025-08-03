<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        Permission::firstOrCreate(['name' => 'manage inventory'])->syncRoles([$adminRole, $managerRole]);
        Permission::firstOrCreate(['name' => 'request item'])->assignRole($staffRole);
    }
}

