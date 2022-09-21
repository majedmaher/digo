<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    // public $timestamps = true;
    protected $dates = ['deleated_at'];
    protected $fillable = [
        'company_name', 'companyـofficial_name', 'commercial_registration_no', 'address', 'status', 'start_decade', 'end_decade'
    ];

    public function transfers()
    {
        return $this->hasMany(MoneyTransferCompany::class);
    }

    public function tax()
    {
        return $this->hasMany(Tax::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }
}
