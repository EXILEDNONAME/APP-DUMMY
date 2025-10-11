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

<script>
    
</script>

<script>
    $(`<div id="tooltip_activities" class="kt-tooltip"> {{ __('default.label.activities') }} </div>`).appendTo('body');
    $(`<div id="tooltip_back" class="kt-tooltip"> {{ __('default.label.back') }} </div>`).appendTo('body');
    $(`<div id="tooltip_batch_action" class="kt-tooltip"> {{ __('default.label.batch_action') }} </div>`).appendTo('body');
    $(`<div id="tooltip_create" class="kt-tooltip"> {{ __('default.label.create') }} </div>`).appendTo('body');
    $(`<div id="tooltip_delete" class="kt-tooltip"> {{ __('default.label.delete.delete') }} </div>`).appendTo('body');
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