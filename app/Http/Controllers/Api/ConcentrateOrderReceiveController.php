<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdminRoleEnum;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConcentrateOrderReceiveResource;
use App\Http\Resources\OrderStatusResource;
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
    public function index(Request $request)
    {
        $currentUser = auth()->user();
        $orderCode = $request->order_code;
        $userFrom = $request->user_from;
        $userTo = $request->user_to;

        $orders = Order::query()
            ->when(isset($orderCode), function ($query) use ($orderCode) {
                $query->where('order_code', 'like', '%' . $orderCode . '%');
            })
            ->when(isset($userFrom), function ($query) use ($userFrom) {
                $query->whereIn('user_id', $userFrom);
            })
            ->when(isset($userTo), function ($query) use ($userTo) {
                $query->where('full_name', 'like', '%' . $userTo . '%');
            })
            ->when(!$currentUser->hasRoleCode(AdminRoleEnum::MASTER_ADMIN), function ($subBuilder) use ($currentUser) {
                $subBuilder->whereHas('orderStatuses', function ($query) use ($currentUser) {
                    $query->where(function ($subQuery) use ($currentUser) {
                        $subQuery->Where(function ($builder) use ($currentUser) {
                                $builder->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_SEND)
                                    ->where('receive_point_id', $currentUser->adminProfile->concentrate_point_id);
                            });
                    });
                    $query->orWhere(function ($subQuery) use ($currentUser) {
                        $subQuery->where(function ($builder) use ($currentUser) {
                            $builder->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_SEND)
                                ->where('receive_point_id', $currentUser->adminProfile->concentrate_point_id);
                        });
                    });
                });
            })
            ->latest()
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

    public function changeConcentrateStatus(string $id, Request $request)
    {
        $order = Order::findOrFail($id);
        $status = $request->status ?? 1;

        DB::beginTransaction();
        try {
            $orderTransaction = OrderStatus::where('order_id', $id)
                ->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_SEND)
                ->first();

            $orderConcentrate = OrderStatus::where('order_id', $id)
                ->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_RECEIVE)
                ->first();

            if ($status == 1 && !$orderConcentrate) {
                $order->orderStatuses()->create([
                    'order_id' => $order->id,
                    'type' => OrderStatusEnum::TRANSIT_TO_CONCENTRATE_RECEIVE,
                    'send_point_id' => $orderTransaction->receive_point_id,
                    'receive_point_id' => $orderTransaction->receive_point_id,
                ]);
            } elseif ($status == 1 && $orderConcentrate) {
                $orderConcentrate->update([
                    'type' => OrderStatusEnum::TRANSIT_TO_CONCENTRATE_RECEIVE,
                    'send_point_id' => $orderTransaction->receive_point_id,
                    'receive_point_id' => $orderTransaction->receive_point_id,
                ]);
            } elseif ($status == 0) {
                $orderConcentrate?->delete();
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

        DB::beginTransaction();
        try {
            $orderConcentrate = OrderStatus::where('order_id', $id)
                ->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_SEND)
                ->first();

            $orderConcentrateDestination = OrderStatus::where('order_id', $id)
                ->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE)
                ->first();
    
            if ($status == 1 && !$orderConcentrateDestination) {
                $order->orderStatuses()->create([
                    'order_id' => $order->id,
                    'type' => OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE,
                    'send_point_id' => $orderConcentrate->receive_point_id,
                    'receive_point_id' => $orderConcentrate->receive_point_id,
                ]);
            } elseif ($status == 1 && $orderConcentrateDestination) {
                $orderConcentrateDestination->update([
                    'type' => OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE,
                    'send_point_id' => $orderConcentrate->receive_point_id,
                    'receive_point_id' => $orderConcentrate->receive_point_id,
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
}
