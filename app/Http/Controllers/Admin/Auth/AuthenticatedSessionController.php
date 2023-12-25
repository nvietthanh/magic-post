<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Auth/Login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = Admin::where('email', $email)->first();

        if ($user === null) {
            throw ValidationException::withMessages(['email' => __('auth.failed')]);
        }

        if (!Hash::check($password, $user->password)) {
            throw ValidationException::withMessages(['password' => __('auth.password')]);
        }

        Auth::guard('admin')->loginUsingId($user->id, $request->remember ? true : false);

        return $this->sendSuccessResponse([
            'role' => auth('admin')->user()->roles()->first()->role_code
        ], 'Đăng nhập thành công');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        return $this->sendSuccessResponse([], 'Đăng xuất thành công');
    }
}
