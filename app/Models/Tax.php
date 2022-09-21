<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function moneyTransferCompany()
    {
        return $this->belongsTo(MoneyTransferCompany::class);
    }

    public function taxes()
    {
        return $this->hasMany(TaxItem::class);
    }
}
