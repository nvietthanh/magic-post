<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdminRoleEnum;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getChartOrder(Request $request)
    {
        $currentUser = auth()->user();
        $endDate = $request->daterange  ? Carbon::parse($request->daterange[1]) : Carbon::now();
        $startDate = $request->daterange ? Carbon::parse($request->daterange[0]) : $endDate->copy()->subWeek();
        $typeStatus = $request->type_status ?? [];
        $receiveDistrictIds = $request->receive_district_ids ?? null;
        $deliveryDistrictIds = $request->delivery_district_ids ?? null;


        $period = CarbonPeriod::create($startDate, $endDate);
        $orders = OrderStatus::query()
            ->with('order')
            ->when($receiveDistrictIds, function ($query) use ($receiveDistrictIds) {
                $query->whereHas('order', function ($subQuery) use ($receiveDistrictIds) {
                    $subQuery->whereIn('receive_district_id', $receiveDistrictIds);
                });
            })
            ->when($deliveryDistrictIds, function ($query) use ($deliveryDistrictIds) {
                $query->whereHas('order', function ($subQuery) use ($deliveryDistrictIds) {
                    $subQuery->whereIn('delivery_district_id', $deliveryDistrictIds);
                });
            })
            ->when($currentUser->hasRoleCodes([AdminRoleEnum::MANAGER_TRANSACTION_ADMIN, AdminRoleEnum::HEAD_TRANSACTION_ADMIN]), 
                function ($query) use ($currentUser) {
                    // transaction
                    $query->where(function ($builder) use ($currentUser) {
                        $builder->where(function ($query) use ($currentUser) {
                            $query->where(function ($subQuery) use ($currentUser) {
                                $subQuery->where('type', OrderStatusEnum::PENDING_APPROVAL)
                                    ->where('receive_point_id', $currentUser->adminProfile->transaction_point_id);
                            });
                        });
                        $builder->orWhere(function ($query) use ($currentUser) {
                            $query->where(function ($subQuery) use ($currentUser) {
                                $subQuery->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_SEND)
                                    ->where('send_point_id', $currentUser->adminProfile->transaction_point_id);
                            });
                        });
                        $builder->orWhere(function ($query) use ($currentUser) {
                            $query->where(function ($subQuery) use ($currentUser) {
                                $subQuery->where('type', OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE)
                                    ->where('receive_point_id', $currentUser->adminProfile->transaction_point_id);
                            });
                        });
                    });
                    // transaction destination
                    $query->orWhere(function ($builder) use ($currentUser) {
                        $builder->where(function ($subQuery) use ($currentUser) {
                            $subQuery->where('type', OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_SEND)
                                ->where('receive_point_id', $currentUser->adminProfile->transaction_point_id);
                        });
                        $builder->orWhere(function ($subQuery) use ($currentUser) {
                            $subQuery->where(function ($builder) use ($currentUser) {
                                $builder->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE)
                                    ->where('send_point_id', $currentUser->adminProfile->concentrate_point_id);
                            });
                        });
                        $builder->orWhere(function ($subQuery) use ($currentUser) {
                            $subQuery->where('type', OrderStatusEnum::RETURN_TO_TRANSACTION)
                                ->where('receive_point_id', $currentUser->adminProfile->transaction_point_id);
                        });
                        $builder->orWhere(function ($subQuery) use ($currentUser) {
                            $subQuery->where(function ($builder) use ($currentUser) {
                                $builder->where('type', OrderStatusEnum::DELIVERED_TO_CUSTOMER_SEND)
                                    ->where('send_point_id', $currentUser->adminProfile->concentrate_point_id);
                            });
                        });
                        $builder->orWhere(function ($subQuery) use ($currentUser) {
                            $subQuery->where(function ($builder) use ($currentUser) {
                                $builder->where('type', OrderStatusEnum::DELIVERED_TO_CUSTOMER_RECEIVE)
                                    ->where('receive_point_id', $currentUser->adminProfile->concentrate_point_id);
                            });
                        });
                    });
            })
            ->when($currentUser->hasRoleCodes([AdminRoleEnum::MANAGER_CONCENTRATE_ADMIN, AdminRoleEnum::HEAD_CONCENTRATE_ADMIN]), 
                function ($query) use ($currentUser) {
                    // concentrate
                    $query->where(function ($builder) use ($currentUser) {
                        $builder->where(function ($subQuery) use ($currentUser) {
                            $subQuery->Where(function ($builder) use ($currentUser) {
                                    $builder->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_SEND)
                                        ->where('receive_point_id', $currentUser->adminProfile->concentrate_point_id);
                                });
                        });
                        $builder->orWhere(function ($subQuery) use ($currentUser) {
                            $subQuery->where(function ($builder) use ($currentUser) {
                                $builder->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_SEND)
                                    ->where('receive_point_id', $currentUser->adminProfile->concentrate_point_id);
                            });
                        });
                        $builder->orWhere(function ($subQuery) use ($currentUser) {
                            $subQuery->where(function ($builder) use ($currentUser) {
                                $builder->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_SEND)
                                    ->where('send_point_id', $currentUser->adminProfile->concentrate_point_id);
                            });
                        });
                    });
                    // concentrate destination
                    $query->orWhere(function ($builder) use ($currentUser) {
                        $builder->orWhere(function ($subQuery) use ($currentUser) {
                            $subQuery->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_RECEIVE)
                                ->where('receive_point_id', $currentUser->adminProfile->concentrate_point_id);
                        });
                        $builder->orWhere(function ($subQuery) use ($currentUser) {
                            $subQuery->where('type', OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE)
                                ->where('receive_point_id', $currentUser->adminProfile->concentrate_point_id);
                        });
                        $builder->orWhere(function ($subQuery) use ($currentUser) {
                            $subQuery->where(function ($builder) use ($currentUser) {
                                $builder->where('type', OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_SEND)
                                    ->where('send_point_id', $currentUser->adminProfile->concentrate_point_id);
                            });
                        });
                    });
            })
            ->whereBetween(DB::raw('DATE(created_at)'), [$startDate->format('Y/m/d'), $endDate->format('Y/m/d')])
            ->orderBy('created_at', 'ASC')
            ->get();

        $listOrderStatues = OrderStatusEnum::All;
        $orderStatues = [];
        $countStatues = [
            'sum' => 1
        ];
        $typeOrderRole = [];
        if ($currentUser->hasRoleCodes([AdminRoleEnum::MANAGER_TRANSACTION_ADMIN, AdminRoleEnum::HEAD_TRANSACTION_ADMIN])) {
            $typeOrderRole = [
                OrderStatusEnum::PENDING_APPROVAL, OrderStatusEnum::TRANSIT_TO_CONCENTRATE_SEND,
                OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE, OrderStatusEnum::DELIVERED_TO_CUSTOMER_SEND,
                OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_SEND, OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE,
                OrderStatusEnum::RETURN_TO_TRANSACTION, OrderStatusEnum::DELIVERED_TO_CUSTOMER_SEND, OrderStatusEnum::DELIVERED_TO_CUSTOMER_RECEIVE
            ];
        } elseif ($currentUser->hasRoleCodes([AdminRoleEnum::MANAGER_CONCENTRATE_ADMIN, AdminRoleEnum::HEAD_CONCENTRATE_ADMIN])) {
            $typeOrderRole = [
                OrderStatusEnum::TRANSIT_TO_CONCENTRATE_SEND, OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_SEND,
                OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_SEND, OrderStatusEnum::TRANSIT_TO_CONCENTRATE_RECEIVE,
                OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_SEND, OrderStatusEnum::TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE,
                OrderStatusEnum::TRANSIT_TO_TRANSACTION_DESTINATION_SEND
            ];
        }
        if (count($typeStatus) != 0 ) {
            foreach ($listOrderStatues as $orderStatus) {
                if ($currentUser->hasRoleCode(AdminRoleEnum::MASTER_ADMIN) && in_array($orderStatus['value'], $typeStatus)) {
                    $orderStatues[$orderStatus['slug']] = OrderStatus::getOrderByChart($period, $orders, $orderStatus['value'], 'created_at');
                    $countStatues[$orderStatus['slug']] = OrderStatus::where('type', $orderStatus['value'])->count();
                    if ($countStatues[$orderStatus['slug']] > $countStatues['sum']) {
                        $countStatues['sum'] = $countStatues[$orderStatus['slug']];
                    }
                } elseif (in_array($orderStatus['value'], $typeOrderRole) && in_array($orderStatus['value'], $typeStatus)) {
                    $orderStatues[$orderStatus['slug']] = OrderStatus::getOrderByChart($period, $orders, $orderStatus['value'], 'created_at');
                    $countStatues[$orderStatus['slug']] = OrderStatus::where('type', $orderStatus['value'])->count();
                    if ($countStatues[$orderStatus['slug']] > $countStatues['sum']) {
                        $countStatues['sum'] = $countStatues[$orderStatus['slug']];
                    }
                }
            }
        } else {
            foreach ($listOrderStatues as $orderStatus) {
                if ($currentUser->hasRoleCode(AdminRoleEnum::MASTER_ADMIN)) {
                    $orderStatues[$orderStatus['slug']] = OrderStatus::getOrderByChart($period, $orders, $orderStatus['value'], 'created_at');
                    $countStatues[$orderStatus['slug']] = OrderStatus::where('type', $orderStatus['value'])->count();
                    if ($countStatues[$orderStatus['slug']] > $countStatues['sum']) {
                        $countStatues['sum'] = $countStatues[$orderStatus['slug']];
                    }
                } elseif (count($typeOrderRole) > 0 && in_array($orderStatus['value'], $typeOrderRole)) {
                    $orderStatues[$orderStatus['slug']] = OrderStatus::getOrderByChart($period, $orders, $orderStatus['value'], 'created_at');
                    $countStatues[$orderStatus['slug']] = OrderStatus::where('type', $orderStatus['value'])->count();
                    if ($countStatues[$orderStatus['slug']] > $countStatues['sum']) {
                        $countStatues['sum'] = $countStatues[$orderStatus['slug']];
                    }
                }
            }
        }

        return [
            ...$orderStatues,
            'count_data' => $countStatues
        ];
    }
}
