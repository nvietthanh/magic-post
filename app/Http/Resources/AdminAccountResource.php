<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class AdminAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'email' => $this->email,
            'status' => $this->status ? true : false,
            'first_name' => $this->adminProfile->first_name,
            'last_name' => $this->adminProfile->last_name,
            'full_name' => $this->adminProfile->full_name,
            'gender' => $this->adminProfile->gender,
            'phone' => $this->adminProfile->phone,
            'address' => $this->adminProfile->address,
            'avatar' => get_avatar_url($this->adminProfile),
            'role' => $this->roles()->first()->role_code,
            'password' => Crypt::decryptString($this->password_not_hash)
        ];
    }
}
