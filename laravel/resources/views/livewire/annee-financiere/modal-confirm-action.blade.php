<!-- MODALE: Confirmation d'action générique pour le module Année Financière -->
<x-confirm-action-modal 
    :show="$isConfirmActionModalOpen"
    :title="$confirmActionTitle"
    :confirmText="$confirmActionConfirmText"
    :cancelText="$confirmActionCancelText"
    :confirmColor="$confirmActionColor"
    :iconBg="$confirmActionIconBg"
    onConfirm="executeConfirmedAction"
    onCancel="$set('isConfirmActionModalOpen', false)"
>
    {{ $confirmActionMessage }}
</x-confirm-action-modal>
