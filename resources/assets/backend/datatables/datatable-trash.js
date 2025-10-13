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
            { data: 'created_at', name: 'created_at', visible: false },
            {
                data: null, name: 'autonumber', orderable: false, searchable: false, 'className': 'text-center', 'width': '1',
                render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }
            },
            {
                data: 'deleted_at', name: 'deleted_at', orderable: true, 'className': 'text-nowrap', 'width': '1',
                render: function (data, type, row) { if (data == null) { return '<center> - </center>' } else { return data; } }
            },

            ...window.tableBodyColumns,

            {
                data: null, name: 'action', orderable: false, searchable: false,
                render: function (data, type, row) {
                    return `
                        <td>
                            <div class="kt-menu" data-kt-menu="true">
                                <div class="kt-menu-item" data-kt-menu-item-placement="bottom-end" data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="hover">
                                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-dots-vertical text-lg"></i></button>
                                    <div class="kt-menu-dropdown kt-menu-default" data-kt-menu-dismiss="true">
                                        <div class="kt-menu-item"><a class="kt-menu-link" data-id="${row.id}" data-kt-modal-toggle="#modalRestore"><span class="kt-menu-icon"><i class="ki-filled ki-arrows-loop"></i></span><span class="kt-menu-title"> ${translations.default.label.restore} </span></a></div>
                                        <div class="kt-menu-item"><a class="kt-menu-link" data-id="${row.id}" data-kt-modal-toggle="#modalDeletePermanent"><span class="kt-menu-icon"><i class="ki-filled ki-trash"></i></span><span class="kt-menu-title"> ${translations.default.label.delete.permanent} </span></a></div>
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
        order: [3, 'desc']
    });

    $('#export_print').on('click', function (e) { e.preventDefault(); table.button(0).trigger(); });
    $('#export_copy').on('click', function (e) { e.preventDefault(); table.button(1).trigger(); });
    $('#export_csv').on('click', function (e) { e.preventDefault(); table.button(2).trigger(); });
    $('#export_excel').on('click', function (e) { e.preventDefault(); table.button(3).trigger(); });
    $('#export_pdf').on('click', function (e) { e.preventDefault(); table.button(4).trigger(); });
});