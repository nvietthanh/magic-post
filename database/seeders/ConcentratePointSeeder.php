<?php

namespace Database\Seeders;

use App\Models\ConcentratePoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConcentratePointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'district_id' => 1,
                'name' => 'Điểm tiếp nhận 1',
                'address' => 'Address 1'
            ],
            [
                'district_id' => 1,
                'name' => 'Điểm tiếp nhận 2',
                'address' => 'Address 3'
            ],
            [
                'district_id' => 2,
                'name' => 'Điểm tiếp nhận 1',
                'address' => 'Address 3'
            ],
        ];

        foreach ($data as $value) {
            ConcentratePoint::create($value);
        }
    }
}
