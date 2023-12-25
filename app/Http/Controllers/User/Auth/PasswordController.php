<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $currentUser = auth('web')->user();

        if (!Hash::check($data['old_password'], $currentUser->password)) {
            throw ValidationException::withMessages(['old_password' => __('auth.password')]);
        }
        $currentUser->update([
            'password' => bcrypt($data['password'])
        ]);

        return $this->sendSuccessResponse([], 'Thay đổi mật khẩu thành công');
    }
}
