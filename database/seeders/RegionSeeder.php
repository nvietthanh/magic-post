<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            'region 1',
            'region 2',
            'region 3',
            'region 4',
            'region 5',
        ];

        foreach ($regions as $value) {
            Region::create([
                'name' => $value
            ]);
        }
    }
}
