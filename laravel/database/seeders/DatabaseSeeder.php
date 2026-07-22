<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanySite;
use App\Models\Employee;
use App\Models\HoursHistory;
use App\Models\ManagerHistory;
use App\Models\SiteHistory;
use App\Models\Client;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Company Sites
        $site1 = CompanySite::create([
            'name' => 'Centre Ville-Marie',
            'description' => 'Centre de services directs aux clients offrant des conseils et accompagnements informatiques.',
            'address' => '1001 rue Sherbrooke Est, Apt. 3e étage',
            'city' => 'Montréal',
            'postal_code' => 'H2L 1L3',
            'phone' => '514.598.7722',
            'phone_pro' => '514.598.7722 (301)',
            'extension' => '301'
        ]);

        $site2 = CompanySite::create([
            'name' => 'Centre administratif',
            'description' => 'Bureau de gestion des ressources humaines, comptabilité et direction générale CRT.',
            'address' => '4388 rue Saint-Denis, Apt. 2e étage',
            'city' => 'Montréal',
            'postal_code' => 'H2J 2L1',
            'phone' => '514.844.7373',
            'phone_pro' => '514.844.7373 (701)',
            'extension' => '701'
        ]);

        $site3 = CompanySite::create([
            'name' => 'Siège social CRT Solution',
            'description' => 'Bureau principal de la Table de concertation des organismes informatiques.',
            'address' => '1610 rue Sainte-Catherine Ouest, Apt. Bureau 401',
            'city' => 'Montréal',
            'postal_code' => 'H3H 2S2',
            'phone' => '514.272.2532',
            'phone_pro' => '514.272.2532 (101)',
            'extension' => '101'
        ]);

        // 2. Seed Initial Employees
        $emp1 = Employee::create([
            'matricule' => 'mat-2',
            'nom' => 'Richmond',
            'prenom' => 'Mitch',
            'dob' => '07-21',
            'email' => 'mitch.richmond@gmail.com',
            'role' => 'ADMINISTRATEUR',
            'gestionnaire' => 'Admin Plateforme GCS',
            'probation_status' => '1 heure restante',
            'account_status' => 'Activé',
            'visibility_report' => 'Oui',
            'is_manager' => false,
            'weekly_hours' => 40.0,
            'hire_date' => '2026-07-20',
            'site' => 'Centre Ville-Marie'
        ]);

        HoursHistory::create([
            'employee_id' => $emp1->id,
            'hours' => 40.0,
            'start_date' => '2026-07-20 12:37:28',
            'end_date' => '---'
        ]);

        ManagerHistory::create([
            'employee_id' => $emp1->id,
            'manager' => 'Admin Plateforme GCS',
            'start_date' => '2026-07-20 12:37:28',
            'end_date' => '---'
        ]);

        SiteHistory::create([
            'employee_id' => $emp1->id,
            'site_name' => 'Centre Ville-Marie',
            'address' => '1001 rue Sherbrooke Est H2L 1L3, Apt. 3e étage',
            'start_date' => '2026-07-21 12:00:00',
            'end_date' => '2026-07-30 12:00:00',
            'status' => 'Actif'
        ]);

        $emp2 = Employee::create([
            'matricule' => 'EMP2026-084',
            'nom' => 'DENOU',
            'prenom' => 'Fabrice',
            'dob' => '14-03',
            'email' => 'fabrice.denou@crt-solution.ca',
            'role' => 'ADMINISTRATEUR',
            'gestionnaire' => 'Admin Plateforme GCS',
            'probation_status' => '1 heure restante',
            'account_status' => 'Activé',
            'visibility_report' => 'Oui',
            'is_manager' => true,
            'weekly_hours' => 37.5,
            'hire_date' => '2026-06-15',
            'site' => 'Centre administratif'
        ]);

        HoursHistory::create([
            'employee_id' => $emp2->id,
            'hours' => 37.5,
            'start_date' => '2026-06-15 09:00:00',
            'end_date' => '---'
        ]);

        ManagerHistory::create([
            'employee_id' => $emp2->id,
            'manager' => 'Admin Plateforme GCS',
            'start_date' => '2026-06-15 09:00:00',
            'end_date' => '---'
        ]);

        SiteHistory::create([
            'employee_id' => $emp2->id,
            'site_name' => 'Centre administratif',
            'address' => '4388 rue Saint-Denis H2J 2L1',
            'start_date' => '2026-06-15 09:00:00',
            'end_date' => '---',
            'status' => 'Actif'
        ]);

        // 3. Seed Fake Employees with Faker
        $faker = \Faker\Factory::create('fr_CA');
        for ($i = 4; $i <= 15; $i++) {
            $fEmp = Employee::create([
                'matricule' => 'EMP2026-' . sprintf('%03d', $i),
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'dob' => $faker->date('m-d'),
                'email' => $faker->unique()->safeEmail,
                'role' => $faker->randomElement(['ADMINISTRATEUR', 'MANAGER', 'EMPLOYE']),
                'gestionnaire' => 'Fabrice DENOU',
                'probation_status' => 'Terminée',
                'account_status' => 'Activé',
                'visibility_report' => 'Oui',
                'is_manager' => $faker->boolean(20),
                'weekly_hours' => $faker->randomElement([35.0, 37.5, 40.0]),
                'hire_date' => $faker->date(),
                'site' => 'Centre Ville-Marie'
            ]);

            HoursHistory::create([
                'employee_id' => $fEmp->id,
                'hours' => $fEmp->weekly_hours,
                'start_date' => $fEmp->hire_date . ' 09:00:00',
                'end_date' => '---'
            ]);
        }

        // 4. Seed Clients & Tasks
        $clientNames = [
            "Acme Corporation", "Globex Industries", "Initech Solutions", "Umbrella Corp", "Wayne Enterprises",
            "Stark Industries", "Hooli Tech", "Vehement Capital", "Soylent Green Co.", "Cyberdyne Systems",
            "L'Oréal Division Luxe", "Renault Software Factory", "Air France KLM", "SNCF Connect", "TotalEnergies IT"
        ];

        foreach ($clientNames as $index => $cName) {
            $client = Client::create(['name' => $cName]);
            Task::create(['client_id' => $client->id, 'name' => 'Développement Architecture Backend (API)']);
            Task::create(['client_id' => $client->id, 'name' => 'Intégration Maquettes Figma Frontend']);
            Task::create(['client_id' => $client->id, 'name' => 'Gestion de Projet & Sprint Planning']);
        }
    }
}
