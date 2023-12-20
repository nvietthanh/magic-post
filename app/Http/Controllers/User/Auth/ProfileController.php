<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\ProfileUserResource;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $currentUser = auth('web')->user();

        return ProfileUserResource::make($currentUser->userProfile);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $currentUser = auth('web')->user();

        DB::beginTransaction();
        try {
            $profile = UserProfile::where('user_id', $currentUser->id)->firstOrFail();

            $path = $profile->avatar;

            if ($data['is_delete_avatar']) {
                $path = null;
            } elseif ($request->file('file_image')) {
                $path = $data['file_image']->store();
            }
            unset($data['file_image']);
            unset($data['is_delete_avatar']);
            $data['avatar'] = $path;
            $profile->update($data);

            DB::commit();
            return $this->sendSuccessResponse(get_basic_info($currentUser), 'Thay đổi thông tin thành công');
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->sendErrorResponse(__('Something went wrong.'), $e->getMessage());
        }
    }
}
