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
    public $editedCompanyInfo = [];

    public $siteSearchQuery = '';

    // Modal States
    public $isCreateSiteModalOpen = false;
    public $isEditSiteModalOpen = false;
    public $isViewSiteModalOpen = false;
    public $isDeleteSiteModalOpen = false;

    public $selectedSite = null;
    public $siteForm = [
        'id' => null,
        'name' => '',
        'description' => '',
        'address' => '',
        'postal_code' => '',
        'city' => '',
        'phone' => '',
        'phone_pro' => '',
    ];

    public function rules()
    {
        return [
            'editedCompanyInfo.name' => 'required|string|min:2',
        ];
    }

    public function messages()
    {
        return [
            'editedCompanyInfo.name.required' => 'Le nom de l\'entreprise est obligatoire.',
            'editedCompanyInfo.name.min' => 'Le nom de l\'entreprise doit comporter au moins 2 caractères.',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->editedCompanyInfo = $this->companyInfo;
    }

    public function setMode($mode)
    {
        $this->entrepriseMode = $mode;
        if ($mode === 'saisie') {
            $this->editedCompanyInfo = $this->companyInfo;
        }
    }

    public function saveCompanyInfo()
    {
        $this->validate();

        $this->companyInfo = $this->editedCompanyInfo;
        $this->entrepriseMode = 'consultation';
        session()->flash('message', 'Informations de l\'entreprise enregistrées avec succès !');
    }

    public function openCreateSiteModal()
    {
        $this->resetSiteForm();
        $this->isCreateSiteModalOpen = true;
    }

    public function createSite()
    {
        $this->validate([
            'siteForm.name' => 'required|string',
            'siteForm.address' => 'required|string',
            'siteForm.phone' => 'required|string',
        ]);

        CompanySite::create($this->siteForm);
        $this->isCreateSiteModalOpen = false;
        $this->resetSiteForm();
        session()->flash('message', 'Nouveau site d\'entreprise créé avec succès !');
    }

    public function openViewSiteModal(CompanySite $site)
    {
        $this->selectedSite = $site;
        $this->isViewSiteModalOpen = true;
    }

    public function openEditSiteModal(CompanySite $site)
    {
        $this->selectedSite = $site;
        $this->siteForm = [
            'id' => $site->id,
            'name' => $site->name,
            'description' => $site->description,
            'address' => $site->address,
            'postal_code' => $site->postal_code,
            'city' => $site->city,
            'phone' => $site->phone,
            'phone_pro' => $site->phone_pro,
        ];
        $this->isEditSiteModalOpen = true;
    }

    public function updateSite()
    {
        $this->validate([
            'siteForm.name' => 'required|string',
            'siteForm.address' => 'required|string',
            'siteForm.phone' => 'required|string',
        ]);

        if ($this->selectedSite) {
            $this->selectedSite->update($this->siteForm);
        }

        $this->isEditSiteModalOpen = false;
        $this->resetSiteForm();
        session()->flash('message', 'Site d\'entreprise mis à jour avec succès !');
    }

    public function confirmDeleteSite(CompanySite $site)
    {
        $this->selectedSite = $site;
        $this->isDeleteSiteModalOpen = true;
    }

    public function deleteSite()
    {
        if ($this->selectedSite) {
            $this->selectedSite->delete();
        }
        $this->isDeleteSiteModalOpen = false;
        $this->selectedSite = null;
        session()->flash('message', 'Site d\'entreprise supprimé avec succès !');
    }

    public function resetSiteForm()
    {
        $this->siteForm = [
            'id' => null,
            'name' => '',
            'description' => '',
            'address' => '',
            'postal_code' => '',
            'city' => '',
            'phone' => '',
            'phone_pro' => '',
        ];
        $this->selectedSite = null;
    }

    public function render()
    {
        $sites = CompanySite::when($this->siteSearchQuery, function($q) {
            $q->where('name', 'like', "%{$this->siteSearchQuery}%")
              ->orWhere('description', 'like', "%{$this->siteSearchQuery}%")
              ->orWhere('address', 'like', "%{$this->siteSearchQuery}%")
              ->orWhere('phone', 'like', "%{$this->siteSearchQuery}%");
        })->get();

        return view('livewire.entreprise-component', compact('sites'));
    }
}
