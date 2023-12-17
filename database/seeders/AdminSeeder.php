<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'uuid' => 'NV000001',
                'email' => 'master_admin@yopmail.com',
                'password' => bcrypt('12345678'),
                'password_not_hash' => Crypt::encryptString('12345678'),
                'profile' => [
                    'first_name' => 'master',
                    'last_name' => 'admin',
                    'gender' => '1',
                    'phone' => '035818181',
                    'address' => 'Address 1',
                ],
                'role' => 'master admin'
            ],
            [
                'uuid' => 'NV000002',
                'email' => 'head_transaction_admin_1@yopmail.com',
                'password' => bcrypt('12345678'),
                'password_not_hash' => Crypt::encryptString('12345678'),
                'profile' => [
                    'first_name' => 'head transaction',
                    'last_name' => 'admin',
                    'gender' => '1',
                    'phone' => '035818181',
                    'address' => 'Address 2',
                    'transaction_point_id' => 1
                ],
                'role' => 'head of transaction admin'
            ],
            [
                'uuid' => 'NV000003',
                'email' => 'head_concentrate_admin_1@yopmail.com',
                'password' => bcrypt('12345678'),
                'password_not_hash' => Crypt::encryptString('12345678'),
                'profile' => [
                    'first_name' => 'head concentrate',
                    'last_name' => 'last_name',
                    'gender' => '1',
                    'phone' => '035818181',
                    'address' => 'Address 3',
                    'concentrate_point_id' => 1
                ],
                'role' => 'head of concentrate admin'
            ],
            [
                'uuid' => 'NV000004',
                'email' => 'manager_transaction_admin_1@yopmail.com',
                'password' => bcrypt('12345678'),
                'password_not_hash' => Crypt::encryptString('12345678'),
                'profile' => [
                    'first_name' => 'manager transaction',
                    'last_name' => 'admin',
                    'gender' => '1',
                    'phone' => '035818181',
                    'address' => 'Address 4',
                    'transaction_point_id' => 1
                ],
                'role' => 'manager of transaction admin'
            ],
            [
                'uuid' => 'NV000005',
                'email' => 'manager_concentrate_admin_1@yopmail.com',
                'password' => bcrypt('12345678'),
                'password_not_hash' => Crypt::encryptString('12345678'),
                'profile' => [
                    'first_name' => 'manager concentrate',
                    'last_name' => 'admin',
                    'gender' => '1',
                    'phone' => '035818181',
                    'address' => 'Address 5',
                    'concentrate_point_id' => 1
                ],
                'role' => 'manager of concentrate admin'
            ],
        ];

        foreach ($admins as $data) {
            $profile = $data['profile'];
            $role = $data['role'];
            unset($data['profile']);
            unset($data['role']);

            $admin = Admin::create($data);
            $admin->assignRole($role);
            $admin->adminProfile()->create($profile);
        }
    }
}
