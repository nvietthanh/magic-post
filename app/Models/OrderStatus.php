<?php

namespace App\Models;

use App\Http\Resources\OrderStatusChartResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function getOrderByChart($period, $items, $typeOrder, $fieldTime)
    {
        $dataPeriod = [];
        $titleBottomChart = [];
        $formData = [];
        foreach ($period as $key => $date) {
            $totalField = $items->where($fieldTime, '>=', $date->startOfDay())
                ->where($fieldTime, '<=', $date->endOfDay())
                ->where('type', $typeOrder);
            if ($totalField->count() != 0) {
                $dataPeriod[$key] = $totalField->count();
            } else {
                $dataPeriod[$key] = 0;
            }
            $formData[] = OrderStatusChartResource::collection($totalField);
        }
        foreach ($period as $date) {
            $titleBottomChart[] = Carbon::parse($date)->format('d/m/Y');
        }
        return [
            'dataPeriod' => $dataPeriod,
            'titleBottomChart' => $titleBottomChart,
            'formData' => $formData
        ];
    }
}
