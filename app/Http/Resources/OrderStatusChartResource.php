<?php

namespace App\Http\Resources;

use App\Enums\OrderGuideEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderStatusChartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $orderStatus = $this->order->orderStatuses()->orderBy('type', 'asc')->get();

        return [
            'id' => $this->id,
            'admin_id' => $this->order->admin_id,
            'admin_name' => $this->order->admin->adminProfile->full_name,
            'user_id' => $this->order->user_id,
            'order_code' => $this->order->order_code,
            'type' => $this->order->type,
            'full_name' => $this->order->full_name,
            'phone_number' => $this->order->phone_number,
            'receive_district_id' => $this->order->receive_district_id,
            'receive_district_name' => $this->order->receiveDistrict->name . ', ' . $this->order->receiveDistrict->province->name,
            'province_id' => $this->order->deliveryDistrict->province_id,
            'delivery_district_id' => $this->order->delivery_district_id,
            'delivery_district_name' => $this->order->deliveryDistrict->name . ', ' . $this->order->deliveryDistrict->province->name,
            'address' => $this->order->address,
            'note' => $this->order->note,
            'guide' => $this->order->guide,
            'guide_text' => $this->getGuide($this->order->guide),
            'products' => $this->order->orderDetails,
            'status' => $orderStatus,
            'sum_price' => $this->getSumPrice($this->order->orderDetails),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i'),
        ];
    }

    public function getSumPrice($orderDetail)
    {
        $sumPrice = 0;
        foreach ($orderDetail as $order) {
            $sumPrice += $order->sum_price;
        }

        return $sumPrice;
    }

    public function getGuide($guide)
    {
        $getGuideAll = OrderGuideEnum::GUIDE_ALL;

        foreach ($getGuideAll as $getGuide) {
            if ($getGuide['value'] == $guide) {
                return $getGuide['label'];
            }
        }
        
        return '';
    }
}
