<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'uuid' => 'AM000001',
                'email' => 'user@yopmail.com',
                'password' => bcrypt('12345678'),
                'profile' => [
                    'first_name' => 'first_name',
                    'last_name' => 'last_name',
                    'gender' => '1',
                    'phone' => '0358382150',
                    'address' => 'address 1',
                ]
            ],
        ];

        foreach ($users as $data) {
            $profile = $data['profile'];
            unset($data['profile']);

            $user = User::create($data);
            $user->userProfile()->create($profile);
        }
    }
}
