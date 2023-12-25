<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileAdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->transactionPoint) {
            $pointName = $this->transactionPoint->name;
            $pointName .= ', ' . $this->transactionPoint->district->name;
            $pointName .= ', ' . $this->transactionPoint->district->province->name;
        } elseif ($this->concentratePoint) {
            $pointName = $this->concentratePoint->name;
            $pointName .= ', ' . $this->concentratePoint->district->name;
            $pointName .= ', ' . $this->concentratePoint->district->province->name;
        }

        return [
            'id' => $this->id,
            'uuid' => $this->admin->uuid,
            'email' => $this->admin->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'avatar' => get_file_url($this->avatar),
            'avatar_default' => get_avatar_url($this),
            'phone' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
            'birthday' => $this->birthday,
            'point_name' => $pointName ?? null
        ];
    }
}
