<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoneyTransfer extends Model
{
    use HasFactory;
    use SoftDeletes;
    // public $timestamps = true;
    // public $timestamps = ["created_at"]; // enable only to created_at

    protected $dates = ['deleated_at'];
    protected $fillable = [
        'amount', 'date', 'officer_id', 'clarifications',
    ];

    public function officer()
    {
        return $this->belongsTo(Officer::class);
    }
}
