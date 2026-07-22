<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule', 'nom', 'prenom', 'dob', 'email', 'role',
        'gestionnaire', 'probation_status', 'account_status',
        'visibility_report', 'is_manager', 'weekly_hours',
        'hire_date', 'site'
    ];

    protected $casts = [
        'is_manager' => 'boolean',
        'weekly_hours' => 'float',
    ];

    public function hoursHistories()
    {
        return $this->hasMany(HoursHistory::class)->orderBy('created_at', 'desc');
    }

    public function managerHistories()
    {
        return $this->hasMany(ManagerHistory::class)->orderBy('created_at', 'desc');
    }

    public function siteHistories()
    {
        return $this->hasMany(SiteHistory::class)->orderBy('created_at', 'desc');
    }
}
