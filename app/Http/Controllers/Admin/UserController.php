<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/User/Index');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return Inertia::render('Admin/User/Show', [
            'user' => get_basic_info($user),
            'id' => $id
        ]);
    }
}
