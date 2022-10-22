<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeGetPayments($query)
    {
        $query->select('id', 'package_id', 'first_name', 'last_name', 'email', 'phone_number');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
