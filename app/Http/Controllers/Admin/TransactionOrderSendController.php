<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderGuideEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionOrderSendController extends Controller
{
    public function index()
    {
        $guides = OrderGuideEnum::GUIDE_ALL;

        return Inertia::render('Admin/TransactionOrderSend/Index', [
            'guides' => $guides
        ]);
    }
}
