<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Livewire\DashboardComponent;
use App\Livewire\EntrepriseComponent;
use App\Livewire\RhComponent;
use App\Livewire\TimesheetComponent;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Livewire::component('dashboard-component', DashboardComponent::class);
        Livewire::component('entreprise-component', EntrepriseComponent::class);
        Livewire::component('rh-component', RhComponent::class);
        Livewire::component('timesheet-component', TimesheetComponent::class);
    }
}
