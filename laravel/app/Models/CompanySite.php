<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySite extends Model
{
    protected $fillable = [
        'name', 'description', 'address', 'city',
        'postal_code', 'phone', 'phone_pro', 'extension'
    ];
}
