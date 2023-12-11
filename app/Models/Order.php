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

    public function orderDetail()
    {
        return $this->hasOne(OrderDetail::class, 'order_id', 'id');
    }
}

