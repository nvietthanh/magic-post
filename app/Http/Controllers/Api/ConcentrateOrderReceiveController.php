<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConcentrateOrderReceiveResource;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ConcentrateOrderReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = auth()->user();

        $orders = Order::query()
            ->whereHas('orderStatuses', function ($query) use ($currentUser) {
                $query->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE)
                    ->where('concentrate_point_id', $currentUser->adminProfile->concentrate_point_id);
            })
            ->paginate(10);

        return ConcentrateOrderReceiveResource::collection($orders);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changeReceiveStatus(string $id, Request $request)
    {
        $order = Order::findOrFail($id);
        $status = $request->status ?? 1;

        DB::beginTransaction();
        try {
            $orderStatus = OrderStatus::where('order_id', $id)
                ->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE)
                ->firstOrFail();
            $orderConcentrateDestination = OrderStatus::where('order_id', $id)
                ->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION)
                ->first();
    
            $orderStatus->update([
                'status' => $status,
            ]);

            if ($status == 1 && !$orderConcentrateDestination) {
                $order->orderStatuses()->create([
                    'order_id' => $orderStatus->order_id,
                    'type' => OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION,
                    'status' => 0,
                ]);
            } elseif ($orderConcentrateDestination) {
                $orderConcentrateDestination->delete();
            }

            DB::commit();
            return $this->sendSuccessResponse($order, 'Cập nhật trạng thái đơn hàng thành công');
        } catch (Throwable $e) {
            DB::rollback();
            return $this->sendErrorResponse('Có lỗi trong quá trình thực hiện.', $e->getMessage());
        }
    }
}
