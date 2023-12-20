<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConcentrateOrderSendResource;
use App\Http\Resources\OrderStatusResource;
use App\Models\ConcentratePoint;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ConcentrateOrderSendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = auth()->user();

        $orders = Order::query()
            ->whereHas('orderStatuses', function ($query) use ($currentUser) {
                $query->where(function ($subQuery) use ($currentUser) {
                    $subQuery->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_RECEIVE)
                        ->where('receive_point_id', $currentUser->adminProfile->concentrate_point_id);
                })
                ->orWhere(function ($subQuery) use ($currentUser) {
                    $subQuery->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE)
                        ->where('receive_point_id', $currentUser->adminProfile->concentrate_point_id);
                });
            })
            ->paginate(10);

        return ConcentrateOrderSendResource::collection($orders);
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

    public function changeConcentrateStatus(string $id, Request $request)
    {
        $currentUser = auth()->user();
        $order = Order::findOrFail($id);
        $status = $request->status ?? 1;

        DB::beginTransaction();
        try {
            $orderConcentrateDestination = OrderStatus::where('order_id', $id)
                ->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_SEND)
                ->first();

            if ($status && !$orderConcentrateDestination) {
                $order->orderStatuses()->create([
                    'order_id' => $order->id,
                    'type' => OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_SEND,
                    'send_point_id' => $currentUser->adminProfile->concentrate_point_id,
                    'receive_point_id' => $request->concentrate_point_id,
                ]);
            } elseif ($status && $orderConcentrateDestination) {
                $orderConcentrateDestination->update([
                    'order_id' => $order->id,
                    'type' => OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_SEND,
                    'send_point_id' => $currentUser->adminProfile->concentrate_point_id,
                    'receive_point_id' => $request->concentrate_point_id,
                ]);
            } elseif ($status == 0) {
                $orderConcentrateDestination?->delete();
            }

            DB::commit();
            return $this->sendSuccessResponse($order, 'Cập nhật trạng thái đơn hàng thành công');
        } catch (Throwable $e) {
            DB::rollback();
            return $this->sendErrorResponse('Có lỗi trong quá trình thực hiện.', $e->getMessage());
        }
    }

    public function changeConcentrateDesStatus(string $id, Request $request)
    {
        $order = Order::findOrFail($id);
        $status = $request->status ?? 1;
        $currentUser = auth()->user();

        DB::beginTransaction();
        try {
            $orderConcentrateDestination = OrderStatus::where('order_id', $id)
                ->where('type', OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_SEND)
                ->first();

            if ($status == 1 && !$orderConcentrateDestination) {
                $order->orderStatuses()->create([
                    'order_id' => $order->id,
                    'type' => OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_SEND,
                    'send_point_id' => $currentUser->adminProfile->concentrate_point_id,
                    'receive_point_id' => $order->delivery_district_id,
                ]);
            } elseif ($status == 1 && $orderConcentrateDestination) {
                $orderConcentrateDestination->update([
                    'type' => OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_SEND,
                    'send_point_id' => $currentUser->adminProfile->concentrate_point_id,
                    'receive_point_id' => $order->delivery_district_id,
                ]);
            } elseif ($status == 0) {
                $orderConcentrateDestination?->delete();
            }

            DB::commit();
            return $this->sendSuccessResponse($order, 'Cập nhật trạng thái đơn hàng thành công');
        } catch (Throwable $e) {
            DB::rollback();
            return $this->sendErrorResponse('Có lỗi trong quá trình thực hiện.', $e->getMessage());
        }
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

    public function getConcentratePoint(string $provinceId)
    {
        $concentratePoints = ConcentratePoint::query()
            ->with('district.province')
            ->where('district_id', $provinceId)->get();

        return response()->json([
            'data' => $concentratePoints
        ]);
    }
}
