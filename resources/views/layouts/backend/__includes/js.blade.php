<script src="/assets/backend/js/core.bundle.js"></script>
<script src="/assets/backend/vendors/ktui/ktui.min.js"></script>
<!-- <script src="/assets/backend/vendors/apexcharts/apexcharts.min.js"></script> -->
<!-- <script src="/assets/backend/js/widgets/general.js"></script> -->
<script src="/assets/backend/js/layouts/demo1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
@stack('js')

@if ($message = Session::get('success'))
<script>
    KTToast.show({
        icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
        progress: true,
        pauseOnHover: true,
        maxToasts: 3,
        position: 'bottom-end',
        variant: 'mono',
        message: '{{ $message }}',
    });
</script>
@endif

@if ($message = Session::get('error'))
<script>
    KTToast.show({
        icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
        progress: true,
        pauseOnHover: true,
        maxToasts: 3,
        position: 'bottom-end',
        variant: 'mono',
        message: '{{ $message }}',
    });
</script>
@endif



<div id="modalConfirm" class="kt-modal hidden" data-kt-modal="true">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header">
            <h3 class="kt-modal-title text-sm" id="modalConfirmTitle">Konfirmasi</h3>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true" onclick="document.getElementById('modalConfirm').classList.add('hidden')">
                <i class="ki-filled ki-cross"></i>
            </button>
        </div>
        <div class="kt-modal-body px-5 py-5">
            <p id="modalConfirmMessage" class="text-sm text-muted-foreground">Apakah kamu yakin?</p>
        </div>
        <div class="kt-modal-footer flex justify-end gap-2">
            <button id="modalConfirmCancel" class="kt-btn kt-btn-sm">Batal</button>
            <button id="modalConfirmOk" class="kt-btn kt-btn-sm kt-btn-mono">OK</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const btn = document.getElementById('deleteBtn');
        if (!btn) return;

        btn.addEventListener('click', function(e) {
            e.preventDefault(); // cegah reload link
            showConfirmDialog({
                title: 'Hapus Data',
                message: 'Apakah kamu yakin ingin menghapus item ini?',
                confirmText: 'Hapus',
                cancelText: 'Batal',
                onConfirm: function() {
                    console.log('Item dihapus!');
                    // contoh: window.location.href = '/logout';
                }
            });
        });
    });

    function showConfirmDialog(options) {
        const defaults = {
            title: 'Konfirmasi',
            message: 'Apakah kamu yakin?',
            confirmText: 'Ya',
            cancelText: 'Batal',
            onConfirm: () => {},
            onCancel: () => {}
        };
        const settings = {
            ...defaults,
            ...options
        };

        // isi konten
        document.getElementById('modalConfirmTitle').innerText = settings.title;
        document.getElementById('modalConfirmMessage').innerText = settings.message;
        document.getElementById('modalConfirmOk').innerText = settings.confirmText;
        document.getElementById('modalConfirmCancel').innerText = settings.cancelText;

        // tampilkan modal
        document.getElementById('modalConfirm').classList.remove('hidden');

        // binding tombol
        const okBtn = document.getElementById('modalConfirmOk');
        const cancelBtn = document.getElementById('modalConfirmCancel');

        okBtn.onclick = () => {
            settings.onConfirm();
            document.getElementById('modalConfirm').classList.add('hidden');
        };
        cancelBtn.onclick = () => {
            settings.onCancel();
            document.getElementById('modalConfirm').classList.add('hidden');
        };
    }

    $('body').on('click', '#logout_topbar', function() {
        Swal.fire({
            text: "{{ __('default.notification.confirm.logout_session') }}?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{ __('default.label.yes') }}",
            cancelButtonText: "{{ __('default.label.no') }}",
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                Swal.fire({
                    title: "Auto close alert!",
                    text: "{{ __('default.label.redirect_login') }}",
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();

                    },
                }).then(function(result) {
                    if (result.dismiss === "timer") {
                        window.location = "/dashboard/logout";
                    }
                })
            }
        });
    });
</script>