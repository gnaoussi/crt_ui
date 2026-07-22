<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;
use App\Models\CompanySite;
use App\Models\HoursHistory;
use App\Models\ManagerHistory;
use App\Models\SiteHistory;

class RhComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    // Navigation & Selected Employee State
    public $selectedEmployeeId = null;
    public $employeeActiveTab = 'information';

    // Filters
    public $empFilterQuery = '';
    public $empFilterManager = '';
    public $empFilterProbation = 'all';
    public $empFilterStatus = 'all';

    public function updatingEmpFilterQuery() { $this->resetPage(); }
    public function updatingEmpFilterManager() { $this->resetPage(); }
    public function updatingEmpFilterProbation() { $this->resetPage(); }
    public function updatingEmpFilterStatus() { $this->resetPage(); }

    // Modal Visibility States
    public $isNewEmployeeModalOpen = false;
    public $isEditEmployeeModalOpen = false;
    public $isEditManagerModalOpen = false;
    public $isEditHoursModalOpen = false;
    public $isEditSiteModalOpen = false;

    // Form States
    public $newEmpForm = [
        'nom' => '', 'prenom' => '', 'dob' => '07-21', 'email' => '',
        'matricule' => '', 'hireDate' => '2026-07-22', 'weeklyHours' => 37.5,
        'gestionnaire' => 'Admin Plateforme GCS', 'site' => 'Centre Ville-Marie',
        'isManager' => 'Non', 'accessGroup' => 'ADMINISTRATEUR'
    ];

    public $editEmpForm = [
        'nom' => '', 'prenom' => '', 'dob' => '', 'email' => '',
        'matricule' => '', 'hireDate' => '', 'isManager' => 'Non',
        'accessGroup' => 'ADMINISTRATEUR', 'visibilityReport' => 'Oui'
    ];

    public $editManagerForm = [
        'newManager' => 'Admin Plateforme GCS', 'startDate' => '2026-07-22 12:31:00'
    ];

    public $editHoursForm = [
        'newHours' => 40, 'startDate' => '2026-07-22 12:30:00'
    ];

    public $editSiteForm = [
        'newSiteName' => 'Centre Ville-Marie', 'startDate' => '2026-07-22 12:32:00', 'endDate' => ''
    ];

    public function selectEmployee($id)
    {
        $this->selectedEmployeeId = $id;
        $this->employeeActiveTab = 'information';
    }

    public function backToList()
    {
        $this->selectedEmployeeId = null;
    }

    public function setTab($tab)
    {
        $this->employeeActiveTab = $tab;
    }

    public function toggleAccountStatus($empId)
    {
        $emp = Employee::find($empId);
        if ($emp) {
            $emp->account_status = $emp->account_status === 'Activé' ? 'Désactivé' : 'Activé';
            $emp->save();
            session()->flash('message', "Statut de {$emp->prenom} {$emp->nom} mis à jour vers {$emp->account_status} !");
        }
    }

    // Modal 1: Create Employee
    public function openNewEmployeeModal()
    {
        $this->newEmpForm['matricule'] = 'EMP2026-' . rand(100, 999);
        $this->isNewEmployeeModalOpen = true;
    }

    public function handleCreateEmployee()
    {
        $created = Employee::create([
            'matricule' => $this->newEmpForm['matricule'],
            'nom' => $this->newEmpForm['nom'],
            'prenom' => $this->newEmpForm['prenom'],
            'dob' => $this->newEmpForm['dob'],
            'email' => $this->newEmpForm['email'],
            'role' => $this->newEmpForm['accessGroup'],
            'gestionnaire' => $this->newEmpForm['gestionnaire'],
            'probation_status' => '1 heure restante',
            'account_status' => 'Activé',
            'visibility_report' => 'Oui',
            'is_manager' => $this->newEmpForm['isManager'] === 'Oui',
            'weekly_hours' => (float)$this->newEmpForm['weeklyHours'],
            'hire_date' => $this->newEmpForm['hireDate'],
            'site' => $this->newEmpForm['site'],
        ]);

        HoursHistory::create([
            'employee_id' => $created->id,
            'hours' => $created->weekly_hours,
            'start_date' => $created->hire_date . ' 09:00:00',
            'end_date' => '---'
        ]);

        ManagerHistory::create([
            'employee_id' => $created->id,
            'manager' => $created->gestionnaire,
            'start_date' => $created->hire_date . ' 09:00:00',
            'end_date' => '---'
        ]);

        SiteHistory::create([
            'employee_id' => $created->id,
            'site_name' => $created->site,
            'address' => '1001 rue Sherbrooke Est H2L 1L3',
            'start_date' => $created->hire_date . ' 09:00:00',
            'end_date' => '---',
            'status' => 'Actif'
        ]);

        $this->isNewEmployeeModalOpen = false;
        session()->flash('message', "L'employé {$created->prenom} {$created->nom} a été créé avec succès dans SQLite !");
    }

    // Modal 2: Edit Employee Info
    public function openEditEmployeeModal()
    {
        $emp = Employee::find($this->selectedEmployeeId);
        if ($emp) {
            $this->editEmpForm = [
                'nom' => $emp->nom,
                'prenom' => $emp->prenom,
                'dob' => $emp->dob,
                'email' => $emp->email,
                'matricule' => $emp->matricule,
                'hireDate' => $emp->hire_date,
                'isManager' => $emp->is_manager ? 'Oui' : 'Non',
                'accessGroup' => $emp->role,
                'visibilityReport' => $emp->visibility_report,
            ];
            $this->isEditEmployeeModalOpen = true;
        }
    }

    public function handleSaveEmployeeUpdate()
    {
        $emp = Employee::find($this->selectedEmployeeId);
        if ($emp) {
            $emp->update([
                'nom' => $this->editEmpForm['nom'],
                'prenom' => $this->editEmpForm['prenom'],
                'dob' => $this->editEmpForm['dob'],
                'email' => $this->editEmpForm['email'],
                'matricule' => $this->editEmpForm['matricule'],
                'hire_date' => $this->editEmpForm['hireDate'],
                'is_manager' => $this->editEmpForm['isManager'] === 'Oui',
                'role' => $this->editEmpForm['accessGroup'],
                'visibility_report' => $this->editEmpForm['visibilityReport'],
            ]);
            $this->isEditEmployeeModalOpen = false;
            session()->flash('message', "Informations de {$emp->prenom} {$emp->nom} enregistrées dans SQLite !");
        }
    }

    // Modal 3: Change Manager
    public function openEditManagerModal()
    {
        $this->isEditManagerModalOpen = true;
    }

    public function handleSaveManagerChange()
    {
        $emp = Employee::find($this->selectedEmployeeId);
        if ($emp) {
            $emp->gestionnaire = $this->editManagerForm['newManager'];
            $emp->save();

            ManagerHistory::create([
                'employee_id' => $emp->id,
                'manager' => $this->editManagerForm['newManager'],
                'start_date' => $this->editManagerForm['startDate'],
                'end_date' => '---'
            ]);

            $this->isEditManagerModalOpen = false;
            session()->flash('message', "Nouveau gestionnaire {$this->editManagerForm['newManager']} attribué !");
        }
    }

    // Modal 4: Change Weekly Hours
    public function openEditHoursModal()
    {
        $this->isEditHoursModalOpen = true;
    }

    public function handleSaveHoursChange()
    {
        $emp = Employee::find($this->selectedEmployeeId);
        if ($emp) {
            $emp->weekly_hours = (float)$this->editHoursForm['newHours'];
            $emp->save();

            HoursHistory::create([
                'employee_id' => $emp->id,
                'hours' => $emp->weekly_hours,
                'start_date' => $this->editHoursForm['startDate'],
                'end_date' => '---'
            ]);

            $this->isEditHoursModalOpen = false;
            session()->flash('message', "Contrat d'heures révisé à {$emp->weekly_hours}h !");
        }
    }

    // Modal 5: Site Affectation
    public function openEditSiteModal()
    {
        $this->isEditSiteModalOpen = true;
    }

    public function handleSaveSiteAffectation()
    {
        $emp = Employee::find($this->selectedEmployeeId);
        if ($emp) {
            $emp->site = $this->editSiteForm['newSiteName'];
            $emp->save();

            SiteHistory::create([
                'employee_id' => $emp->id,
                'site_name' => $this->editSiteForm['newSiteName'],
                'address' => 'Montréal, QC',
                'start_date' => $this->editSiteForm['startDate'],
                'end_date' => $this->editSiteForm['endDate'] ?: '---',
                'status' => 'Actif'
            ]);

            $this->isEditSiteModalOpen = false;
            session()->flash('message', "Affectation au site {$this->editSiteForm['newSiteName']} enregistrée !");
        }
    }

    
    public function showReportNotification($prenom, $nom)
    {
        session()->flash('message', "Rapport de performance de {$prenom} {$nom}");
    }

    public function showRoleNotification($prenom, $nom)
    {
        session()->flash('message', "Attribution de rôle pour {$prenom} {$nom}");
    }

    public function render()
    {
        $query = Employee::query();

        if ($this->empFilterQuery) {
            $query->where(function($q) {
                $q->where('nom', 'like', "%{$this->empFilterQuery}%")
                  ->orWhere('prenom', 'like', "%{$this->empFilterQuery}%")
                  ->orWhere('matricule', 'like', "%{$this->empFilterQuery}%");
            });
        }

        if ($this->empFilterManager) {
            $query->where('gestionnaire', 'like', "%{$this->empFilterManager}%");
        }

        if ($this->empFilterStatus !== 'all') {
            $status = $this->empFilterStatus === 'active' ? 'Activé' : 'Désactivé';
            $query->where('account_status', $status);
        }

        $employees = $query->paginate(10);
        $selectedEmployee = $this->selectedEmployeeId ? Employee::with(['hoursHistories', 'managerHistories', 'siteHistories'])->find($this->selectedEmployeeId) : null;
        $sites = CompanySite::all();

        return view('livewire.rh-component', compact('employees', 'selectedEmployee', 'sites'));
    }
}
