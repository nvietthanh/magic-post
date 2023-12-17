<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminProfile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $appends = [
        'full_name',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'id', 'district_id');
    }

    public function transactionPoint()
    {
        return $this->belongsTo(TransactionPoint::class, 'district_id', 'district_id');
    }
}
