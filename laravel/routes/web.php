<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\LoginComponent;
use App\Livewire\DashboardComponent;
use App\Livewire\EntrepriseComponent;
use App\Livewire\RhComponent;
use App\Livewire\TimesheetComponent;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', LoginComponent::class)->name('login');
Route::get('/dashboard', DashboardComponent::class)->name('dashboard');
Route::get('/entreprise', EntrepriseComponent::class)->name('entreprise');
Route::get('/rh', RhComponent::class)->name('rh');
Route::get('/timesheets', TimesheetComponent::class)->name('timesheets');
