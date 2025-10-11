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
                activities: "{{ __('default.label.activities') }}",
                back: "{{ __('default.label.back') }}",
                batch_action: "{{ __('default.label.batch_action') }}",
                create: "{{ __('default.label.create') }}",
                delete: "{{ __('default.label.delete.delete') }}",
                edit: "{{ __('default.label.edit') }}",
                export: "{{ __('default.label.export.export') }}",
                export_description_copy: "{{ __('default.label.export.description.copy') }}",
                export_description_csv: "{{ __('default.label.export.description.csv') }}",
                export_description_excel: "{{ __('default.label.export.description.excel') }}",
                export_description_pdf: "{{ __('default.label.export.description.pdf') }}",
                export_description_print: "{{ __('default.label.export.description.print') }}",
            }
        }
    };
</script>

<script>
    var this_url = "{{ URL::Current() }}";
    var active = "{{ !empty($active) && $active == 'true' ? 'true' : '' }}";
    var date = "{{ !empty($date) && $date == 'true' ? 'true' : '' }}";
    var daterange = "{{ !empty($daterange) && $daterange == 'true' ? 'true' : '' }}";
    var file = "{{ !empty($file) && $file == 'true' ? 'true' : '' }}";
    var status = "{{ !empty($status) && $status == 'true' ? 'true' : '' }}";
    var sort = "{{ !empty($sort) && $sort > 0 ? $sort : '1, desc' }}";
    window.tableBodyColumns = [
        @yield('table-body')
    ];
</script>

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