<?php

namespace Database\Seeders;

use App\Models\TransactionPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'district_id' => 1,
                'name' => 'Điểm giao dịch 1',
                'address' => 'Address 1'
            ],
            [
                'district_id' => 2,
                'name' => 'Điểm giao dịch 2',
                'address' => 'Address 2'
            ],
        ];

        foreach ($data as $value) {
            TransactionPoint::create($value);
        }
    }
}
