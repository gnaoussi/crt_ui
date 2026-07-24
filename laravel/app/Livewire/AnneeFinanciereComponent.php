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
    public $isDeleteModalOpen = false;
    public $deleteTargetAnnee = null;

    // Confirm Action Dialogues State
    public $isConfirmActionModalOpen = false;
    public $confirmActionTitle = '';
    public $confirmActionMessage = '';
    public $confirmActionConfirmText = 'Confirmer';
    public $confirmActionCancelText = 'Annuler';
    public $confirmActionColor = 'bg-crt-navy hover:bg-crt-navy-dark';
    public $confirmActionIconBg = 'bg-crt-cyan-light text-crt-navy';
    public $confirmActionType = '';
    public $pendingActionData = [];

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

    public function openDeleteModal($id)
    {
        $annee = collect($this->financialYears)->firstWhere('id', $id);
        if ($annee && !$annee['hasTimesheets']) {
            $this->deleteTargetAnnee = $annee;
            $this->isDeleteModalOpen = true;
        }
    }

    public function deleteAnnee()
    {
        if ($this->deleteTargetAnnee) {
            $id = $this->deleteTargetAnnee['id'];
            $this->financialYears = collect($this->financialYears)->reject(fn($item) => $item['id'] == $id)->values()->toArray();
            $this->isDeleteModalOpen = false;
            $this->deleteTargetAnnee = null;
            $this->dispatch('show-toast', message: "L'année financière a été supprimée avec succès.", type: 'warning');
        }
    }

    public function openConfirmYearModal($mode)
    {
        $this->confirmActionType = 'toggle_year';
        $this->pendingActionData = ['mode' => $mode];

        if ($mode === 'close') {
            $this->confirmActionTitle = "Clôturer l'année financière";
            $this->confirmActionMessage = "Êtes-vous sûr de vouloir clôturer cette année financière ? Les semaines fermées ne pourront plus recevoir de nouvelles feuilles de temps.";
            $this->confirmActionConfirmText = "Oui, clôturer";
            $this->confirmActionColor = "bg-rose-600 hover:bg-rose-700";
            $this->confirmActionIconBg = "bg-rose-100 text-rose-600";
        } else {
            $this->confirmActionTitle = "Ouvrir l'année financière";
            $this->confirmActionMessage = "Êtes-vous sûr de vouloir réouvrir cette année financière pour la rendre active ?";
            $this->confirmActionConfirmText = "Oui, ouvrir";
            $this->confirmActionColor = "bg-emerald-600 hover:bg-emerald-700";
            $this->confirmActionIconBg = "bg-emerald-100 text-emerald-600";
        }

        $this->isConfirmActionModalOpen = true;
    }

    public function openConfirmWeekModal($weekId, $type, $newStatus = null)
    {
        $week = collect($this->weeksList)->firstWhere('id', $weekId);
        if (!$week) return;

        $this->confirmActionType = $type === 'status' ? 'week_status' : 'week_pay';
        $this->pendingActionData = [
            'weekId' => $weekId,
            'newStatus' => $newStatus,
            'weekName' => $week['name']
        ];

        if ($type === 'status') {
            if ($newStatus === 'Ouvertes') {
                $this->confirmActionTitle = "Ouvrir la {$week['name']}";
                $this->confirmActionMessage = "Êtes-vous sûr de vouloir réouvrir la {$week['name']} ?";
                $this->confirmActionConfirmText = "Oui, ouvrir";
                $this->confirmActionColor = "bg-emerald-600 hover:bg-emerald-700";
                $this->confirmActionIconBg = "bg-emerald-100 text-emerald-600";
            } elseif ($newStatus === 'Fermées') {
                $this->confirmActionTitle = "Fermer la {$week['name']}";
                $this->confirmActionMessage = "Êtes-vous sûr de vouloir fermer la {$week['name']} ?";
                $this->confirmActionConfirmText = "Oui, fermer";
                $this->confirmActionColor = "bg-rose-600 hover:bg-rose-700";
                $this->confirmActionIconBg = "bg-rose-100 text-rose-600";
            } else {
                $this->confirmActionTitle = "Désactiver la {$week['name']}";
                $this->confirmActionMessage = "Êtes-vous sûr de vouloir désactiver la {$week['name']} ?";
                $this->confirmActionConfirmText = "Oui, désactiver";
                $this->confirmActionColor = "bg-slate-700 hover:bg-slate-800";
                $this->confirmActionIconBg = "bg-slate-100 text-slate-700";
            }
        } else {
            $this->confirmActionTitle = "Statut de Paie - {$week['name']}";
            $this->confirmActionMessage = "Êtes-vous sûr de vouloir modifier le statut de paie de la {$week['name']} ?";
            $this->confirmActionConfirmText = "Oui, modifier";
            $this->confirmActionColor = "bg-amber-600 hover:bg-amber-700";
            $this->confirmActionIconBg = "bg-amber-100 text-amber-800";
        }

        $this->isConfirmActionModalOpen = true;
    }

    public function executeConfirmedAction()
    {
        if ($this->confirmActionType === 'toggle_year') {
            $mode = $this->pendingActionData['mode'] ?? 'close';
            if ($this->selectedAnnee) {
                $newState = ($mode === 'open');
                $this->selectedAnnee['isActive'] = $newState;
                foreach ($this->financialYears as &$year) {
                    if ($year['id'] == $this->selectedAnnee['id']) {
                        $year['isActive'] = $newState;
                    }
                }
                $msg = $newState ? "L'année financière a été ouverte avec succès." : "L'année financière a été clôturée avec succès.";
                $type = $newState ? 'success' : 'warning';
                $this->dispatch('show-toast', message: $msg, type: $type);
            }
        } elseif ($this->confirmActionType === 'week_status') {
            $weekId = $this->pendingActionData['weekId'];
            $newStatus = $this->pendingActionData['newStatus'];
            $this->toggleWeekStatus($weekId, $newStatus);
        } elseif ($this->confirmActionType === 'week_pay') {
            $weekId = $this->pendingActionData['weekId'];
            $this->togglePayStatus($weekId);
        }

        $this->isConfirmActionModalOpen = false;
        $this->pendingActionData = [];
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
