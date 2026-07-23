# 🔔 Système Global de Messages Flash et Notifications Toasts (CRT Solution)

Ce document explique le fonctionnement et l'utilisation du **système global de Toasts réutilisables** intégré dans l'application Laravel Livewire.

---

## 📐 Architecture & Composition

Le composant global est situé dans [`laravel/resources/views/components/toast.blade.php`](laravel/resources/views/components/toast.blade.php) et est automatiquement inclus dans les layouts principaux (`components/layouts/app.blade.php` et `layouts/app.blade.php`).

Il repose sur **Alpine.js**, **Livewire 3** et **Tailwind CSS** pour offrir une expérience utilisateur fluide sans rechargement de page.

### 🎨 Les 3 Types de Toasts Disponibles

| Type | Couleur de fond | Icône | Cas d'utilisation |
| :--- | :--- | :--- | :--- |
| **`success`** | `bg-emerald-600` (Vert émeraude) | Coche de validation animée (`M9 12l2 2 4-4...`) | Création d'employé, mise à jour de données, affectation de site réussie. |
| **`warning`** / **`alert`** | `bg-amber-600` (Ambre / Orange) | Triangle d'avertissement animé (`M12 9v2m0...`) | Attribution de rôles sensible, avertissements de contrat ou de quota. |
| **`info`** | `bg-crt-navy` (Navy CRT avec bordure cyan) | Bulle d'information cyan animée (`M13 16h-1...`) | Génération de rapports de performance, informations générales. |

---

## 💻 Modes d'Appel du Toast

### 1. Depuis un Composant Livewire (Méthode recommandée PHP)

Vous pouvez déclencher un Toast directement depuis vos méthodes PHP Livewire à l'aide de `$this->dispatch('show-toast')` :

```php
// 🟢 Toast Succès
$this->dispatch('show-toast', message: "Nouveau gestionnaire attribué avec succès !", type: "success");

// 🟠 Toast Avertissement
$this->dispatch('show-toast', message: "Attribution du groupe d'accès ADMINISTRATEUR", type: "warning");

// 🔵 Toast Information
$this->dispatch('show-toast', message: "Génération du rapport de performance en cours...", type: "info");
```

---

### 2. Via la Session Flash Laravel (Redirections / Page Reloads)

Lors d'une redirection ou d'une soumission classique, utilisez les clés de session `message` et `message_type` :

```php
// Enregistrement en session avec type personnalisé
session()->flash('message', 'Le site a bien été mis à jour dans SQLite !');
session()->flash('message_type', 'success'); // Options: 'success', 'warning', 'info'
```

---

### 3. Depuis Alpine.js ou JavaScript (Front-end)

Vous pouvez également déclencher un Toast depuis le navigateur en JS ou Alpine :

```javascript
// Événement personnalisé JavaScript
window.dispatchEvent(new CustomEvent('notify', { 
    detail: { 
        message: 'Notification client réinventée', 
        type: 'info' 
    } 
}));

// Ou via la fonction globale Livewire
Livewire.dispatch('show-toast', { 
    message: 'Exportation terminée', 
    type: 'success' 
});
```

---

## ⏱️ Caractéristiques & Animations

- **Positionnement** : Flottant en haut à droite de l'écran (`fixed top-4 right-4 z-[120]`).
- **Temporisation** : Disparition automatique au bout de **4.5 secondes** (`setTimeout`).
- **Fermeture manuelle** : Bouton d'action "X" pour fermer instantanément le Toast.
- **Transitions** : Glissement et fondu fluides à l'apparition et à la disparition (`x-transition`).
