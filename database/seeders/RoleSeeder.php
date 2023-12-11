<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'master admin',
                'guard_name' => 'admin',
                'role_code' => Str::slug('master admin')
            ],
            [
                'name' => 'head of transaction admin',
                'guard_name' => 'admin',
                'role_code' => Str::slug('head of transaction admin')
            ],
            [
                'name' => 'manager of transaction admin',
                'guard_name' => 'admin',
                'role_code' => Str::slug('manager of transaction admin')
            ],
            [
                'name' => 'head of concentrate admin',
                'guard_name' => 'admin',
                'role_code' => Str::slug('head of concentrate admin')
            ],
            [
                'name' => 'manager of concentrate admin',
                'guard_name' => 'admin',
                'role_code' => Str::slug('manager of concentrate admin')
            ],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
