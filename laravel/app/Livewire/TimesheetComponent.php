<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Task;

class TimesheetComponent extends Component
{
    public $selectedClientId = null;
    public $selectedTaskId = null;
    public $viewMode = 'overview'; // 'overview', 'saisie', 'consultation'
    public $currentMode = 'saisie';
    public $consultationViewType = 'grid'; // 'grid' ou 'timeline'

    public function openFormSaisie()
    {
        $this->viewMode = 'saisie';
        $this->currentMode = 'saisie';
    }

    public function render()
    {
        $clients = Client::with('tasks')->take(4)->get();
        return view('livewire.timesheet-component', compact('clients'));
    }
}
