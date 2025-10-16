@extends('layouts.backend.default', ['administrative' => 'true'])
@section('title', 'Administrative Sessions')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.databases') }} </h3>
                <div class="kt-menu">
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost table_reload" data-kt-tooltip="#tooltip_reload" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-arrows-circle"></i></button>
                    <div class="inline-flex" data-kt-dropdown="true" data-kt-dropdown-trigger="hover" data-kt-dropdown-placement="bottom-end">
                        <div class="kt-menu" data-kt-menu="true">
                            <div class="kt-menu-item" data-kt-menu-item-placement="bottom-end" data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="hover">
                                <button id="checkbox_batch" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost hidden" data-kt-tooltip="#tooltip_batch_action" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-dots-vertical"></i></button>
                                <div class="kt-menu-dropdown kt-menu-default" data-kt-menu-dismiss="true">
                                    <div class="kt-menu-item" data-kt-modal-toggle="#modalSelectedRestore"><a class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-arrows-loop"></i></span><span class="kt-menu-title"> {{ __('default.label.restore') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-modal-toggle="#modalSelectedDeletePermanent"><a class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-trash"></i></span><span class="kt-menu-title"> {{ __('default.label.delete.permanent') }} </span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-modal-toggle="#modalDeleteAllSession" data-kt-tooltip="#tooltip_delete_all_session" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-exit-right"></i></button>
                </div>
            </div>

            <div class="kt-card-content">
                <div class="kt-scrollable-x-hover" style="padding-bottom: 1px;">

                    <table id="exilednoname_table" class="kt-table" width="100%">
                        <thead>
                            <tr>
                                <th class="w-px whitespace-nowrap"></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label kt-card-title text-sm"> No. </span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> User </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> IP Address </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> Region </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> Client </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-full"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> Last Activity </span><span class="kt-table-col-sort"></span></span></th>
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

<div class="kt-modal" data-kt-modal="true" id="modalDeleteSession">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.notification.confirm.delete_session') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-delete-session"> {{ __('default.label.yes') }} </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.cancel') }} </button>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalDeleteAllSession">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.notification.confirm.delete_all_session') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-delete-all-session"> {{ __('default.label.yes') }} </button>
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
        headerCallback: function (thead, data, start, end, display) { thead.getElementsByTagName('th')[0].innerHTML = `<input id="check" type="checkbox" class="kt-checkbox group-checkable" data-kt-datatable-row-check="true" value="0" />`; },
        columns: [
            {
                data: null, name: 'checkbox', searchable: false, orderable: false,
                render: function (data, type, row, meta) { return `<input type="checkbox" class="kt-checkbox checkable" data-id="${row.id}">`; },
            },
            {
                data: null, name: 'autonumber', orderable: false, searchable: false, 'className': 'text-center', 'width': '1',
                render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }
            },
            { data: 'user_id', name: 'user_id', 'className': 'text-nowrap' },
            { data: 'ip_address', name: 'ip_address', 'className': 'text-nowrap' },
            { data: 'region', name: 'user_agent', 'className': 'text-nowrap text-center' },
            { data: 'user_agent', name: 'user_agent', 'className': 'text-nowrap' },
            { data: 'last_activity', name: 'last_activity', 'className': 'text-nowrap' },
            {
                data: null, name: 'action', orderable: false, searchable: false,
                render: function (data, type, row) {
                    return `
                        <td>
                            <div class="kt-menu" data-kt-menu="true">
                                <div class="kt-menu-item" data-kt-menu-item-placement="bottom-end" data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="hover">
                                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-dots-vertical text-lg"></i></button>
                                    <div class="kt-menu-dropdown kt-menu-default" data-kt-menu-dismiss="true">
                                        <div class="kt-menu-item"><a class="kt-menu-link" data-id="${row.user_id}" data-kt-modal-toggle="#modalDeleteSession"><span class="kt-menu-icon"><i class="ki-filled ki-trash"></i></span><span class="kt-menu-title"> ${translations.default.label.delete.session} </span></a></div>
                                    </div>
                                </div>
                            </div>
                        </td>`;
                }
            }
        ],
        rowId: 'Collocation',
        select: {
            style: 'multi',
            selector: 'td:first-child .checkable',
        },
        order: [6, 'desc']
    });

    // TABLE DELETE SESSION
    $('body').on('click', '[data-kt-modal-toggle="#modalDeleteSession"]', function () {
        $('#modalDeleteSession').attr('data-id', $(this).data('id'));
    });

    $('body').on('click', '.btn-confirm-delete-session', function () {
        let id = $('#modalDeleteSession').attr('data-id');
        let modal = KTModal.getInstance(document.querySelector('#modalDeleteSession'));
        $.ajax({
            type: 'get', url: `${this_url}/delete-session/${id}`,
            success: function (data) {
                if (data.status && data.status === 'error') { toast_notification(data.message); modal.hide(); $('#exilednoname_table').DataTable().draw(false); return; }
                toast_notification(translations.default.notification.success.delete_session);
                modal.hide();
                $('#exilednoname_table').DataTable().draw(false);
            },
            error: function () {
                modal.hide();
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

    // TABLE DELETE ALL SESSIONS
    $('body').on('click', '[data-kt-modal-toggle="#modalDeleteAllSession"]', function () {
        $('#modalDeleteAllSession').attr('data-id', $(this).data('id'));
    });

    $('body').on('click', '.btn-confirm-delete-all-session', function () {
        $.ajax({
            type: 'get', url: `${this_url}/delete-all-session`,
            success: function (data) {
                window.location.href = '/login';
            },
            error: function () {
                modal.hide();
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

});
</script>
@endpush