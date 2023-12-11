<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }
}
