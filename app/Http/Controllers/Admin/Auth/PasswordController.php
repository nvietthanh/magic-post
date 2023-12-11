<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $currentUser = auth()->user();

        if (!Hash::check($data['old_password'], $currentUser->password)) {
            throw ValidationException::withMessages(['password' => __('auth.password')]);
        }
        $currentUser->update([
            'password' => bcrypt($data['password'])
        ]);

        return $this->sendSuccessResponse([], 'Thay đổi mật khẩu thành công');
    }
}
