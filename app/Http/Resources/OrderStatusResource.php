<?php

namespace App\Http\Resources;

use App\Enums\OrderGuideEnum;
use App\Enums\OrderStatusEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $orderStatus = $this->orderStatuses()->orderBy('type', 'asc')->get();
        $getStatus = $this->getOrderStatus($orderStatus);

        return [
            'id' => $this->id,
            'admin_id' => $this->admin_id,
            'admin_name' => $this->admin->adminProfile->full_name,
            'user_id' => $this->user_id,
            'order_code' => $this->order_code,
            'type' => $this->type,
            'full_name' => $this->full_name,
            'phone_number' => $this->phone_number,
            'receive_district_id' => $this->receive_district_id,
            'receive_district_name' => $this->receiveDistrict->name . ', ' . $this->receiveDistrict->province->name,
            'province_id' => $this->deliveryDistrict->province_id,
            'delivery_district_id' => $this->delivery_district_id,
            'delivery_district_name' => $this->deliveryDistrict->name . ', ' . $this->deliveryDistrict->province->name,
            'address' => $this->address,
            'note' => $this->note,
            'guide' => $this->guide,
            'guide_text' => $this->getGuide($this->guide),
            'products' => $this->orderDetails,
            'status' => $orderStatus,
            'status_number' => $getStatus['statusNumber'],
            'status_text' => $getStatus['statusText'],
            'status_process' => $getStatus['processText'],
            'sum_price' => $this->getSumPrice($this->orderDetails),
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

    public function getOrderStatus($orderStatus)
    {
        $listStatus = OrderStatusEnum::All;
        $lastOrderStatus = $orderStatus->last();

        foreach ($listStatus as $status) {
            if ($status['value'] == $lastOrderStatus->type) {
                $statusNumber = $status['value'];
                $statusText = $status['text'];
                $processText = $status['text'];
                break;
            }
        }

        return [
            'statusNumber' => $statusNumber ?? '',
            'statusText' => $statusText ?? '',
            'processText' => $processText ?? '',
        ];
    }
}
