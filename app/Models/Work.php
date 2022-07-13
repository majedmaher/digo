<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id', 'link', 'photo', 'category', 'is_favorite', 'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
