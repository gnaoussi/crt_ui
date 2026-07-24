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
        'timeBankCeiling' => '40 h',
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
                'timeBankCeiling' => '40 h',
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
                'timeBankCeiling' => '40 h',
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
                'timeBankCeiling' => '40 h',
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
            'timeBankCeiling' => '40 h',
            'isActive' => false,
            'hasTimesheets' => false
        ];
        $this->isCreateModalOpen = true;
    }

    public function createAnnee()
    {
        $newId = count($this->financialYears) + 1;
        $ceilingVal = trim($this->anneeForm['timeBankCeiling']);
        if (!str_contains(strtolower($ceilingVal), 'h')) {
            $ceilingVal .= ' h';
        }

        $this->financialYears[] = [
            'id' => $newId,
            'startDate' => $this->anneeForm['startDate'],
            'endDate' => $this->anneeForm['endDate'],
            'firstDay' => $this->anneeForm['firstDay'],
            'timeBankCeiling' => $ceilingVal,
            'isActive' => $this->anneeForm['isActive'],
            'hasTimesheets' => false,
            'weeksCount' => 53,
            'openWeeks' => 0,
            'closedWeeks' => 0,
            'inactiveWeeks' => 53,
        ];

        $this->isCreateModalOpen = false;
        $this->dispatch('show-toast', message: "L'année financière a été créée avec succès.", type: 'success');
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
        $ceilingVal = trim($this->anneeForm['timeBankCeiling']);
        if (!str_contains(strtolower($ceilingVal), 'h')) {
            $ceilingVal .= ' h';
        }

        foreach ($this->financialYears as &$year) {
            if ($year['id'] == $this->anneeForm['id']) {
                $year['startDate'] = $this->anneeForm['startDate'];
                $year['endDate'] = $this->anneeForm['endDate'];
                $year['firstDay'] = $this->anneeForm['firstDay'];
                $year['timeBankCeiling'] = $ceilingVal;
                $year['isActive'] = $this->anneeForm['isActive'];
            }
        }
        $this->isEditModalOpen = false;
        $this->dispatch('show-toast', message: "L'année financière a été modifiée avec succès.", type: 'success');
    }

    public function deleteAnnee($id)
    {
        $annee = collect($this->financialYears)->firstWhere('id', $id);
        if ($annee && !$annee['hasTimesheets']) {
            $this->financialYears = collect($this->financialYears)->reject(fn($item) => $item['id'] == $id)->values()->toArray();
            $this->dispatch('show-toast', message: "L'année financière a été supprimée avec succès.", type: 'warning');
        }
    }

    public function closeYear()
    {
        if ($this->selectedAnnee) {
            $this->selectedAnnee['isActive'] = false;
            foreach ($this->financialYears as &$year) {
                if ($year['id'] == $this->selectedAnnee['id']) {
                    $year['isActive'] = false;
                }
            }
            $this->dispatch('show-toast', message: "L'année financière a été clôturée avec succès.", type: 'warning');
        }
    }

    public function toggleWeekStatus($weekId, $newStatus)
    {
        $weekName = '';
        foreach ($this->weeksList as &$week) {
            if ($week['id'] == $weekId) {
                $week['status'] = $newStatus;
                $weekName = $week['name'];
            }
        }

        $toastType = $newStatus === 'Fermées' ? 'warning' : 'success';
        $label = $newStatus === 'Fermées' ? 'fermée' : ($newStatus === 'Ouvertes' ? 'réouverte' : 'désactivée');
        $this->dispatch('show-toast', message: "{$weekName} {$label} avec succès.", type: $toastType);
    }

    public function togglePayStatus($weekId)
    {
        $weekName = '';
        foreach ($this->weeksList as &$week) {
            if ($week['id'] == $weekId) {
                $week['payStatus'] = $week['payStatus'] === 'Paie validée' ? 'Normale' : 'Paie validée';
                $weekName = $week['name'];
            }
        }
        $this->dispatch('show-toast', message: "Statut de paie mis à jour pour la {$weekName}.", type: 'success');
    }

    public function showAuditLog($weekName)
    {
        $this->dispatch('show-toast', message: "Ouverture du journal d'audit de la {$weekName}...", type: 'info');
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
