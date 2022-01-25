<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    public $fillable = [
        'logo',
        'phone',
        'alt_phone',
        'email',
        'company_name',
        'company_address',
        'facebook',
        'twitter',
        'linkedin',
        'youtube',
    ];
}
