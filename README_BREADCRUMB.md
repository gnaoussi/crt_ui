# 🍞 Documentation du Composant Fil d'Ariane (*Breadcrumb*)

Cette documentation détaille le fonctionnement, l'architecture, la réactivité Livewire et les guides de mise en place du **Fil d'Ariane (*Breadcrumb*)** pour l'application Laravel Livewire de **CRT Solution**.

---

## 🎨 Spécifications Visuelles & Alignement

- **Alignement** : 100% à gauche sur toute la largeur de l'écran (`px-6 py-2`).
- **Fond & Bordure** : Fond blanc avec bordure inférieure subtile (`bg-white border-b border-slate-200/80`).
- **Typographie & Tailles** :
  - **Lien Accueil** : Icône SVG (`w-3.5 h-3.5 text-crt-cyan stroke-width="1.8"`) avec texte `Accueil` cliquable (`hover:text-crt-navy`).
  - **Séparateur** : Slash grisé `text-slate-300` (`/`).
  - **Section Parente** : Texte grisé cliquable (`text-slate-600 hover:text-crt-navy`).
  - **Lien Intermédiaire (Vue parente)** : Bouton ou lien cliquable interactif (ex: `wire:click="backToList"`).
  - **Item Actif (Feuille / Vue active)** : Badge pill turquoise rétroéclairé (`px-2.5 py-0.5 rounded-md bg-crt-cyan-light text-crt-navy font-extrabold border border-crt-cyan/20`).

---

## ⚡ Réactivité Livewire v3 (Single-Page App Experience)

Dans une application Livewire v3 avec basculement de vues au sein d'un composant (ex: passage de la vue **Liste** à la vue **Détail** sans rechargement de page), le layout principal HTML statique n'est pas réévalué lors d'une requête AJAX.

Pour garantir que le fil d'Ariane se mette à jour **instantanément lors des événements Livewire**, la barre de navigation Fil d'Ariane est placée au sommet de la vue racine du composant Livewire réactif.

### 📌 Modèle d'Intégration d'un nouveau Module Réactif

Pour ajouter la gestion dynamique du Fil d'Ariane à un nouveau composant Livewire (ex: `ModuleXComponent`) :

1. **Exclure la route dans le Layout global (`app.blade.php`)** :
   ```blade
   <!-- Sub Header Breadcrumb Navigation Bar -->
   @if(!request()->is('rh*') && !request()->is('annee-financiere*') && !request()->is('votre-module*'))
       <x-breadcrumb />
   @endif
   ```

2. **Ajouter la barre de fil d'Ariane réactive en haut du template Blade du composant** (ex: `resources/views/livewire/votre-module-component.blade.php`) :
   ```blade
   <div x-data>
       <!-- Sub Header Breadcrumb Navigation Bar (Livewire Reactive) -->
       <div class="bg-white border-b border-slate-200/80 px-6 py-2 flex flex-col md:flex-row items-start md:items-center justify-between gap-3 text-xs font-semibold">
           <nav class="flex items-center space-x-2 text-slate-600">
               <a href="/dashboard" class="flex items-center gap-1 hover:text-crt-navy transition cursor-pointer">
                   <svg class="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                   </svg>
                   Accueil
               </a>
               <span class="text-slate-300">/</span>
               <span class="text-slate-600 hover:text-crt-navy cursor-pointer">NomDuGroupe</span>
               <span class="text-slate-300">/</span>

               @if ($viewMode === 'detail' && $selectedItem)
                   <!-- Niveau 1 cliquable pour retourner à la liste -->
                   <button wire:click="backToList" class="flex items-center gap-1 hover:text-crt-navy transition cursor-pointer text-slate-600 font-semibold">
                       NomDuModule
                   </button>
                   <span class="text-slate-300">/</span>
                   <!-- Niveau 2 actif (Détail de l'élément) -->
                   <span class="text-crt-navy font-extrabold bg-crt-cyan-light text-crt-navy px-2.5 py-0.5 rounded-md border border-crt-cyan/20">
                       Détails {{ $selectedItem->name }}
                   </span>
               @else
                   <!-- Niveau 1 actif (Liste) -->
                   <span class="text-crt-navy font-extrabold bg-crt-cyan-light text-crt-navy px-2.5 py-0.5 rounded-md border border-crt-cyan/20">
                       NomDuModule
                   </span>
               @endif
           </nav>
       </div>

       <!-- Reste du contenu avec padding p-6 -->
       <div class="p-6 space-y-6 max-w-[1600px] mx-auto w-full">
           ...
       </div>
   </div>
   ```

---

## 🗺️ Cartographie d'Utilisation par Module

| Module | Route / Component | Vue Liste (État par défaut) | Vue Détail (Au clic / Sélection) |
| :--- | :--- | :--- | :--- |
| **Dashboard** | `/dashboard` | `Accueil` / `Dashboard` / **`Tableau de bord`** | - |
| **Années Financières (Budget)** | `/annee-financiere` | `Accueil` / `Budget` / **`Années Financières`** | `Accueil` / `Budget` / `Années Financières` / **`Détails [Dates]`** |
| **Ressources Humaines (RH)** | `/rh` | `Accueil` / `RH` / **`Employés`** | `Accueil` / `RH` / `Employés` / **`[Prénom Nom]`** |
| **Entreprise** | `/entreprise` | `Accueil` / `Entreprise` / **`Présentation entreprise`** | - |
| **Feuilles de Temps** | `/timesheets` | `Accueil` / `Feuilles de Temps` / **`Projets & Suivi Hebdomadaire`** | - |
