<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAccountResource extends JsonResource
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
            'first_name' => $this->userProfile->first_name,
            'last_name' => $this->userProfile->last_name,
            'full_name' => $this->userProfile->full_name,
            'gender' => $this->userProfile->gender,
            'phone' => $this->userProfile->phone,
            'address' => $this->userProfile->address,
            'birthday' => $this->userProfile->birthday,
            'avatar' => get_avatar_url($this->userProfile)
        ];
    }
}
