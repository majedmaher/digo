<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailForm extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'mail_title', 'header_image', 'body_image', 'body_text_one', 'button',
        'button_link', 'body_text_two', 'button_one', 'button_one_link', 'button_two',
        'button_two_link', 'button_three', 'button_three_link', 'footer_image'
    ];
}
