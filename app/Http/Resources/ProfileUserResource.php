<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileUserResource extends JsonResource
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
            'uuid' => $this->user->uuid,
            'email' => $this->user->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'avatar' => get_file_url($this->avatar),
            'avatar_default' => get_avatar_url($this),
            'phone' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
            'birthday' => $this->birthday,
        ];
    }
}
