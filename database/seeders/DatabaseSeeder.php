<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProvincesSeeder::class,
            DistrictSeeder::class,
            TransactionPointSeeder::class,
            ConcentratePointSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
        ]);
    }
}
