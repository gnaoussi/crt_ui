<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;

class DashboardComponent extends Component
{
    public function render()
    {
        $clientsCount = Client::count();
        return view('livewire.dashboard-component', compact('clientsCount'));
    }
}
