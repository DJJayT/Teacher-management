<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::find(1);

        $admin->givePermissionTo('user.create');
        $admin->givePermissionTo('user.change_password');
        $admin->givePermissionTo('user.delete');
    }
}
