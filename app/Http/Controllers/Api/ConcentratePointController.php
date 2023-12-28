<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdminRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConcentratePointRequest;
use App\Http\Resources\ConcentratePointResource;
use App\Models\Admin;
use App\Models\ConcentratePoint;
use App\Models\District;
use Illuminate\Http\Request;

class ConcentratePointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nameFilter = $request->name;
        $provinceFilter = $request->province_id;
        $districtFilter = $request->district_id;

        $concentratePoints = ConcentratePoint::query()
            ->when(isset($nameFilter), function ($query) use ($nameFilter) {
                $query->whereLike('name', $nameFilter);
            })
            ->when(isset($districtFilter), function ($query) use ($districtFilter) {
                $query->where('district_id', $districtFilter);
            })
            ->when(isset($provinceFilter), function ($query) use ($provinceFilter) {
                $query->whereHas('district', function ($subQuery) use ($provinceFilter) {
                    $subQuery->where('province_id', $provinceFilter);
                });
            })
            ->latest()
            ->paginate(10);

        return ConcentratePointResource::collection($concentratePoints);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConcentratePointRequest $request)
    {
        $data = $request->validated();

        $concentratePoint = ConcentratePoint::create($data);

        return $this->sendSuccessResponse($concentratePoint, 'Tạo điểm tập kết thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConcentratePointRequest $request, string $id)
    {
        $data = $request->validated();

        $concentratePoint = ConcentratePoint::create($data);

        $concentratePoint->update($data);

        return $this->sendSuccessResponse($concentratePoint->get(), 'Cập nhật điểm tập kết thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

    public function getConcentrateAdmin(Request $request)
    {
        $adminIds = [];
        $concentratePoint = ConcentratePoint::whereId($request->id)->first();
        if ($concentratePoint) {
            $adminIds = $concentratePoint->adminProfiles()->pluck('admin_id');
        }

        $headAdmins = Admin::query()
            ->with('adminProfile')
            ->whereHas('roles', function ($query) {
                $query->where('role_code', AdminRoleEnum::HEAD_CONCENTRATE_ADMIN);
            })
            ->whereHas('adminProfile', function ($query) use ($adminIds){
                $query->where(function ($subQuery) use ($adminIds){
                    $subQuery->whereNull('concentrate_point_id')
                        ->whereNull('transaction_point_id')
                        ->orWhereIn('id', $adminIds);
                });
            })
            ->get();

        $managerAdmins = Admin::query()
            ->with('adminProfile')
            ->whereHas('roles', function ($query) {
                $query->where('role_code', AdminRoleEnum::MANAGER_CONCENTRATE_ADMIN);
            })
            ->whereHas('adminProfile', function ($query) use ($adminIds){
                $query->where(function ($subQuery) use ($adminIds){
                    $subQuery->whereNull('concentrate_point_id')
                        ->whereNull('transaction_point_id')
                        ->orWhereIn('id', $adminIds);
                });
            })
            ->get();

        return response()->json([
            'data' => [
                'manager_admins' => $managerAdmins,
                'head_admins' => $headAdmins
            ]
        ]);
    }

    public function getAll()
    {
        $concentratePoints = ConcentratePoint::all();

        return ConcentratePointResource::collection($concentratePoints);
    }
}
