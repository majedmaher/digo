<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FcmToken extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'fcm_tokens';

    protected $dates = ['deleted_at'];

    protected $fillable = ['fcm_token'];

    public function scopeSelected($query)
    {
        return $query->pluck('fcm_token');
    }
}
