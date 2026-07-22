<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoursHistory extends Model
{
    protected $fillable = ['employee_id', 'hours', 'start_date', 'end_date'];
}
