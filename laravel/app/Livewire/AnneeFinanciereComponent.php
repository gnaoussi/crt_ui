<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class AnneeFinanciereComponent extends Component
{
    use WithPagination;

    // View state: 'list' or 'detail'
    public $viewMode = 'list';
    public $selectedAnnee = null;

    // Financial Years Data
    public $financialYears = [];
    public $anneeSearchQuery = ''; // Filter by Start Year

    // Modals
    public $isCreateModalOpen = false;
    public $isEditModalOpen = false;

    // Financial Year Form
    public $anneeForm = [
        'id' => null,
        'startDate' => '01/04/2026',
        'endDate' => '31/03/2027',
        'firstDay' => 'Dimanche',
        'timeBankCeiling' => '0',
        'isActive' => true,
        'hasTimesheets' => false
    ];

    // Weeks & Detail View Filters
    public $weeksList = [];
    public $weekStatusFilter = 'Tous';
    public $weekSearchDateFrom = '';
    public $weekSearchDateTo = '';
    public $weeksCurrentPage = 1;
    public $weeksPerPage = 10;

    public function mount()
    {
        // Sample Financial Years Data
        $this->financialYears = [
            [
                'id' => 1,
                'startDate' => '01/04/2027',
                'endDate' => '31/03/2028',
                'firstDay' => 'Dimanche',
                'timeBankCeiling' => '0 (sans plafond)',
                'isActive' => false,
                'hasTimesheets' => false,
                'weeksCount' => 53,
                'openWeeks' => 0,
                'closedWeeks' => 0,
                'inactiveWeeks' => 53,
            ],
            [
                'id' => 2,
                'startDate' => '01/04/2026',
                'endDate' => '31/03/2027',
                'firstDay' => 'Dimanche',
                'timeBankCeiling' => '0 (sans plafond)',
                'isActive' => true,
                'hasTimesheets' => true,
                'weeksCount' => 53,
                'openWeeks' => 4,
                'closedWeeks' => 0,
                'inactiveWeeks' => 49,
            ],
            [
                'id' => 3,
                'startDate' => '01/04/2025',
                'endDate' => '31/03/2026',
                'firstDay' => 'Dimanche',
                'timeBankCeiling' => '0 (sans plafond)',
                'isActive' => false,
                'hasTimesheets' => true,
                'weeksCount' => 52,
                'openWeeks' => 0,
                'closedWeeks' => 52,
                'inactiveWeeks' => 0,
            ],
        ];

        // Sample 53 Weeks for Detail View
        $this->weeksList = collect(range(1, 53))->map(function ($weekNum) {
            $isOpened = $weekNum <= 4;
            return [
                'id' => $weekNum,
                'name' => "Semaine {$weekNum}",
                'dateRange' => sprintf('2026-04-%02d - 2026-04-%02d', ($weekNum % 28) + 1, ($weekNum % 28) + 7),
                'startDate' => sprintf('2026-04-%02d', ($weekNum % 28) + 1),
                'endDate' => sprintf('2026-04-%02d', ($weekNum % 28) + 7),
                'status' => $isOpened ? 'Ouvertes' : 'Inactive',
                'payStatus' => 'Normale',
            ];
        })->toArray();
    }

    public function selectAnnee($id)
    {
        $this->selectedAnnee = collect($this->financialYears)->firstWhere('id', $id);
        $this->viewMode = 'detail';
        $this->weeksCurrentPage = 1;
    }

    public function backToList()
    {
        $this->selectedAnnee = null;
        $this->viewMode = 'list';
    }

    public function openCreateModal()
    {
        $this->anneeForm = [
            'id' => null,
            'startDate' => '01/04/2027',
            'endDate' => '31/03/2028',
            'firstDay' => 'Dimanche',
            'timeBankCeiling' => '0',
            'isActive' => false,
            'hasTimesheets' => false
        ];
        $this->isCreateModalOpen = true;
    }

    public function createAnnee()
    {
        $newId = count($this->financialYears) + 1;
        $this->financialYears[] = [
            'id' => $newId,
            'startDate' => $this->anneeForm['startDate'],
            'endDate' => $this->anneeForm['endDate'],
            'firstDay' => $this->anneeForm['firstDay'],
            'timeBankCeiling' => $this->anneeForm['timeBankCeiling'] == '0' ? '0 (sans plafond)' : $this->anneeForm['timeBankCeiling'] . ' h',
            'isActive' => $this->anneeForm['isActive'],
            'hasTimesheets' => false,
            'weeksCount' => 53,
            'openWeeks' => 0,
            'closedWeeks' => 0,
            'inactiveWeeks' => 53,
        ];

        $this->isCreateModalOpen = false;
        session()->flash('message', 'Nouvelle année financière créée avec succès !');
    }

    public function openEditModal($id)
    {
        $annee = collect($this->financialYears)->firstWhere('id', $id);
        if ($annee && !$annee['hasTimesheets']) {
            $this->anneeForm = $annee;
            $this->isEditModalOpen = true;
        }
    }

    public function updateAnnee()
    {
        foreach ($this->financialYears as &$year) {
            if ($year['id'] == $this->anneeForm['id']) {
                $year['startDate'] = $this->anneeForm['startDate'];
                $year['endDate'] = $this->anneeForm['endDate'];
                $year['firstDay'] = $this->anneeForm['firstDay'];
                $year['timeBankCeiling'] = $this->anneeForm['timeBankCeiling'];
                $year['isActive'] = $this->anneeForm['isActive'];
            }
        }
        $this->isEditModalOpen = false;
        session()->flash('message', 'Année financière mise à jour avec succès.');
    }

    public function deleteAnnee($id)
    {
        $annee = collect($this->financialYears)->firstWhere('id', $id);
        if ($annee && !$annee['hasTimesheets']) {
            $this->financialYears = collect($this->financialYears)->reject(fn($item) => $item['id'] == $id)->values()->toArray();
            session()->flash('message', 'Année financière supprimée avec succès.');
        }
    }

    public function toggleWeekStatus($weekId, $newStatus)
    {
        foreach ($this->weeksList as &$week) {
            if ($week['id'] == $weekId) {
                $week['status'] = $newStatus;
            }
        }
        session()->flash('message', "Statut de la semaine mis à jour.");
    }

    public function togglePayStatus($weekId)
    {
        foreach ($this->weeksList as &$week) {
            if ($week['id'] == $weekId) {
                $week['payStatus'] = $week['payStatus'] === 'Paie validée' ? 'Normale' : 'Paie validée';
            }
        }
        session()->flash('message', "Statut de paie de la semaine mis à jour.");
    }

    public function setPageNum($page)
    {
        $this->weeksCurrentPage = $page;
    }

    public function render()
    {
        return view('livewire.annee-financiere-component')->layout('components.layouts.app');
    }
}
