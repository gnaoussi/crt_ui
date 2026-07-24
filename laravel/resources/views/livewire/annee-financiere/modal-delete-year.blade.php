<!-- MODALE: Confirmation de suppression d'une Année Financière -->
<x-confirm-delete-modal 
    :show="$isDeleteModalOpen && $deleteTargetAnnee"
    title="Confirmer la suppression"
    confirmText="Oui, supprimer"
    cancelText="Annuler"
    onConfirm="deleteAnnee"
    onCancel="$set('isDeleteModalOpen', false)"
>
    Êtes-vous sûr de vouloir supprimer l'année financière <strong class="font-extrabold text-crt-navy font-mono">{{ $deleteTargetAnnee['startDate'] ?? '' }} - {{ $deleteTargetAnnee['endDate'] ?? '' }}</strong> ? Cette action est irréversible.
</x-confirm-delete-modal>
