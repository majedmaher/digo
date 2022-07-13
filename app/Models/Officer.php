<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Officer extends Model
{
    use HasFactory;
    use SoftDeletes;
    // public $timestamps = true;
    protected $dates = ['deleated_at'];
    protected $fillable = [
        'name', 'id_number', 'salary', 'address', 'email', 'phone_number', 'status'
    ];

    public function transfers()
    {
        return $this->hasMany(MoneyTransfer::class);
    }

    public function presenceAbsence()
    {
        return $this->hasMany(PresenceAbsence::class);
    }
}
