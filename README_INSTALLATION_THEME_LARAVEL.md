# 🚀 Guide d'Installation du Thème CRT Solution dans un Projet Laravel

Ce document fournit un guide étape par étape pour intégrer le **Thème UI CRT Solution** (Design System modernisé avec Tailwind CSS, Livewire v3 et Alpine.js) dans tout projet Laravel existant ou nouveau.

---

## 📋 Table des Matières
1. [Prérequis & Stack Technique](#-prérequis--stack-technique)
2. [Étape 1 : Configuration du Layout Principal & CSS](#-étape-1--configuration-du-layout-principal--css)
3. [Étape 2 : Barre de Navigation & Fil d'Ariane](#-étape-2--barre-de-navigation--fil-dariane)
4. [Étape 3 : Installation des Composants Blade Globaux](#-étape-3--installation-des-composants-blade-globaux)
   - [A. Le Composant Toast Global (`<x-toast />`)](#a-le-composant-toast-global-x-toast-)
   - [B. La Modale Globale de Suppression (`<x-confirm-delete-modal />`)](#b-la-modale-globale-de-suppression-x-confirm-delete-modal-)
5. [Étape 4 : Gestion des Modales avec Téléportation Alpine.js](#-étape-4--gestion-des-modales-avec-téléportation-alpinejs)
6. [Étape 5 : Exemples d'Utilisation dans vos Composants Livewire](#-étape-5--exemples-dutilisation-dans-vos-composants-livewire)
7. [Étape 6 : Publication & Nettoyage du Cache](#-étape-6--publication--nettoyage-du-cache)

---

## 🛠️ Prérequis & Stack Technique

- **Laravel 10 / 11**
- **Livewire v3** (`composer require livewire/livewire`)
- **Tailwind CSS** (via CDN ou npm)
- **Alpine.js** (intégré automatiquement avec Livewire v3)

---

## 🎨 Étape 1 : Configuration du Layout Principal & CSS

Créez ou mettez à jour votre fichier layout principal : `resources/views/components/layouts/app.blade.php` (ou `resources/views/layouts/app.blade.php`).

```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CRT Solution — Application' }}</title>

    <!-- 1. Google Fonts (Plus Jakarta Sans & JetBrains Mono) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- 2. Tailwind CSS & Palette de Couleurs Personnalisée -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        crt: {
                            navy: '#06233B',
                            'navy-dark': '#041829',
                            'navy-light': '#0E3B61',
                            cyan: '#00A8B5',
                            'cyan-dark': '#008C97',
                            'cyan-light': '#E8F7F8',
                            'cyan-glow': 'rgba(0, 168, 181, 0.15)',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    }
                }
            }
        }
    </script>

    <!-- 3. Masquage x-cloak et personnalisations CSS -->
    <style>
        [x-cloak] { display: none !important; }
        
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #F1F5F9;
            border-radius: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #00A8B5;
        }
    </style>

    @livewireStyles
</head>
<body class="bg-slate-100/90 text-slate-800 font-sans antialiased min-h-screen flex flex-col">

    <!-- HEADER / NAVIGATION -->
    @include('layouts.navigation')

    <!-- CONTENU PRINCIPAL -->
    <main class="flex-1">
        {{ $slot }}
    </main>

    <!-- FOOTER HARMONISÉ -->
    <footer class="bg-slate-900 text-white border-t border-slate-800 py-5 mt-auto">
        <div class="max-w-[1600px] mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
            <div class="flex items-center space-x-2 font-medium text-slate-300">
                <span>&copy; {{ date('Y') }} <strong class="text-white">CRT Solution</strong>. Tous droits réservés.</span>
            </div>
            <div class="flex items-center space-x-1.5 font-semibold text-slate-300">
                <span>Powered by</span>
                <span class="text-crt-cyan font-extrabold tracking-wide bg-slate-800 px-2.5 py-1 rounded-lg border border-crt-cyan/20">
                    GCS Technologie
                </span>
            </div>
        </div>
    </footer>

    <!-- COMPOSANT TOAST GLOBAL -->
    <x-toast />

    @livewireScripts
</body>
</html>
```

---

## 🧭 Étape 2 : Barre de Navigation & Fil d'Ariane

Créez le fichier de navigation : `resources/views/layouts/navigation.blade.php`.

Ce composant gère les sous-menus déroulants au clic avec **Alpine.js v3** et affiche un chevron dynamique vers la droite (`▶`) pour la page active, qui pivote vers le haut (`▲`) à l'ouverture :

```html
<header class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-20">
    <!-- Top Header Row avec Logo & Identité -->
    <div class="px-6 py-3.5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100">
        <div class="flex items-center space-x-4">
            <div class="p-1 bg-white rounded-lg flex items-center justify-center">
                <img src="/logo.png" alt="CRT Solution Logo" class="h-10 w-auto object-contain" />
            </div>
            <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>
            <div>
                <h1 class="text-base font-extrabold text-crt-navy tracking-tight flex items-center gap-2">
                    Plateforme CRT Solution
                    <span class="text-xs font-bold px-2 py-0.5 rounded-md bg-crt-cyan-light border border-crt-cyan/20 text-crt-navy">v3.0</span>
                </h1>
                <p class="text-xs text-slate-500 font-medium">Gestion RH & Entreprise</p>
            </div>
        </div>
    </div>

    <!-- Barre de Navigation Horizontale -->
    <div class="bg-slate-900 text-white relative z-30">
        <nav class="px-6 py-1 text-xs font-semibold flex items-center space-x-1.5 flex-wrap">
            
            <!-- 1. Tableau de bord -->
            <a href="/dashboard" class="flex items-center gap-2 px-3.5 py-2 rounded-lg transition-all {{ request()->is('dashboard') || request()->is('/') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Tableau de bord
                @if (request()->is('dashboard') || request()->is('/'))
                    <svg class="w-3 h-3 text-crt-navy ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                @endif
            </a>

            <!-- 2. Entreprise (avec sous-menu déroulant) -->
            <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                <button type="button" 
                        @click="open = !open" 
                        class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all cursor-pointer {{ request()->is('entreprise') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" />
                    </svg>
                    Entreprise
                    @if (request()->is('entreprise'))
                        <svg class="w-3 h-3 text-crt-navy transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" :d="open ? 'M19 9l-7 7-7-7' : 'M9 5l7 7-7 7'" />
                        </svg>
                    @else
                        <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    @endif
                </button>
                <div x-show="open" x-cloak class="absolute left-0 top-full mt-1 w-52 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50 animate-fade-in">
                    <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">ENTREPRISE</div>
                    <a href="/entreprise" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Présentation entreprise
                    </a>
                </div>
            </div>

            <!-- 3. RH (avec sous-menu déroulant) -->
            <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                <button type="button" 
                        @click="open = !open" 
                        class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg transition-all cursor-pointer {{ request()->is('rh') ? 'bg-crt-cyan text-crt-navy font-extrabold shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    RH
                    @if (request()->is('rh'))
                        <svg class="w-3 h-3 text-crt-navy transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" :d="open ? 'M19 9l-7 7-7-7' : 'M9 5l7 7-7 7'" />
                        </svg>
                    @else
                        <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180 text-crt-cyan font-bold scale-110' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    @endif
                </button>
                <div x-show="open" x-cloak class="absolute left-0 top-full mt-1 w-52 bg-white text-slate-800 rounded-xl shadow-2xl border border-slate-200 py-2 z-50 animate-fade-in">
                    <div class="px-3.5 py-1 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">RESSOURCES HUMAINES</div>
                    <a href="/rh" class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-crt-cyan-light hover:text-crt-navy transition flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-crt-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Employés
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>
```

---

## 🧩 Étape 3 : Installation des Composants Blade Globaux

### A. Le Composant Toast Global (`<x-toast />`)

Créez le fichier `resources/views/components/toast.blade.php` :

```html
<div 
    x-data="{
        toasts: [],
        add(type, message) {
            const id = Date.now();
            this.toasts.push({ id, type, message });
            setTimeout(() => this.remove(id), 4000);
        },
        remove(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
    }"
    x-on:show-toast.window="add($event.detail.type || 'info', $event.detail.message)"
    class="fixed bottom-5 right-5 z-[200] flex flex-col space-y-3 max-w-sm w-full pointer-events-none"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div 
            x-show="true"
            x-transition:enter="transition ease-out duration-300 transform translate-y-2 opacity-0"
            x-transition:enter-start="translate-y-2 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform translate-y-2 opacity-0"
            class="pointer-events-auto flex items-center justify-between p-4 rounded-xl shadow-2xl border bg-white"
            :class="{
                'border-emerald-200 text-emerald-900 bg-emerald-50/90': toast.type === 'success',
                'border-rose-200 text-rose-900 bg-rose-50/90': toast.type === 'danger' || toast.type === 'error',
                'border-amber-200 text-amber-900 bg-amber-50/90': toast.type === 'warning',
                'border-crt-cyan/30 text-crt-navy bg-crt-cyan-light/90': toast.type === 'info'
            }"
        >
            <div class="flex items-center space-x-3">
                <!-- Icone Success -->
                <template x-if="toast.type === 'success'">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </template>
                <!-- Icone Erreur -->
                <template x-if="toast.type === 'danger' || toast.type === 'error'">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </template>

                <span class="text-xs font-bold leading-tight" x-text="toast.message"></span>
            </div>

            <button @click="remove(toast.id)" class="text-slate-400 hover:text-slate-600 ml-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
</div>
```

---

### B. La Modale Globale de Suppression (`<x-confirm-delete-modal />`)

Créez le fichier `resources/views/components/confirm-delete-modal.blade.php` :

```html
@props([
    'show' => false,
    'title' => 'Confirmer la suppression',
    'confirmText' => 'Oui, supprimer',
    'cancelText' => 'Annuler',
    'onConfirm' => '',
    'onCancel' => '',
])

@if ($show)
    <template x-teleport="body">
        <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4 animate-fade-in">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
                <!-- En-tête avec titre à gauche et icône corbeille à droite -->
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-extrabold text-crt-navy">{{ $title }}</h3>
                    <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </div>

                <div class="text-sm text-slate-500 mb-6 leading-relaxed">
                    {{ $slot }}
                </div>

                <div class="flex justify-end gap-3">
                    <button 
                        type="button"
                        @if($onCancel) wire:click="{{ $onCancel }}" @endif
                        class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition cursor-pointer"
                    >
                        {{ $cancelText }}
                    </button>
                    <button 
                        type="button"
                        @if($onConfirm) wire:click="{{ $onConfirm }}" @endif
                        class="px-4 py-2 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition shadow-lg cursor-pointer"
                    >
                        {{ $confirmText }}
                    </button>
                </div>
            </div>
        </div>
    </template>
@endif
```

---

## ⚡ Étape 4 : Gestion des Modales avec Téléportation Alpine.js

Pour éviter tout problème de superposition (*z-index*) ou d'empilement dans vos vues Livewire, enrobez toujours vos modales dans un bloc `<template x-teleport="body">` :

```html
@if ($isModalOpen)
    <template x-teleport="body">
        <div class="fixed inset-0 bg-crt-navy/70 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto custom-scrollbar animate-fade-in">
                <!-- Titre de la Modale -->
                <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-5">
                    <h3 class="text-base font-extrabold text-crt-navy">Titre de la modale</h3>
                    <button wire:click="closeModal" class="text-slate-400 hover:text-slate-600">
                        &times;
                    </button>
                </div>

                <!-- Formulaire / Contenu -->
                <form wire:submit.prevent="save">
                    <!-- Champs... -->
                </form>
            </div>
        </div>
    </template>
@endif
```

---

## 💡 Étape 5 : Exemples Détaillés d'Utilisation dans vos Composants Livewire

### 1. Utilisation du Toast Global Notification (`<x-toast />`)

Le composant Toast réagit aux événements navigateur `show-toast`. Vous pouvez le déclencher depuis n'importe quel contrôleur Livewire PHP ou script JavaScript / Alpine.js.

#### A. Depuis un composant Livewire (PHP) :
```php
namespace App\Livewire;

use Livewire\Component;

class MonComposant extends Component
{
    public function enregistrer()
    {
        // 1. Toast de Succès
        $this->dispatch('show-toast', 
            type: 'success', 
            message: 'Le site a été enregistré avec succès !'
        );

        // 2. Toast d'Erreur / Danger
        $this->dispatch('show-toast', 
            type: 'danger', 
            message: 'Impossible de supprimer cet élément.'
        );

        // 3. Toast d'Avertissement
        $this->dispatch('show-toast', 
            type: 'warning', 
            message: 'Veuillez vérifier les heures saisies.'
        );

        // 4. Toast d'Information
        $this->dispatch('show-toast', 
            type: 'info', 
            message: 'Une mise à jour système est disponible.'
        );
    }
}
```

#### B. Depuis Alpine.js ou JavaScript (Blade) :
```html
<!-- Bouton Alpine.js -->
<button @click="$dispatch('show-toast', { type: 'success', message: 'Action effectuée !' })">
    Tester Toast
</button>

<!-- En JavaScript standard -->
<script>
    window.dispatchEvent(new CustomEvent('show-toast', {
        detail: { type: 'success', message: 'Enregistré en JS !' }
    }));
</script>
```

---

### 2. Utilisation du Dialog Global de Confirmation de Suppression (`<x-confirm-delete-modal />`)

Ce composant réutilisable gère le dialogue de suppression avec l'icône de corbeille rouge et le titre aligné à gauche.

#### A. Structure du Composant Livewire (PHP) :
```php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Site;

class EnterpriseComponent extends Component
{
    public bool $isDeleteSiteModalOpen = false;
    public ?Site $selectedSite = null;

    // Ouvrir le dialogue de suppression
    public function confirmDeleteSite(int $siteId)
    {
        $this->selectedSite = Site::findOrFail($siteId);
        $this->isDeleteSiteModalOpen = true;
    }

    // Fermer le dialogue
    public function closeDeleteSiteModal()
    {
        $this->isDeleteSiteModalOpen = false;
        $this->selectedSite = null;
    }

    // Exécuter la suppression
    public function deleteSite()
    {
        if ($this->selectedSite) {
            $this->selectedSite->delete();

            $this->dispatch('show-toast', 
                type: 'success', 
                message: 'Le site a été supprimé avec succès.'
            );
        }

        $this->closeDeleteSiteModal();
    }
}
```

#### B. Appel dans la Vue Blade :
```html
<!-- 1. Bouton d'action dans le tableau ou la carte -->
<button 
    wire:click="confirmDeleteSite({{ $site->id }})" 
    class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition"
    title="Supprimer"
>
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
    </svg>
</button>

<!-- 2. Composant Global de Confirmation de Suppression -->
<x-confirm-delete-modal 
    :show="$isDeleteSiteModalOpen && $selectedSite"
    title="Confirmer la suppression du site"
    confirmText="Oui, supprimer"
    cancelText="Annuler"
    onConfirm="deleteSite"
    onCancel="closeDeleteSiteModal"
>
    Êtes-vous sûr de vouloir supprimer le site 
    <strong class="font-extrabold text-crt-navy">{{ $selectedSite?->name }}</strong> ? 
    Cette action est définitive et retirera l'ensemble des données associées.
</x-confirm-delete-modal>
```

#### C. Propriétés du Composant `<x-confirm-delete-modal />` :
| Propriété | Type | Par Défaut | Description |
| :--- | :--- | :--- | :--- |
| `:show` | `bool` | `false` | Contrôle l'ouverture de la modale |
| `title` | `string` | `'Confirmer la suppression'` | Titre affiché à gauche dans l'en-tête |
| `confirmText` | `string` | `'Oui, supprimer'` | Libellé du bouton de suppression rouge |
| `cancelText` | `string` | `'Annuler'` | Libellé du bouton d'annulation |
| `onConfirm` | `string` | `''` | Méthode Livewire PHP exécutée lors de la confirmation (ex: `deleteSite`) |
| `onCancel` | `string` | `''` | Méthode Livewire PHP exécutée lors de l'annulation (ex: `closeDeleteSiteModal`) |

---

## 🧹 Étape 6 : Publication & Nettoyage du Cache

Une fois les fichiers ajoutés, exécutez ces commandes dans le terminal :

```bash
# Recompiler les vues Laravel
php artisan view:clear

# Optimiser le cache de configuration
php artisan config:clear
```

🎉 **Votre nouveau projet Laravel dispose désormais de l'ensemble du Thème UI CRT Solution !**
