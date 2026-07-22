<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\DashboardComponent;
use App\Livewire\EntrepriseComponent;
use App\Livewire\RhComponent;
use App\Livewire\TimesheetComponent;

Route::get('/', function () {
    return redirect('/rh');
});

Route::get('/dashboard', DashboardComponent::class);
Route::get('/entreprise', EntrepriseComponent::class);
Route::get('/rh', RhComponent::class);
Route::get('/timesheets', TimesheetComponent::class);
