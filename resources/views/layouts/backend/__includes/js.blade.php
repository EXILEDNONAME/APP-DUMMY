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

<script>
    $('body').on('click', '#logout_default', function() {
        Swal.fire({
    // title: 'Konfirmasi Logout',
    text: 'Apakah kamu yakin ingin logout?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Logout',
    cancelButtonText: 'Batal',
    // width: 350,          // lebar modal mini
    
});
    });

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