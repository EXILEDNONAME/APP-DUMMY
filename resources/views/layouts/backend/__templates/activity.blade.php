@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.activities') }} </h3>
                <div class="kt-menu">
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost table_reload" data-kt-tooltip="#tooltip_reload" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-arrows-circle"></i></button>
                    <button id="toggle_filters" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_filter" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-setting-4"></i></button>
                    <div class="inline-flex" data-kt-dropdown="true" data-kt-dropdown-trigger="hover" data-kt-dropdown-placement="bottom-end">
                        <div class="kt-menu" data-kt-menu="true">
                            <div class="kt-menu-item" data-kt-menu-item-placement="bottom-end" data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="hover">
                                <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_export" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-exit-down"></i></button>
                                <div class="kt-menu-dropdown kt-menu-default" data-kt-menu-dismiss="true">
                                    <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_copy" data-kt-tooltip-placement="top-end"><a id="export_copy" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-copy"></i></span><span class="kt-menu-title"> {{ __('default.label.export.copy') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_csv" data-kt-tooltip-placement="top-end"><a id="export_csv" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-notepad"></i></span><span class="kt-menu-title"> {{ __('default.label.export.csv') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_excel" data-kt-tooltip-placement="top-end"><a id="export_excel" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-tablet-text-up"></i></span><span class="kt-menu-title"> {{ __('default.label.export.excel') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_pdf" data-kt-tooltip-placement="top-end"><a id="export_pdf" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-document"></i></span><span class="kt-menu-title"> {{ __('default.label.export.pdf') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_print" data-kt-tooltip-placement="top-end"><a id="export_print" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-printer"></i></span><span class="kt-menu-title"> {{ __('default.label.export.print') }} </span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ $url }}"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_back" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-black-right-line"></i></button></a>
                </div>
            </div>

            <div id="filters" class="hidden">
                <div class="grid gap-2 p-5">
                    <label class="kt-input">
                        <i class="ki-filled ki-magnifier"></i>
                        <input id="table_search" class="filter_form" placeholder="{{ __('default.label.search') }}" type="text" />
                    </label>

                    <select class="kt-select filter_form filter_status">
                        <option value=""> - {{ __('default.select.status') }} - </option>
                        <option value="created"> {{ __('default.label.created') }} </option>
                        <option value="deleted"> {{ __('default.label.deleted') }} </option>
                        <option value="updated"> {{ __('default.label.updated') }} </option>
                    </select>

                    <button class="kt-menu-toggle kt-btn kt-btn-primary kt-btn-sm table_reset_filter"> {{ __('default.label.reset') }} </button>


                </div>
            </div>
            <div class="kt-card-content">
                <div class="kt-scrollable-x-hover" style="padding-bottom: 1px;">

                    <table id="exilednoname_table" class="kt-table" width="100%">
                        <thead>
                            <tr>
                                <th style="display: none"> {{ __('default.label.created_at') }} </th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label kt-card-title text-sm"> No. </span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.status') }} </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.subject') }} </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.causer') }} </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.date') }} </span><span class="kt-table-col-sort"></span></span></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="kt-card-footer flex flex-col md:flex-row justify-center md:justify-between gap-5 text-secondary-foreground text-sm font-medium">
                <div class="flex items-center gap-2 order-2 md:order-1">
                    <label for="perpage" class="text-sm"> {{ __('default.label.show') }} </label>
                    <select id="perpage" class="kt-select w-16 border rounded px-2 py-1">
                        <option value="25" selected> 25 </option>
                        <option value="100"> 100 </option>
                        <option value="250"> 250 </option>
                        <option value="500"> 500 </option>
                    </select>
                    <span class="text-sm"> {{ __('default.label.entries') }} </span>
                </div>
                <div class="flex items-center gap-2 order-1 md:order-2">
                    <div id="kt-pagination" class="kt-datatable-pagination" data-kt-datatable-pagination="true"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/exilednoname-dt-plugins.js"></script>
<script>
    $(document).ready(function () {
        let defaultSort = sort.split(',').map((item, index) => { return index === 0 ? parseInt(item.trim()) : item.trim(); });
        let table = $('#exilednoname_table').DataTable({
            dom: 'tb', info: false, lengthChange: false, pageLength: 25, serverSide: true, searchDelay: 2000,
            "pagingType": "simple_numbers",
            "initComplete": function (settings, json) {
                $('#exilednoname_table_info').appendTo('#kt-pagination');
                $('.dt-paging').appendTo('#kt-pagination');
                $('#dt-length-0').appendTo('#ex_table_length');
                $('#exilednoname_table_filter').appendTo('#ex_table_filter');
            },
            ajax: {
                url: this_url,
                data: function (ex) {
                    ex.date = $('.table_filter_date').val();
                    ex.deleted_at = $('.table_filter_deleted_at').val();
                    if (daterange) {
                        const range = $('#dateRange').val();
                        if (range.includes(' to ')) { ex.date_start = range.split(' to ')[0]; ex.date_end = range.split(' to ')[1]; }
                        else { ex.date_start = range; ex.date_end = range; }
                    }
                    ex.filter_status = $('.filter_status').val();
                }
            },
            language: {
                loadingRecords: "",
                emptyTable: `<div class="flex flex-col items-center justify-center text-gray-500"><span class="block text-center"> ${translations.default.label.no_data_available} ... </span></div>`,
                zeroRecords: `<div class="flex flex-col items-center justify-center text-gray-500"><span class="block text-center"> ${translations.default.label.no_data_matching} ... </span></div>`,
            },
            drawCallback: function () { renderPaginationWindow(this.api(), document.getElementById("kt-pagination"), 1); },
            columns: [
                { data: 'created_at', name: 'created_at', visible: false },
                {
                    data: null, name: 'autonumber', orderable: false, searchable: false, 'className': 'text-center', 'width': '1',
                    render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }
                },
                {
                    data: 'description', name: 'description', orderable: true, 'className': 'align-middle', 'width': '1',
                    render: function (data, type, row) {
                        if (data == 'created') return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-success"> ${translations.default.label.created} </span>`;
                        if (data == 'updated') return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-warning"> ${translations.default.label.updated} </span>`;
                        if (data == 'deleted') return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-destructive"> ${translations.default.label.deleted} </span>`;
                        if (data == 'restored') return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-info"> ${translations.default.label.restore} </span>`;
                    }
                },
                {
                    data: 'subjects', name: 'subjects', orderable: true, 'className': 'text-nowrap',
                    render: function (data, type, row) { if (data == null) { return '<center> - </center>' } else { return data; } }
                },
                {
                    data: 'causer_id', name: 'causer_id', orderable: true, 'className': 'text-nowrap',
                    render: function (data, type, row) { if (data == null) { return '<center> - </center>' } else { return data; } }
                },
                { data: 'updated_at', 'className': 'text-nowrap' },
            ],
            buttons: [
                {
                    extend: 'print', title: '', exportOptions: {
                        columns: "thead th:not(.no-export)", orthogonal: "Export",
                        format: { body: function (data, row, column, node) { return safeStrip(data, node); } }
                    }
                },
                {
                    extend: 'copyHtml5', title: '', autoClose: true, exportOptions: {
                        columns: "thead th:not(.no-export)", orthogonal: "Export",
                        format: { body: function (data, row, column, node) { return safeStrip(data, node); } }
                    }
                },
                {
                    extend: 'csvHtml5', title: '', exportOptions: {
                        columns: "thead th:not(.no-export)", orthogonal: "Export",
                        format: { body: function (data, row, column, node) { return safeStrip(data, node); } }
                    }
                },
                {
                    extend: 'excelHtml5', title: '', exportOptions: {
                        columns: "thead th:not(.no-export)", orthogonal: "Export",
                        format: { body: function (data, row, column, node) { return safeStrip(data, node); } }
                    }
                },
                {
                    extend: 'pdfHtml5', title: '', exportOptions: {
                        columns: "thead th:not(.no-export)", orthogonal: "Export",
                        format: { body: function (data, row, column, node) { return safeStrip(data, node); } }
                    }
                },
            ],
            rowId: 'Collocation',
            select: {
                style: 'multi',
                selector: 'td:first-child .checkable',
            },
            order: [5, 'desc']
        });

        $('#export_print').on('click', function (e) { e.preventDefault(); table.button(0).trigger(); });
        $('#export_copy').on('click', function (e) { e.preventDefault(); table.button(1).trigger(); });
        $('#export_csv').on('click', function (e) { e.preventDefault(); table.button(2).trigger(); });
        $('#export_excel').on('click', function (e) { e.preventDefault(); table.button(3).trigger(); });
        $('#export_pdf').on('click', function (e) { e.preventDefault(); table.button(4).trigger(); });
    });
</script>
@endpush