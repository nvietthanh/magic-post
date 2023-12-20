<?php

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

if (!function_exists('get_file_url')) {
    /**
     * Convert file url by file path
     *
     * @param string $filePath
     * @return string|null
     */
    function get_file_url($filePath): ?string
    {
        if ($filePath && !parse_url($filePath, PHP_URL_SCHEME)) {
            return Storage::url($filePath);
        }

        return $filePath;
    }
}

if (!function_exists('get_avatar_url')) {
    /**
     * Convert file url by file path
     *
     * @param string $filePath
     * @return string|null
     */
    function get_avatar_url($profile): ?string
    {
        if ($profile->avatar) {
            return get_file_url($profile->avatar);
        }

        return asset('/images/default-avatar.png');
    }
}

if (!function_exists('get_basic_info')) {
    /**
     * Retrieves basic user information.
     *
     * @param mixed $user The user object.
     * @return array Returns an array containing the user's ID, name, and avatar.
     */
    function get_basic_info($user): array
    {
        if ($user->adminProfile) {
            $profile = $user->adminProfile;
            $role = $user->roles()->first()->role_code;
            if ($profile->transactionPoint) {
                $districtId = $profile->transactionPoint->district_id;
            }
            if ($profile->concentratePoint) {
                $districtId = $profile->concentratePoint->district_id;
            }

        }
        if ($user->userProfile) {
            $profile = $user->userProfile;
        }

        return [
            'id' => $user->id,
            'uuid' => $user->uuid,
            'full_name' => $profile->first_name . ' ' . $profile->last_name,
            'avatar' => get_avatar_url($profile),
            'role' => $role ?? null,
            'district_id' => $districtId ?? null
        ];
    }
}

