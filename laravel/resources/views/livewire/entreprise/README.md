# 📁 Structure Modulaire du Module Entreprise (Livewire v3)

Ce dossier contient les sous-vues Blade modulaires du composant **Entreprise** (`EnterpriseComponent`). Conformément au pattern **ADR (Action-Domain-Responder)**, la vue monolithique d'origine a été découpée en composants de présentation ciblés pour améliorer la maintenabilité, la lisibilité et la réutilisabilité du code.

---

## 📂 Arborescence des Fichiers

```
resources/views/livewire/
├── entreprise-component.blade.php  # Template principal d'assemblage
└── entreprise/
    ├── README.md                   # Ce document explicatif
    ├── info-card.blade.php         # Informations de l'entreprise (Mode Consultation / Saisie)
    ├── sites-list.blade.php        # Tableau des sites & barre de recherche
    ├── modal-create-site.blade.php # Modale de création d'un nouveau site
    ├── modal-view-site.blade.php   # Modale de consultation de la fiche d'un site
    ├── modal-edit-site.blade.php   # Modale de modification d'un site
    └── modal-delete-site.blade.php # Dialog global de confirmation de suppression
```

---

## 🔍 Description des Sous-Vues

### 1. `info-card.blade.php`
- **Rôle** : Affiche la carte principale d'information de l'entreprise.
- **Fonctionnalités** :
  - **Mode Consultation** : Affichage en lecture seule (Nom, Délai de probation, Description).
  - **Mode Édition (Saisie)** : Formulaire de modification en direct des informations avec gestion des erreurs de validation Livewire.

### 2. `sites-list.blade.php`
- **Rôle** : Affiche la liste des sites rattachés à l'entreprise.
- **Fonctionnalités** :
  - Compteur dynamique de sites (`{{ count($sites) }}`).
  - Bouton **Nouveau site** (visible en mode Saisie).
  - Champ de recherche en temps réel (`wire:model.live="siteSearchQuery"`).
  - Tableau des sites avec actions (Consulter, Modifier, Supprimer).

### 3. `modal-create-site.blade.php`
- **Rôle** : Modale d'ajout d'un nouveau site.
- **Téléportation** : Enrobée dans `<template x-teleport="body">` pour éviter tout conflit de superposition z-index.
- **Champs** : Nom, description, adresse complète, téléphone, téléphone pro, extension.

### 4. `modal-view-site.blade.php`
- **Rôle** : Modale de consultation en lecture seule des détails d'un site sélectionné.

### 5. `modal-edit-site.blade.php`
- **Rôle** : Modale de modification des informations d'un site existant.

### 6. `modal-delete-site.blade.php`
- **Rôle** : Intégration du composant global `<x-confirm-delete-modal />`.
- **Visuel** : En-tête avec titre aligné à gauche et icône corbeille rouge à droite.

---

## ⚙️ Exemple d'Assemblage (`entreprise-component.blade.php`)

Le template principal assemble très simplement ces sous-vues via la directive Blade `@include` :

```blade
<div x-data x-effect="document.body.classList.toggle('overflow-hidden', $wire.isCreateSiteModalOpen || $wire.isViewSiteModalOpen || $wire.isEditSiteModalOpen || $wire.isDeleteSiteModalOpen)" class="p-6 space-y-6 max-w-[1600px] mx-auto w-full">

    <!-- Card 1: Informations de l'Entreprise (Consultation / Édition) -->
    @include('livewire.entreprise.info-card')

    <!-- Card 2: Sites de l'entreprise (Tableau / Recherche) -->
    @include('livewire.entreprise.sites-list')

    <!-- Modales du Module Entreprise -->
    @include('livewire.entreprise.modal-create-site')
    @include('livewire.entreprise.modal-view-site')
    @include('livewire.entreprise.modal-edit-site')
    @include('livewire.entreprise.modal-delete-site')

</div>
```

---

## 🎯 Avantages de cette Structure

1. **Modularité & Lisibilité** : Chaque fichier fait moins de 100 lignes et possède un rôle unique.
2. **Maintenance Facilitée** : Modifier le formulaire d'un site ou le tableau n'impacte pas le reste de la page.
3. **Alignement ADR (Action-Domain-Responder)** : Séparation claire entre la logique d'action du contrôleur Livewire et les répondeurs visuels spécialisés.
