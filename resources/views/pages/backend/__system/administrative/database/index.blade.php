@extends('layouts.backend.default', ['administrative' => 'true'])
@section('title', 'Administrative Databases')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.databases') }} </h3>
                <div class="kt-menu">
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-modal-toggle="#modalBackupDatabase" data-kt-tooltip="#tooltip_backup_database" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-to-right"></i></button>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost table_reload" data-kt-tooltip="#tooltip_reload" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-arrows-circle"></i></button>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-modal-toggle="#modalDeleteDatabase" data-kt-tooltip="#tooltip_delete_database" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-trash"></i></button>
                </div>
            </div>

            <div class="kt-card-content">
                <div class="kt-scrollable-x-hover" style="padding-bottom: 1px;">

                    <table id="exilednoname_table" class="kt-table" width="100%">
                        <thead>
                            <tr>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label kt-card-title text-sm"> No. </span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> Date </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-full"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> Name </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-px whitespace-nowrap no-export"></th>
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

<div class="kt-modal" data-kt-modal="true" id="modalBackupDatabase">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.notification.confirm.backup_database') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-backup-database"> {{ __('default.label.yes') }} </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.cancel') }} </button>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalDeleteDatabase">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.notification.confirm.delete_database') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-delete-database"> {{ __('default.label.yes') }} </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.cancel') }} </button>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/exilednoname-dt-plugins.js"></script>
<script>
    $(document).ready(function () {
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
            }
        },
        language: {
            loadingRecords: "",
            emptyTable: `<div class="flex flex-col items-center justify-center text-gray-500"><span class="block text-center"> ${translations.default.label.no_data_available} ... </span></div>`,
            zeroRecords: `<div class="flex flex-col items-center justify-center text-gray-500"><span class="block text-center"> ${translations.default.label.no_data_matching} ... </span></div>`,
        },
        drawCallback: function () { renderPaginationWindow(this.api(), document.getElementById("kt-pagination"), 1); },
        columns: [
            {
                data: null, name: 'autonumber', orderable: false, searchable: false, 'className': 'text-center', 'width': '1',
                render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }
            },
            { data: 'date', name: 'date', 'className': 'text-nowrap' },
            { data: 'name', name: 'name', 'className': 'text-nowrap' },
            { data: 'download', orderable: false, 'width': '1' },
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
        order: [2, 'desc']
    });

    // TABLE BACKUP DATABASES
    $('body').on('click', '[data-kt-modal-toggle="#modalBackupDatabase"]', function () {
        $('#modalBackupDatabase').attr('data-id', $(this).data('id'));
    });

    $('body').on('click', '.btn-confirm-backup-database', function () {
        let id = $('#modalBackupDatabase').attr('data-id');
        let modal = KTModal.getInstance(document.querySelector('#modalBackupDatabase'));
        $.ajax({
            type: 'get', url: `${this_url}/create-backup`,
            success: function (data) {
                if (data.status && data.status === 'error') { toast_notification(data.message); modal.hide(); $('#exilednoname_table').DataTable().draw(false); return; }
                toast_notification(translations.default.notification.success.backup_database);
                modal.hide();
                $('#exilednoname_table').DataTable().draw(false);
            },
            error: function () {
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

    // TABLE DELETE BACKED UP DATABASE
    $('body').on('click', '[data-kt-modal-toggle="#modalDeleteDatabase"]', function () {
        $('#modalDeleteDatabase').attr('data-id', $(this).data('id'));
    });

    $('body').on('click', '.btn-confirm-delete-database', function () {
        let id = $('#modalDeleteDatabase').attr('data-id');
        let modal = KTModal.getInstance(document.querySelector('#modalDeleteDatabase'));
        $.ajax({
            type: 'get', url: `${this_url}/reset`,
            success: function (data) {
                if (data.status && data.status === 'error') { toast_notification(data.message); modal.hide(); $('#exilednoname_table').DataTable().draw(false); return; }
                toast_notification(translations.default.notification.success.delete_database);
                modal.hide();
                $('#exilednoname_table').DataTable().draw(false);
            },
            error: function () {
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

});
</script>
@endpush