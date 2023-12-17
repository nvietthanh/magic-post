<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderGuideEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConcentrateOrderSendController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/ConcentrateOrderSend/Index');
    }
}
