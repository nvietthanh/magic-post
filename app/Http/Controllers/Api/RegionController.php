<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function getProvinceAll()
    {
        $provinces = Province::select('id', 'name')->get();

        return response()->json([
            'data' => $provinces
        ]);
    }

    public function getDistrict($province_id)
    {
        $districts = District::where('province_id', $province_id)
            ->select('id', 'name', 'province_id')
            ->get();

        return response()->json([
            'data' => $districts
        ]);
    }
}
