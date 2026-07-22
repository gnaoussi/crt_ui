<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CompanySite;

class EntrepriseComponent extends Component
{
    public $entrepriseMode = 'consultation';
    public $companyInfo = [
        'name' => 'CRT Solution Canada',
        'probationPeriod' => '1 heure(s)',
        'description' => 'La table de concertation des organismes au service des personnes réfugiées et immigrantes (CRT) est un regroupement de plus de 150 organismes œuvrant auprès des personnes réfugiées, immigrantes et sans statut au Québec.'
    ];
    public $siteSearchQuery = '';

    public function setMode($mode)
    {
        $this->entrepriseMode = $mode;
    }

    public function saveCompanyInfo()
    {
        session()->flash('message', 'Informations de l\'entreprise enregistrées !');
    }

    public function render()
    {
        $sites = CompanySite::when($this->siteSearchQuery, function($q) {
            $q->where('name', 'like', "%{$this->siteSearchQuery}%")
              ->orWhere('description', 'like', "%{$this->siteSearchQuery}%")
              ->orWhere('address', 'like', "%{$this->siteSearchQuery}%");
        })->get();

        return view('livewire.entreprise-component', compact('sites'));
    }
}
