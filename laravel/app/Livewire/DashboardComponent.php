<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardComponent extends Component
{
    public $dashboardProjectSearch = '';
    public $dashboardProjectTypeFilter = 'all';
    public $dashboardPage = 1;
    public $projectsPerPage = 4;

    public $projects = [
        ['id' => 1, 'code' => 'STARK-01', 'name' => 'Stark Industries', 'consumedHours' => 142.5, 'maxQuota' => 120, 'isQuota' => true],
        ['id' => 2, 'code' => 'ORANGE-02', 'name' => 'Orange Cloud Migration', 'consumedHours' => 88.0, 'maxQuota' => 100, 'isQuota' => true],
        ['id' => 3, 'code' => 'RENAULT-03', 'name' => 'Renault Software Architecture', 'consumedHours' => 64.0, 'maxQuota' => null, 'isQuota' => false],
        ['id' => 4, 'code' => 'LOREAL-04', 'name' => 'L\'Oréal Figma Integration', 'consumedHours' => 31.5, 'maxQuota' => 40, 'isQuota' => true],
        ['id' => 5, 'code' => 'TOTAL-05', 'name' => 'TotalEnergies ERP Sync', 'consumedHours' => 110.0, 'maxQuota' => 150, 'isQuota' => true],
        ['id' => 6, 'code' => 'BNP-06', 'name' => 'BNP Paribas Security Audit', 'consumedHours' => 45.0, 'maxQuota' => null, 'isQuota' => false],
    ];

    public function setDashboardProjectTypeFilter($filter)
    {
        $this->dashboardProjectTypeFilter = $filter;
        $this->dashboardPage = 1;
    }

    public function updatedDashboardProjectSearch()
    {
        $this->dashboardPage = 1;
    }

    public function setPage($page)
    {
        $this->dashboardPage = $page;
    }

    public function render()
    {
        $filteredProjects = array_filter($this->projects, function ($proj) {
            $matchesSearch = empty($this->dashboardProjectSearch) ||
                str_contains(strtolower($proj['name']), strtolower($this->dashboardProjectSearch)) ||
                str_contains(strtolower($proj['code']), strtolower($this->dashboardProjectSearch));

            $matchesFilter = $this->dashboardProjectTypeFilter === 'all' ||
                ($this->dashboardProjectTypeFilter === 'quota' && $proj['isQuota']) ||
                ($this->dashboardProjectTypeFilter === 'regie' && !$proj['isQuota']);

            return $matchesSearch && $matchesFilter;
        });

        $totalFiltered = count($filteredProjects);
        $totalPages = max(1, ceil($totalFiltered / $this->projectsPerPage));
        $currentPageProjects = array_slice(array_values($filteredProjects), ($this->dashboardPage - 1) * $this->projectsPerPage, $this->projectsPerPage);

        return view('livewire.dashboard-component', [
            'filteredDashboardProjects' => $currentPageProjects,
            'totalFilteredProjects' => $totalFiltered,
            'totalDashboardPages' => $totalPages,
            'totalProjects' => count($this->projects)
        ]);
    }
}
