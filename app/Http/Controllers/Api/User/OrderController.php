<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderStatusResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = auth('web')->user();
        $filterOrderCode = $request->order_code;
        $filterName = $request->name;

        $orders = Order::query()
            ->where('user_id', $currentUser->id)
            ->when($filterOrderCode, function ($query) use ($filterOrderCode) {
                $query->where('order_code', 'like', '%' . $filterOrderCode . '%');
            })
            ->when($filterName, function ($query) use ($filterName) {
                $query->where('full_name', 'like', '%' . $filterName . '%');
            })
            ->paginate(10);

        return OrderStatusResource::collection($orders);
    }

    public function search(Request $request)
    {
        $filterOrderCode = $request->order_code;
        $filterPhone = $request->phone;

        $order = Order::query()
            ->where('order_code', $filterOrderCode)
            ->where('phone_number', $filterPhone)
            ->get();

        if (!$order) {
            return response()->json([
                'data' => []
            ]);
        }
        
        return OrderStatusResource::collection($order);
    }
}
