<script>
    fetch("{{ route('assets.lang') }}").then(response => {
        return response.json();
    }).then(data => {
        translations = data;
    });
    window.translations = {
        default: {
            label: {
                no_data_available: "{{ __('default.label.no_data_available') }}",
                no_data_matching: "{{ __('default.label.no_data_matching') }}",
            }
        }
    };
</script>

<script>
    var this_url = "{{ URL::Current() }}";
    var active = "{{ !empty($active) && $active == 'true' ? 'true' : '' }}";
    var date = "{{ !empty($date) && $date == 'true' ? 'true' : '' }}";
    var datetime = "{{ !empty($datetime) && $datetime == 'true' ? 'true' : '' }}";
    var daterange = "{{ !empty($daterange) && $daterange == 'true' ? 'true' : '' }}";
    var file = "{{ !empty($file) && $file == 'true' ? 'true' : '' }}";
    var status = "{{ !empty($status) && $status == 'true' ? 'true' : '' }}";
    var extensions = "{{ !empty($extension) && $extension == 'management-users' ? 'management-users' : '' }}";
    var sort = "{{ !empty($sort) && $sort > 0 ? $sort : '1, desc' }}";
    window.tableBodyColumns = [
        @yield('table-body')
    ];
</script>

<!-- <script src="{{ env('APP_URL') }}/assets/backend/js/core.bundle.js"></script>
<script src="{{ env('APP_URL') }}/assets/backend/vendors/ktui/ktui.min.js"></script>
<script src="{{ env('APP_URL') }}/assets/backend/js/jquery-3.7.1.min.js"></script>
<script src="{{ env('APP_URL') }}/assets/backend/js/sweetalert.js"></script>
<script src="{{ env('APP_URL') }}/assets/backend/js/flatpickr.js"></script>
-->

<script src="{{ env('APP_URL') }}/assets/backend/mix/js/app-core.js"></script>
<script>
    flatpickr("#datepicker", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        allowInput: true,
        disableMobile: true
    });
</script>
<script>
    function toast_notification(message) {
        KTToast.show({
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
            progress: true,
            pauseOnHover: true,
            maxToasts: 3,
            position: 'bottom-end',
            variant: 'mono',
            message: message
        });
    }
</script>

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
    document.addEventListener('DOMContentLoaded', function() {

        var sidebar = document.getElementById('sidebar');
        var ktSidebar = KTDrawer.getInstance(sidebar);
        if (ktSidebar) ktSidebar.hide();

        // SESSION LOGOUT 
        var confirmLogout = document.getElementById('confirmLogout');
        var cancelLogout = document.getElementById('cancelLogout');
        confirmLogout.addEventListener('click', function() {
            confirmLogout.innerHTML = `<svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/></svg> Logging Out ...`;
            confirmLogout.disabled = true;
            cancelLogout.disabled = true;
            var modalEl = document.getElementById('modalLogout');
            var modal = KTModal.getInstance(modalEl);
            setTimeout(() => {
                window.location.href = '/dashboard/logout';
            }, 3000);
        });

    });
</script>

<script>
    $(`<div id="tooltip_activities" class="kt-tooltip"> {{ __('default.label.activities') }} </div>`).appendTo('body');
    $(`<div id="tooltip_back" class="kt-tooltip"> {{ __('default.label.back') }} </div>`).appendTo('body');
    $(`<div id="tooltip_batch_action" class="kt-tooltip"> {{ __('default.label.batch_action') }} </div>`).appendTo('body');
    $(`<div id="tooltip_create" class="kt-tooltip"> {{ __('default.label.create') }} </div>`).appendTo('body');
    $(`<div id="tooltip_edit" class="kt-tooltip"> {{ __('default.label.edit') }} </div>`).appendTo('body');
    $(`<div id="tooltip_export" class="kt-tooltip"> {{ __('default.label.export.export') }} </div>`).appendTo('body');
    $(`<div id="tooltip_export_description_copy" class="kt-tooltip"> {{ __('default.label.export.description.copy') }} </div>`).appendTo('body');
    $(`<div id="tooltip_export_description_csv" class="kt-tooltip"> {{ __('default.label.export.description.csv') }} </div>`).appendTo('body');
    $(`<div id="tooltip_export_description_excel" class="kt-tooltip"> {{ __('default.label.export.description.excel') }} </div>`).appendTo('body');
    $(`<div id="tooltip_export_description_pdf" class="kt-tooltip"> {{ __('default.label.export.description.pdf') }} </div>`).appendTo('body');
    $(`<div id="tooltip_export_description_print" class="kt-tooltip"> {{ __('default.label.export.description.print') }} </div>`).appendTo('body');
    $(`<div id="tooltip_filter" class="kt-tooltip"> {{ __('default.label.filter') }} </div>`).appendTo('body');
    $(`<div id="tooltip_preview" class="kt-tooltip"> {{ __('default.label.preview') }} </div>`).appendTo('body');
    $(`<div id="tooltip_print" class="kt-tooltip"> {{ __('default.label.print') }} </div>`).appendTo('body');
    $(`<div id="tooltip_reload" class="kt-tooltip"> {{ __('default.label.reload') }} </div>`).appendTo('body');
    $(`<div id="tooltip_search" class="kt-tooltip"> {{ __('default.label.search') }} </div>`).appendTo('body');
    $(`<div id="tooltip_trash" class="kt-tooltip"> {{ __('default.label.trash') }} </div>`).appendTo('body');
</script>