<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoneyTransferCompany extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleated_at'];
    protected $fillable = [
        'amount', 'date', 'month_due', 'company_id', 'clarifications', 'passbook', 'financial_claim'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tax()
    {
        return $this->hasOne(Tax::class);
    }
}
