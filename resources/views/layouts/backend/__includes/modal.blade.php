<!-- MODAL LOGOUT -->
<div class="kt-modal" data-kt-modal="true" id="modalLogout">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header items-center justify-center">
            <h3 class="kt-modal-title text-sm"> {{ __('default.notification.confirm.logout_session') }} </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button id="confirmLogout" class="kt-btn flex items-center gap-2"> Yes </button>
            <button id="cancelLogout" class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> Cancel </button>
        </div>
    </div>
</div>