# Architecture et Partiels du Module Année Financière (ADR Alignment)

Ce dossier contient les partiels de vue Blade pour le module **Année Financière** (`AnneeFinanciereComponent`), structurés selon les principes de l'architecture **Action-Domain-Responder (ADR)** et la décomposition modulaire.

---

## 📁 Structure du Dossier

```
laravel/resources/views/livewire/annee-financiere/
├── README.md                 # Documentation du module
├── list-years.blade.php      # Grille d'historique des années financières avec sélecteur d'année et garde-fous actions
├── detail-year.blade.php    # Fiche détaillée avec 4 cartes KPI, semaines et pagination Option A (numérotée)
├── modal-create-year.blade.php # Modale de création d'une année financière
└── modal-edit-year.blade.php   # Modale d'édition d'une année financière (si pas de feuilles de temps)
```

---

## 🛠️ Composition de la Vue Principale

La vue wrapper [`annee-financiere-component.blade.php`](file:///home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/livewire/annee-financiere-component.blade.php) fait office de *Responder* principal en assemblant dynamiquement les partiels selon l'état du composant :

```blade
@if ($viewMode === 'list')
    @include('livewire.annee-financiere.list-years')
@else
    @include('livewire.annee-financiere.detail-year')
@endif

@include('livewire.annee-financiere.modal-create-year')
@include('livewire.annee-financiere.modal-edit-year')
```

---

## ⚖️ Règles de Gestion Intégrées

1. **Guard `hasTimesheets`** :
   - Les boutons d'Édition (`✏️`) et de Suppression (`🗑️`) ne sont cliquables que si **aucune feuille de temps (`hasTimesheets === false`)** n'a été enregistrée sur l'année.
   - Si `hasTimesheets === true`, les boutons sont grises et affichent une infobulle explicative.
2. **Filtre par Année de début** :
   - Un sélecteur déroulant (`select`) permet de filtrer rapidement les exercices par leur année de début.
3. **Actions directes en ligne sur les semaines** :
   - 🔒 **Fermer / Ouvrir**
   - 🚫 **Activer / Désactiver**
   - 📅 **Semaine de Paie**
   - 🔄 **Journal d'audit**
4. **Pagination Uniformisée (Option A)** :
   - Alignée sur le standard global de l'application : `Montrant X à Y de Z résultats` avec pavé de navigation numéroté (`‹ 1 2 3 ... ›`).
