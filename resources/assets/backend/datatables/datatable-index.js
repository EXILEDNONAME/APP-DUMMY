// TABLE INDEX
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
            { data: 'created_at', name: 'created_at', visible: false },
            {
                data: null, name: 'autonumber', orderable: false, searchable: false, 'className': 'text-center', 'width': '1',
                render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }
            },

            ...(status ? [{
                data: 'status', name: 'status', orderable: true, className: 'text-center text-nowrap', width: '1',
                render: function (data) {
                    if (data == 1) return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-mono"> ${translations.default.label.default} </span>`;
                    if (data == 2) return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-warning"> ${translations.default.label.pending} </span>`;
                    if (data == 3) return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-info"> ${translations.default.label.progress} </span>`;
                    if (data == 4) return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-success"> ${translations.default.label.success} </span>`;
                    if (data == 5) return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-destructive"> ${translations.default.label.failed} </span>`;
                }
            },] : []),

            ...(file ? [{ data: 'file', name: 'file', orderable: false, 'className': 'text-center text-nowrap ', 'width': '1' },] : []),

            ...(date ? [{
                data: 'date', name: 'date', orderable: true, 'className': 'text-nowrap', 'width': '1',
                render: function (data, type, row) { if (data == null) { return '<center> - </center>' } else { return data; } }
            },] : []),

            ...(daterange ? [{
                data: 'date_start', orderable: true, 'className': 'align-middle text-nowrap', 'width': '1',
                render: function (data, type, row) {
                    if (data == null) { return '<center> - </center>' }
                    else { return data; }
                }
            },
            {
                data: 'date_end', orderable: true, 'className': 'align-middle text-nowrap', 'width': '1',
                render: function (data, type, row) {
                    if (data == null) { return '<center> - </center>' }
                    else { return data; }
                }
            },] : []),

            ...window.tableBodyColumns,

            ...(active ? [{
                data: 'active', name: 'active', orderable: true, 'className': 'align-middle text-center', 'width': '1',
                render: function (data, type, row) {
                    if (data == 0) { return `<a class="flex justify-center table_active" data-id="${row.id}"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" /></a>`; }
                    if (data == 1) { return `<a class="flex justify-center table_inactive" data-id="${row.id}"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" checked="" /></a>`; }
                    if (data == 2) { return `<a class="flex justify-center" id="table_active" data-id="${row.id}"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" /></a>`; }
                }
            },] : []),

            {
                data: null, name: 'action', orderable: false, searchable: false,
                render: function (data, type, row) {
                    return `
                    <td>
                        <div class="kt-menu" data-kt-menu="true">
                            <div class="kt-menu-item" data-kt-menu-item-placement="bottom-end" data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="hover">
                                <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-dots-vertical text-lg"></i></button>
                                <div class="kt-menu-dropdown kt-menu-default" data-kt-menu-dismiss="true">
                                    <div class="kt-menu-item"><a class="kt-menu-link" href="${this_url}/${row.id}"><span class="kt-menu-icon"><i class="ki-filled ki-search-list"></i></span><span class="kt-menu-title"> ${translations.default.label.view} </span></a></div>
                                    <div class="kt-menu-item"><a class="kt-menu-link" href="${this_url}/${row.id}/edit"><span class="kt-menu-icon"><i class="ki-filled ki-message-edit"></i></span><span class="kt-menu-title"> ${translations.default.label.edit} </span></a></div>
                                    <div class="kt-menu-item"><a class="kt-menu-link" data-id="${row.id}" data-kt-modal-toggle="#modalDelete"><span class="kt-menu-icon"><i class="ki-filled ki-trash-square"></i></span><span class="kt-menu-title"> ${translations.default.label.delete.delete} </span></a></div>
                                    ${extension === 'management-users' ? `<div class="kt-menu-item"><a class="kt-menu-link" data-id="${row.id}" data-kt-modal-toggle="#modalResetPassword"><span class="kt-menu-icon"><i class="ki-filled ki-key-square"></i></span><span class="kt-menu-title"> ${translations.default.label.reset_password} </span></a></div>` : ''}
                                </div>
                            </div>
                        </div>
                    </td>`;
                }
            }
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
        order: [defaultSort]
    });

    $('#export_print').on('click', function (e) { e.preventDefault(); table.button(0).trigger(); });
    $('#export_copy').on('click', function (e) { e.preventDefault(); table.button(1).trigger(); });
    $('#export_csv').on('click', function (e) { e.preventDefault(); table.button(2).trigger(); });
    $('#export_excel').on('click', function (e) { e.preventDefault(); table.button(3).trigger(); });
    $('#export_pdf').on('click', function (e) { e.preventDefault(); table.button(4).trigger(); });
});