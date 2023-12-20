<?php

namespace App\Http\Resources;

use App\Enums\OrderGuideEnum;
use App\Enums\OrderStatusEnum;
use App\Models\OrderStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionOrderSendResource extends JsonResource
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
            'user_id' => $this->user_id,
            'email' => $this->user->email,
            'user_name' => $this->user->userProfile->full_name,
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
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i'),
        ];
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
        $currentUser = auth()->user();
        $listStatus = OrderStatusEnum::All;
        $lastOrderStatus = $orderStatus->last();

        foreach ($listStatus as $status) {
            if ($status['value'] == $lastOrderStatus->type) {
                $statusText = $status['label'];
                $processText = $status['text'];
                break;
            }
        }

        foreach ($orderStatus as $status) {
            if (
                $status->type == OrderStatusEnum::PENDING_APPROVAL && 
                $status->receive_point_id == $currentUser->adminProfile->transaction_point_id
            ){
                $statusNumber = OrderStatusEnum::PENDING_APPROVAL;
                break;
            } elseif (
                $status->type == OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE && 
                $status->receive_point_id == $currentUser->adminProfile->transaction_point_id
            ) {
                $statusNumber = OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE;
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
