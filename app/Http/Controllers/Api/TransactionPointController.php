<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionPointRequest;
use App\Http\Resources\TransactionPointResource;
use App\Models\TransactionPoint;
use Illuminate\Http\Request;

class TransactionPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nameFilter = $request->name;
        $provinceFilter = $request->province_id;
        $districtFilter = $request->district_id;
    
        $transactionPoints = TransactionPoint::query()
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
            ->paginate(10);

        return TransactionPointResource::collection($transactionPoints);
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
    public function store(TransactionPointRequest $request)
    {
        $data = $request->validated();

        $transactionPoint = TransactionPoint::create($data);

        return $this->sendSuccessResponse($transactionPoint, 'Tạo điểm giao dịch thành công');
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
    public function update(TransactionPointRequest $request, string $id)
    {
        $data = $request->validated();

        $transactionPoint = TransactionPoint::findOrFail($id);

        $transactionPoint->update($data);

        return $this->sendSuccessResponse($transactionPoint->get(), 'Cập nhật điểm giao dịch thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transactionPoint = TransactionPoint::findOrFail($id);

        $transactionPoint->delete();

        return $this->sendSuccessResponse([], 'Xóa điểm giao dịch thành công');
    }
}
