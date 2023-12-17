<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionPoint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function adminProfiles()
    {
        return $this->hasMany(AdminProfile::class, 'transaction_point_id', 'id');
    }
}
