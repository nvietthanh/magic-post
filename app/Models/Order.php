<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function orderStatuses()
    {
        return $this->hasMany(OrderStatus::class, 'order_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function receiveDistrict()
    {
        return $this->hasOne(District::class, 'id', 'receive_district_id');
    }

    public function deliveryDistrict()
    {
        return $this->hasOne(District::class, 'id', 'delivery_district_id');
    }
}

