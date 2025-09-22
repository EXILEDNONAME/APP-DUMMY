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
    ajax: {
        url: this_url,
    },
    "lengthMenu": [[25, 100, 250, 500, -1], [25, 100, 250, 500, "All"]],
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
            data: 'autonumber', orderable: false, searchable: false, 'className': 'align-middle text-center', 'width': '1',
            render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }
        },
        { data: 'date', orderable: false, 'className': 'align-middle text-nowrap', 'width': '1' },
        { data: 'name', orderable: false, 'className': 'align-middle text-nowrap' },
        { data: 'download', orderable: false, 'width': '1' },
    ],
    order: [
        [1, 'desc']
    ]
});

$('#export_print').on('click', function (e) { e.preventDefault(); table.button(0).trigger(); });
$('#export_copy').on('click', function (e) { e.preventDefault(); table.button(1).trigger(); });
$('#export_excel').on('click', function (e) { e.preventDefault(); table.button(2).trigger(); });
$('#export_pdf').on('click', function (e) { e.preventDefault(); table.button(3).trigger(); });

$("#table_refresh").on("click", function () {
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

$("#create-backup").on("click", function () {
    Swal.fire({ text: translations.default.notification.confirm.create_backup + "?", icon: "warning", showCancelButton: true, confirmButtonText: translations.default.label.yes, cancelButtonText: translations.default.label.no, reverseButtons: false }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: "get", url: this_url + "/create-backup", processing: true, serverSide: true,
                success: function (data) {
                    KTApp.block('#exilednoname_body', {
                        overlayColor: '#000000',
                        state: 'info',
                        message: translations.default.label.processing + ' ...'
                    });
                    setTimeout(function () {
                        KTApp.unblock('#exilednoname_body');
                        toastr.success(translations.default.notification.success.create_backup);
                        $('#exilednoname_table').DataTable().ajax.reload();
                    }, 500);
                },
                error: function (data) {
                    toastr.error(translations.default.notification.error.error);
                }
            });
        }
    });
});

$("#table-reset").on("click", function () {
    Swal.fire({ text: translations.default.notification.confirm.reset_backup + "?", icon: "warning", showCancelButton: true, confirmButtonText: translations.default.label.yes, cancelButtonText: translations.default.label.no, reverseButtons: false }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: "get", url: this_url + "/reset", processing: true, serverSide: true,
                success: function (data) {
                    KTApp.block('#exilednoname_body', {
                        overlayColor: '#000000',
                        state: 'info',
                        message: translations.default.label.processing + ' ...'
                    });
                    setTimeout(function () {
                        KTApp.unblock('#exilednoname_body');
                        toastr.success(translations.default.notification.success.reset_backup);
                        $('#exilednoname_table').DataTable().ajax.reload();
                    }, 500);
                },
                error: function (data) {
                    toastr.error(translations.default.notification.error.error);
                }
            });
        }
    });
});
