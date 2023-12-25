<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdminRoleEnum;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderSendStoreRequest;
use App\Http\Resources\OrderStatusResource;
use App\Http\Resources\TransactionOrderSendResource;
use App\Models\ConcentratePoint;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class TransactionOrderSendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = auth()->user();

        $orders = Order::query()
            ->when(!$currentUser->hasRoleCode(AdminRoleEnum::MASTER_ADMIN), function ($subBuilder) use ($currentUser) {
                $subBuilder->whereHas('orderStatuses', function ($builder) use ($currentUser) {
                    $builder->where(function ($query) use ($currentUser) {
                        $query->where(function ($subQuery) use ($currentUser) {
                            $subQuery->where('type', OrderStatusEnum::PENDING_APPROVAL)
                                ->where('receive_point_id', $currentUser->adminProfile->transaction_point_id);
                        });
                    });
                    $builder->orWhere(function ($query) use ($currentUser) {
                        $query->where(function ($subQuery) use ($currentUser) {
                            $subQuery->where('type', OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE)
                                ->where('receive_point_id', $currentUser->adminProfile->transaction_point_id);
                        });
                    });
                });
            })
            ->paginate(10);

        return TransactionOrderSendResource::collection($orders);
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
    public function store(OrderSendStoreRequest $request)
    {
        $data = $request->validated();
        $currentUser = auth()->user();

        DB::beginTransaction();
        try {
            $products = $data['products'];
            $numberAdmin = Order::max('id');
            $data['order_code'] = 'DH' . str_pad($numberAdmin + 1, 6, '0', STR_PAD_LEFT);
            $data['admin_id'] = $currentUser->id;
            $data['receive_district_id'] = $currentUser->adminProfile->transaction_point_id;
            unset($data['products']);
            
            $order = Order::create($data);

            $order->orderStatuses()->create([
                'type' => OrderStatusEnum::PENDING_APPROVAL,
                'send_point_id' => $currentUser->adminProfile->transaction_point_id,
                'receive_point_id' => $currentUser->adminProfile->transaction_point_id,
            ]);

            foreach ($products as $product) {
                $order->orderDetails()->create($product);
            }
            
            DB::commit();
            return $this->sendSuccessResponse($order, 'Tạo đơn hàng thành công');
        } catch (Throwable $e) {
            DB::rollback();
            return $this->sendErrorResponse('Có lỗi trong quá trình thực hiện.', $e->getMessage());
        }
    }

    public function changeTransactionStatus(string $id, Request $request)
    {
        $currentUser = auth()->user();
        $order = Order::findOrFail($id);
        $status = $request->status ?? 1;

        DB::beginTransaction();
        try {
            $orderTransaction = OrderStatus::where('order_id', $id)
                ->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_SEND)
                ->first();

            if ($status == 1 && !$orderTransaction) {
                $order->orderStatuses()->create([
                    'order_id' => $order->id,
                    'type' => OrderStatusEnum::TRANSIT_TO_CONCENTRATE_SEND,
                    'send_point_id' => $currentUser->adminProfile->transaction_point_id,
                    'receive_point_id' => $request->concentrate_point_id,                
                ]);
            } elseif ($status == 1 && $orderTransaction) {
                $orderTransaction->update([
                    'order_id' => $order->id,
                    'type' => OrderStatusEnum::TRANSIT_TO_CONCENTRATE_SEND,
                    'send_point_id' => $currentUser->adminProfile->transaction_point_id,
                    'receive_point_id' => $request->concentrate_point_id
                ]);
            } elseif ($status == 0) {
                $orderTransaction?->delete();
            }

            DB::commit();
            return $this->sendSuccessResponse($order, 'Cập nhật trạng thái đơn hàng thành công');
        } catch (Throwable $e) {
            DB::rollback();
            return $this->sendErrorResponse('Có lỗi trong quá trình thực hiện.', $e->getMessage());
        }
    }

    public function changeTransactionDesStatus(string $id, Request $request)
    {
        $currentUser = auth()->user();
        $order = Order::findOrFail($id);
        $status = $request->status ?? 7;

        $orderUser = OrderStatus::where('order_id', $id)
            ->where('type', OrderStatusEnum::DELIVERED_TO_CUSTOMER_RECEIVE)
            ->first();
        $orderReturn = OrderStatus::where('order_id', $id)
            ->where('type', OrderStatusEnum::RETURN_TO_TRANSACTION)
            ->first();

        DB::beginTransaction();
        try {
            if ($status == OrderStatusEnum::DELIVERED_TO_CUSTOMER_SEND) {
                $orderUser?->delete();
                $orderReturn?->delete();
            } elseif ($status == OrderStatusEnum::DELIVERED_TO_CUSTOMER_RECEIVE) {
                $order->orderStatuses()->create([
                    'order_id' => $order->id,
                    'type' => OrderStatusEnum::DELIVERED_TO_CUSTOMER_RECEIVE,
                    'send_point_id' => $currentUser->adminProfile->transaction_point_id,
                    'receive_point_id' => $currentUser->adminProfile->transaction_point_id,  
                ]);
            } elseif ($status == OrderStatusEnum::RETURN_TO_TRANSACTION) {
                $order->orderStatuses()->create([
                    'order_id' => $order->id,
                    'type' => OrderStatusEnum::RETURN_TO_TRANSACTION,
                    'send_point_id' => $currentUser->adminProfile->transaction_point_id,
                    'receive_point_id' => $order->receive_district_id,
                ]);
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
    public function update(OrderSendStoreRequest $request, string $id)
    {
        $data = $request->validated();
        $currentUser = auth()->user();
        $order = Order::findOrFail($id);

        DB::beginTransaction();
        try {
            $products = $data['products'];
            $numberAdmin = Order::max('id');
            $data['order_code'] = 'DH' . str_pad($numberAdmin + 1, 6, '0', STR_PAD_LEFT);
            $data['receive_district_id'] = $currentUser->adminProfile->transaction_point_id;
            unset($data['products']);
            
            $order->update($data);
            $order->orderDetails->map(function ($product) {
                $product->delete();
            });

            foreach ($products as $product) {
                $order->orderDetails()->create($product);
            }
            
            DB::commit();
            return $this->sendSuccessResponse($order, 'Tạo đơn hàng thành công');
        } catch (Throwable $e) {
            DB::rollback();
            return $this->sendErrorResponse('Có lỗi trong quá trình thực hiện.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return $this->sendSuccessResponse([], 'Xóa đơn hàng thành công');
    }

    public function getConcentratePoint(string $provinceId)
    {
        $concentratePoints = ConcentratePoint::query()
            ->with('district.province')
            ->where('district_id', $provinceId)->get();

        return response()->json([
            'data' =>  $concentratePoints
        ]);
    }
}
