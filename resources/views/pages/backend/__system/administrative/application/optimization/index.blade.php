@extends('layouts.backend.default', ['administrative' => 'true'])
@section('title', 'Optimizations')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.optimizations') }} </h3>
                <div class="kt-menu">
                    <button id="table_reload" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_reload" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-arrows-circle"></i></button>
                </div>
            </div>
            <div class="kt-card-content">
                <div class="kt-scrollable-x-hover" style="padding-bottom: 1px;">
                    <table id="exilednoname_table" class="kt-table" width="100%">
                        <thead>
                            <tr>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label kt-card-title text-sm"> No. </span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Name </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-full"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Description </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-px whitespace-nowrap no-export"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/exilednoname-dt-plugins.js"></script>
<script>
    $(document).ready(function() {
        var url = "{{ URL::Current() }}";
        var table = $('#exilednoname_table').DataTable({
            processing: false,
            serverSide: true,
            "pagingType": "simple_numbers",
            pageLength: 25,
            lengthChange: false,
            info: false,
            dom: 't',
            responsive: true,
            language: {
                loadingRecords: "",
                emptyTable: `
                    <div class="flex flex-col items-center justify-center text-gray-500">
                        <span class="block text-center"> No data available in table </span>
                    </div>
                `
            },
            ajax: {
                url: "{{ URL::Current() }}",
            },
            columns: [{
                    data: 'autonumber',
                    orderable: false,
                    searchable: false,
                    'className': 'align-middle text-center',
                    'width': '1',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    'className': 'text-nowrap'
                },
                {
                    data: 'description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<button id="start-optimizing" data-id="${row.id}" class="kt-btn kt-btn-sm kt-btn-outline rounded-full"> Start </button`;
                    }
                },
            ],
        });

        // TABLE RELOAD
        $("#table_reload").on("click", function() {
            $('#checkbox_batch').addClass('hidden');
            $('.filter_form').val('');
            table.search('').columns().search('').draw();
            table.ajax.reload();
            toast_notification(translations.default.notification.table_reload)
        });

        // START OPTIMIZING
        $('body').on('click', '#start-optimizing', function() {
            var id = $(this).data("id");
            $.ajax({
                type: "get",
                url: this_url + "/start-optimizing/" + id,
                processing: true,
                serverSide: true,
                success: function(data) {
                    if (data.status && data.status === 'error') {
                        toast_notification(data.message);
                        table.ajax.reload();
                        return;
                    }
                    table.draw(false);
                    toast_notification(translations.default.notification.success.optimizing);

                },
                error: function(data) {
                    toast_notification(translations.default.notification.error.error);
                }
            });
        });

    });
</script>
@endpush