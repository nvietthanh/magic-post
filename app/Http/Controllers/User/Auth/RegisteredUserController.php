<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('User/Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        
        DB::beginTransaction();
        try {
            $numberUser = User::max('id');
            $uuid = 'KH' . str_pad($numberUser + 1, 6, '0', STR_PAD_LEFT);
            $data['uuid'] = $uuid;

            $user = User::create([
                'uuid' => $data['uuid'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);
            unset($data['uuid']);
            unset($data['email']);
            unset($data['password']);
            $user->userProfile()->create($data);
            Auth::guard('web')->login($user);

            DB::commit();
            return $this->sendSuccessResponse([], 'Đăng ký tài khoản thành công');
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->sendErrorResponse(__('Something went wrong.'), $e->getMessage());
        }
    }
}
