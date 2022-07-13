<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresenceAbsence extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleated_at'];
    protected $fillable = [
        'officer_id', 'day', 'date', 'audience', 'leave', 'break', 'working_hours', 'incapacity_hours', 'clarifications'
    ];

    public function officer()
    {
        return $this->belongsTo(Officer::class);
    }
}
