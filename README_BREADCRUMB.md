# 🍞 Documentation du Composant Fil d'Ariane (*Breadcrumb*)

Cette documentation détaille le fonctionnement, l'architecture et la cartographie d'utilisation du **Fil d'Ariane (*Breadcrumb*)** harmonisé pour le prototype HTML/React et l'application Laravel Livewire de **CRT Solution**.

---

## 🎨 Spécifications Visuelles & Alignement

- **Alignement** : 100% à gauche sur toute la largeur de l'écran (`px-6 py-2`).
- **Fond & Bordure** : Fond blanc avec bordure inférieure subtile (`bg-white border-b border-slate-200/80`).
- **Typographie & Tailles** :
  - **Lien Accueil** : Icône SVG (`w-3.5 h-3.5 text-crt-cyan stroke-width="1.8"`) avec texte `Accueil` cliquable (`hover:text-crt-navy`).
  - **Séparateur** : Slash grisé `text-slate-300` (`/`).
  - **Section Parente** : Texte grisé cliquable (`text-slate-600 hover:text-crt-navy`).
  - **Item Actif (Feuille)** : Badge pill turquoise rétroéclairé (`px-2.5 py-0.5 rounded-md bg-crt-cyan-light text-crt-navy font-extrabold border border-crt-cyan/20`).

---

## ⚙️ Architecture Technologique

### 1. Prototype HTML/React (`index.html`)
Dans le prototype React, la barre de navigation fil d'Ariane est rendue de manière réactive selon les états `activeMenuItem.section` et `activeMenuItem.item`.

- **Fichier principal** : [`index.html`](file:///home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html)
- **Position** : Placé directement sous le `<header>` principal de l'application.

```jsx
{/* Breadcrumb Bar */}
<div className="bg-white border-b border-slate-200/80 px-6 py-2 flex flex-col md:flex-row items-start md:items-center justify-between gap-3 text-xs font-semibold">
    <nav className="flex items-center space-x-2 text-slate-600">
        <span className="flex items-center gap-1 hover:text-crt-navy cursor-pointer" onClick={() => selectMenuItem('Dashboard', 'Tableau de bord')}>
            <svg className="w-3.5 h-3.5 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Accueil
        </span>
        <span className="text-slate-300">/</span>
        <span className="text-slate-600 hover:text-crt-navy cursor-pointer">{activeMenuItem.section}</span>
        <span className="text-slate-300">/</span>
        <span className="text-crt-navy font-extrabold bg-crt-cyan-light text-crt-navy px-2.5 py-0.5 rounded-md border border-crt-cyan/20">
            {activeMenuItem.item}
        </span>
    </nav>
</div>
```

---

### 2. Application Laravel Livewire (`<x-breadcrumb />`)
Dans l'application Laravel, le fil d'Ariane est encapsulé dans un composant Blade réutilisable :

- **Composant Blade** : [`laravel/resources/views/components/breadcrumb.blade.php`](file:///home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/breadcrumb.blade.php)
- **Inclusion globale** : [`laravel/resources/views/components/layouts/app.blade.php`](file:///home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/layouts/app.blade.php)

#### Usage 1 : Détection Automatique (Mode Fallback par Défaut)
Appelé sans argument dans le layout principal, il inspecte automatiquement la route (`request()->is(...)`) pour générer le fil d'Ariane :

```blade
<x-breadcrumb />
```

#### Usage 2 : Configuration Personnalisée (Tableau d'Éléments)
Vous pouvez surcharger le fil d'Ariane dans n'importe quelle vue ou composant en fournissant un tableau `:items` :

```blade
<x-breadcrumb :items="[
    ['label' => 'Accueil', 'url' => '/dashboard'],
    ['label' => 'Budget', 'url' => '#'],
    ['label' => 'Années Financières', 'url' => '/annee-financiere'],
    ['label' => 'Détail 2026-2027', 'active' => true]
]" />
```

---

## 🗺️ Cartographie d'Utilisation par Module

Voici la liste exacte des emplacements et arborescences générées pour chaque module de l'application :

| Module | Route / Vue Laravel | Arborescence du Fil d'Ariane |
| :--- | :--- | :--- |
| **Dashboard** | `/dashboard` | `Accueil` / `Dashboard` / **`Tableau de bord`** |
| **Années Financières** | `/annee-financiere` (Vues Liste et Détail) | `Accueil` / `Budget` / **`Années Financières`** |
| **Ressources Humaines (RH)** | `/rh` (Vues Liste et Détail Employé) | `Accueil` / `RH` / **`Employés`** |
| **Entreprise** | `/entreprise` (Informations & Sites) | `Accueil` / `Entreprise` / **`Présentation entreprise`** |
| **Feuilles de Temps** | `/timesheets` (Modes Saisie & Consultation) | `Accueil` / `Feuilles de Temps` / **`Projets & Suivi Hebdomadaire`** |

---

## 📌 Maintenance & Évolutions

Pour ajouter un nouveau module ou une sous-vue dans Laravel, ajoutez simplement le cas dans le tableau de fallback de [`breadcrumb.blade.php`](file:///home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/resources/views/components/breadcrumb.blade.php) ou passez la propriété `:items` directement au composant.
