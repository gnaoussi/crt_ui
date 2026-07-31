<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Task;

class TimesheetComponent extends Component
{
    public $selectedClientId = null;
    public $selectedTaskId = null;
    public $currentMode = 'saisie';

    public function render()
    {
        $clients = Client::with('tasks')->take(4)->get();
        return view('livewire.timesheet-component', compact('clients'));
    }
}
