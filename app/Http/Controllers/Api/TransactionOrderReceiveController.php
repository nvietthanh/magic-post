<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderStatusResource;
use App\Http\Resources\TransactionOrderReceiveResource;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class TransactionOrderReceiveController extends Controller
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
                    $subQuery->where('type', OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_SEND)
                        ->where('receive_point_id', $currentUser->adminProfile->transaction_point_id);
                });
                $query->orWhere(function ($subQuery) use ($currentUser) {
                    $subQuery->where('type', OrderStatusEnum::RETURN_TO_TRANSACTION)
                        ->where('receive_point_id', $currentUser->adminProfile->transaction_point_id);
                });
            })
            ->paginate(10);

        return TransactionOrderReceiveResource::collection($orders);
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

    public function changeTransactionStatus(string $id, Request $request)
    {
        $currentUser = auth()->user();
        $order = Order::findOrFail($id);
        $status = $request->status ?? 1;

        DB::beginTransaction();
        try {
            $orderTransaction = OrderStatus::where('order_id', $id)
                ->where('type', OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE)
                ->first();
            $orderTransactionUser = OrderStatus::where('order_id', $id)
                ->where('type', OrderStatusEnum::DELIVERED_TO_CUSTOMER_SEND)
                ->first();

            if ($status == 1 && !$orderTransaction) {
                $order->orderStatuses()->create([
                    'order_id' => $order->id,
                    'type' => OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE,
                    'send_point_id' => $currentUser->adminProfile->transaction_point_id,
                    'receive_point_id' => $currentUser->adminProfile->transaction_point_id,                
                ]);
                $order->orderStatuses()->create([
                    'order_id' => $order->id,
                    'type' => OrderStatusEnum::DELIVERED_TO_CUSTOMER_SEND,
                    'send_point_id' => $currentUser->adminProfile->transaction_point_id,
                    'receive_point_id' => $currentUser->adminProfile->transaction_point_id,                
                ]);
            } elseif ($status == 1 && $orderTransaction) {
                $orderTransaction->update([
                    'type' => OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE,
                    'send_point_id' => $currentUser->adminProfile->transaction_point_id,
                    'receive_point_id' => $currentUser->adminProfile->transaction_point_id,  
                ]);
            } elseif ($status == 0) {
                $orderTransaction?->delete();
                $orderTransactionUser?->delete();
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
}
