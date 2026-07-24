<!-- MODALE: Confirmation de suppression du Site -->
<x-confirm-delete-modal 
    :show="$isDeleteSiteModalOpen && $selectedSite"
    title="Confirmer la suppression"
    confirmText="Oui, supprimer"
    cancelText="Annuler"
    onConfirm="deleteSite"
    onCancel="$set('isDeleteSiteModalOpen', false)"
>
    Êtes-vous sûr de vouloir supprimer le site <strong class="font-extrabold text-crt-navy">{{ $selectedSite?->name }}</strong> ? Cette action est irréversible.
</x-confirm-delete-modal>
