<?php

namespace App\Http\Resources;

use App\Enums\AdminRoleEnum;
use App\Models\Admin;
use App\Models\AdminProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionPointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {         
        $admins = $this->adminProfiles;
        $adminManagerIds = [];
        
        foreach($admins as $admin) {
            if ($admin->admin->hasRoleCode(AdminRoleEnum::HEAD_TRANSACTION_ADMIN)) {
                $adminHeadId = $admin->admin_id;
            } elseif ($admin->admin->hasRoleCode(AdminRoleEnum::MANAGER_TRANSACTION_ADMIN)) {
                $adminManagerIds[] = $admin->admin_id;
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'district_id' => $this->district_id,
            'district_name' => $this->district->name,
            'province_name' => $this->district->province->name,
            'province_id' => $this->district->province_id,
            'address' => $this->address,
            'admin_head_id' => $adminHeadId ?? '',
            'manager_ids' => $adminManagerIds,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
