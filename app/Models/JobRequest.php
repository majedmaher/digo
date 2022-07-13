<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobRequest extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $table = 'job_requests';

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'email', 'phone_number', 'homeـadress', 'job_title', 'businessـlink', 'pdf_file'
    ];
}
