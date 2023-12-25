<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function dashboard()
    {
        return redirect()->route('admin.transaction-point.index');
        return Inertia::render('Admin/Dashboard');
    }
}
