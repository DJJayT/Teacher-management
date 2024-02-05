<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [];

        $permissions[] = [
            'name' => 'user.create',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $permissions[] = [
            'name' => 'user.edit',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $permissions[] = [
            'name' => 'user.delete',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ];

        Permission::insert($permissions);
    }
}
