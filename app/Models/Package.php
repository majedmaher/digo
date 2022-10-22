<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeGetData($query)
    {
        return $query->select('id', 'title', 'price', 'currencyـname', 'is_active');
    }

    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = ($value == 'on' ? 1 : 0);
    }
    public function getIsActiveAttribute($value)
    {
        return $value == 1 ? 'Active' : 'InActive';
    }
}
