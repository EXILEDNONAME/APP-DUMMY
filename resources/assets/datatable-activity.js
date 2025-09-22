$(document).ready(function () {
    KTApp.block('#exilednoname_body', { overlayColor: '#000000', state: 'primary', message: translations.default.label.please_wait + " ..." });
    setTimeout(function () { KTApp.unblock('#exilednoname_body'); }, 500);
});
var card = new KTCard('exilednoname_card');

var table = $('#exilednoname_table').DataTable({
    "initComplete": function (settings, json) {
        $('#exilednoname_table_info').appendTo('#ex_table_info');
        $('#exilednoname_table_paginate').appendTo('#ex_table_paginate');
        $('#exilednoname_table_length').appendTo('#ex_table_length');
        $('#exilednoname_table_filter').appendTo('#ex_table_filter');
    },

    "pagingType": "simple_numbers",
    serverSide: true,
    searching: true,
    rowId: 'Collocation',
    select: {
        style: 'multi',
        selector: 'td:first-child .checkable',
    },
    ajax: { url: this_url, },
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    buttons: [
        { extend: 'print', title: '', exportOptions: { columns: "thead th:not(.no-export)", orthogonal: "Export" }, },
        { extend: 'copyHtml5', title: '', autoClose: 'true', exportOptions: { columns: "thead th:not(.no-export)", orthogonal: "Export" }, },
        { extend: 'excelHtml5', title: '', exportOptions: { columns: "thead th:not(.no-export)", orthogonal: "Export" }, },
        { extend: 'pdfHtml5', title: '', exportOptions: { columns: "thead th:not(.no-export)", orthogonal: "Export" }, },
        { extend: 'print', title: '', exportOptions: { columns: "thead th:not(.no-export)", orthogonal: "Export", rows: { selected: true } }, },
        { extend: 'copyHtml5', title: '', autoClose: 'true', exportOptions: { columns: "thead th:not(.no-export)", orthogonal: "Export", rows: { selected: true } }, },
        { extend: 'excelHtml5', title: '', exportOptions: { columns: "thead th:not(.no-export)", orthogonal: "Export", rows: { selected: true } }, },
        { extend: 'pdfHtml5', title: '', exportOptions: { columns: "thead th:not(.no-export)", orthogonal: "Export", rows: { selected: true } }, },
    ],
    columns: [
        {
            data: 'autonumber', orderable: false, orderable: false, searchable: false, 'className': 'align-middle text-center', 'width': '1',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'description', orderable: false, 'className': 'align-middle', 'width': '1',
            render: function (data, type, row) {
                if (data == 'created') { return '<span class="label label-dot label-success"></span>'; }
                else if (data == 'updated') { return '<span class="label label-dot label-warning"></span>'; }
                else if (data == 'deleted') { return '<span class="label label-dot label-danger"></span>'; }
                else if (data == 'restored') { return '<span class="label label-dot label-info"></span>'; }
                else { return ''; }
            }
        },
        {
            data: 'description', orderable: true, 'className': 'align-middle',
            render: function (data, type, row) {
                if (data == 'created') { return 'Created'; }
                else if (data == 'updated') { return 'Updated'; }
                else if (data == 'deleted') { return 'Deleted'; }
                else if (data == 'restored') { return 'Restored'; }
                else { return ''; }
            }
        },
        { data: 'subjects' },
        { data: 'causer_id', 'className': 'align-middle text-nowrap', 'width': '1' },
        { data: 'updated_at', 'className': 'align-middle text-nowrap', 'width': '1' },
    ],
    order: [[5, 'desc']]
});

$('#export_print').on('click', function (e) { e.preventDefault(); table.button(0).trigger(); });
$('#export_copy').on('click', function (e) { e.preventDefault(); table.button(1).trigger(); });
$('#export_excel').on('click', function (e) { e.preventDefault(); table.button(2).trigger(); });
$('#export_pdf').on('click', function (e) { e.preventDefault(); table.button(3).trigger(); });

// REFRESH TABLE
$(".table_refresh").on("click", function () {
    KTApp.block('#exilednoname_body', {
        overlayColor: '#000000',
        state: 'primary',
        message: translations.default.label.please_wait + " ..."
    });
    setTimeout(function () {
        KTApp.unblock('#exilednoname_body');
        $('#collapse_bulk').collapse('hide');
        $('.filter-form').val('');
        $('#exilednoname_table').DataTable().search('').columns().search('').draw();
        $('#exilednoname_table').DataTable().ajax.reload();
    }, 500);
});