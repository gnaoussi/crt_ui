<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagerHistory extends Model
{
    protected $fillable = ['employee_id', 'manager', 'start_date', 'end_date'];
}
