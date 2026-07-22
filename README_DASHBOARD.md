# 📊 Guide d'Exploitation et de Production — Dashboard CRT Solution

Ce document détaille l'architecture, l'exploitation opérationnelle ainsi que les **points de vigilance critiques** pour la mise en production du tableau de bord de la solution **CRT Solution (Laravel Livewire v3)**.

---

## 🎯 1. Vue d'Ensemble & Objectifs Métier

Le Tableau de Bord de CRT Solution est la centrale de pilotage de l'activité. Il permet aux administrateurs, managers et collaborateurs de :
- **Suivre en temps réel** les heures saisies par rapport aux objectifs hebdomadaires.
- **Contrôler le taux de consommation budgétaire des projets** (au Forfait avec Quota vs en Régie illimitée).
- **Identifier immédiatement les feuilles de temps manquantes ou inactives** et relancer les collaborateurs en 1 clic.
- **Accéder rapidement à la saisie** de la semaine en cours.

---

## 🔍 2. Guide d'Exploitation des Composants du Dashboard

### A. En-tête Métrique & Période d'Activité
- **Indicateur de période** : Affiche la semaine d'activité courante (ex: *Du 13/07/2026 au 26/07/2026*).
- **Bouton "Rafraîchir"** : Permet une ré-évaluation instantanée des agrégats sans recharger toute la page HTML (réactivité Livewire 3 avec `$refresh`).

### B. Les 4 Cartes d'Indicateurs Métriques (KPIs)
1. **Heures de la Semaine** : Cumul total saisi vs objectif hebdo (ex: `45.5h / 37.5h`). Affiche un pourcentage de complétion dynamique (ex: `121% de l'objectif`).
2. **Projets Imputés** : Nombre de projets actifs ayant reçu des heures cette semaine.
3. **Semaines Inactives** : Nombre de semaines d'activité sans aucune imputation. Permet de déclencher la régularisation.
4. **En attente revue** : Feuilles de temps soumises par les employés nécessitant la validation du manager.

### C. Suivi du Taux de Consommation des Projets (Budget & Quota)
- **Barres de progression colorées** :
  - 🟢 **Vert (`#00A8B5`)** : Consommation normale (< 85% du quota).
  - 🟠 **Orange / Ambre** : Zone d'alerte (entre 85% et 100% du quota).
  - 🔴 **Rouge (`rose-600`)** : Dépassement de budget / Quota dépassé (> 100%).
  - 🔵 **Bleu Régie / Pulsation** : Projets en Régie sans limite de quota.
- **Filtres interactifs** : Filtrage en direct par recherche textuelle (*Code / Nom de projet*) et par typologie (*Tous*, *Forfait (Quota)*, *Régie (Illimité)*).
- **Pagination intégrée** : Navigation fluide par pages de projets pour conserver une vitesse d'affichage optimale.

### D. Gestion des Feuilles Manquantes & Relances
- **Tableau des Feuilles Absentes** : Liste des collaborateurs n'ayant pas soumis leur feuille pour la semaine en cours.
- **Action "Relancer 🔔"** : Envoie un rappel automatique par notification/email au collaborateur concerné.

---

## ⚠️ 3. Points de Vigilance Majeurs pour la Mise en Production

Lors de la migration du prototype vers une infrastructure de production à grande échelle (plusieurs centaines d'employés et des milliers de feuilles de temps), appliquez impérativement les recommandations suivantes :

### 1. 🚀 Optimisation des Performances & Requêtes SQL (N+1 Queries)
- **Problème** : Le calcul des agrégats d'heures par projet et par employé sur de gros volumes peut générer un problème de requêtes `N+1`.
- **Solution Prod** :
  - Utiliser le **Eager Loading** Eloquent (`Client::with(['tasks.hours'])`).
  - Implémenter des requêtes d'agrégation directes en SQL (`selectRaw('SUM(hours) as total_hours')`).
  - Mettre en cache Redis les statistiques globales du Dashboard avec une durée de rétention de 5 à 15 minutes (`Cache::remember('dashboard_stats', 600, ...)`).

### 2. 🗄️ Base de Données & Indexation
- **Migration vers PostgreSQL ou MySQL 8** (remplacement de SQLite dev).
- **Index obligatoires** sur la table `hours_histories` et `timesheets` :
  ```sql
  CREATE INDEX idx_employee_week_year ON hours_histories (employee_id, week_number, year);
  CREATE INDEX idx_client_project_hours ON timesheet_items (client_id, task_id);
  ```

### 3. 🔐 Sécurité & Gestion des Droits (RBAC / Policies Laravel)
- Restreindre l'accès aux cartes de statistiques globales selon le rôle de l'utilisateur connecté :
  - **EMPLOYÉ** : Ne voit que *ses* heures de la semaine et *ses* projets imputés.
  - **MANAGER** : Voit les métriques des équipes sous sa responsabilité direct.
  - **ADMINISTRATEUR** : Accès complet à l'ensemble des métriques d'entreprise.
- Implémenter des **Laravel Gates / Policies** (`Gate::authorize('view-dashboard')`).

### 4. 📬 Traitement Asynchrone des Relances (Laravel Queues & Redis)
- Ne pas envoyer d'emails de relance de manière synchrone pendant la requête HTTP du bouton "Relancer".
- Dispatcher des **Jobs Asynchrones** sur Redis / Supervisor :
  ```php
  SendTimesheetReminderJob::dispatch($employee);
  ```

### 5. 🕒 Gestion des Fuseaux Horaires et Années Financières
- S'assurer que `config/app.timezone` est configuré selon le siège social de l'entreprise (ex: `America/Montreal` ou `Europe/Paris`).
- Gérer la bascule des semaines à cheval entre deux années financières (Semaine 52 / Semaine 1).

---

## 🛠️ 4. Synthèse des Commandes Utiles

| Action | Commande |
| :--- | :--- |
| **Relancer les conteneurs Docker** | `docker-compose up -d --build` |
| **Vider les caches Laravel** | `docker exec -it crt_laravel_app php artisan cache:clear` |
| **Rejouer les Migrations & Seeders** | `docker exec -it crt_laravel_app php artisan migrate:fresh --seed` |
| **Exécuter les Tests d'Intégration** | `docker exec -it crt_laravel_app php artisan test` |

---

*Document rédigé pour CRT Solution — Version 3.0 (Laravel Livewire)*
