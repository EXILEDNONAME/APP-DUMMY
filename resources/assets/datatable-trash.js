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
    headerCallback: function (thead, data, start, end, display) {
        thead.getElementsByTagName('th')[0].innerHTML = `
    <label class="checkbox checkbox-single checkbox-solid checkbox-primary mb-0">
      <input type="checkbox" value="" class="group-checkable"/>
      <span></span>
    </label>`;
    },
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
            data: 'checkbox', orderable: false, orderable: false, searchable: false, 'width': '1',
            render: function (data, type, row, meta) { return '<label class="checkbox checkbox-single checkbox-primary mb-0"><input type="checkbox" data-id="' + row.id + '" class="checkable"><span></span></label>'; },
        },
        {
            data: 'autonumber', orderable: false, searchable: false, 'className': 'align-middle text-center', 'width': '1',
            render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }
        },
        { data: 'deleted_at', 'className': 'align-middle text-nowrap', 'width': '1', },

        ...window.tableBodyColumns,

        {
            data: 'action', orderable: false, orderable: false, searchable: false, 'width': '1',
            render: function (data, type, row) {
                return '' +
                    '<div class="dropdown dropdown-inline">' +
                    '<button type="button" class="btn btn-hover-light-dark btn-icon btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ki ki-bold-more-ver"></i></button>' +
                    '<div class="dropdown-menu dropdown-menu-xs" style=""><ul class="navi navi-hover py-5">' +
                    '<li class="navi-item"><a id="restore" href="javascript:void(0);" class="navi-link" data-id="' + row.id + '"><span class="navi-icon"><i class="fas fa-undo"></i></span><span class="navi-text">' + translations.default.label.restore + '</span></a></li>' +
                    '<li class="navi-item"><a id="delete-permanent" href="javascript:void(0);" class="navi-link" data-id="' + row.id + '"><span class="navi-icon"><i class="flaticon2-trash"></i></span><span class="navi-text text-nowrap">' + translations.default.label.delete.permanent + '</span></a></li>';
            },
        },
    ]
});

$('#export_print').on('click', function (e) { e.preventDefault(); table.button(0).trigger(); });
$('#export_copy').on('click', function (e) { e.preventDefault(); table.button(1).trigger(); });
$('#export_excel').on('click', function (e) { e.preventDefault(); table.button(2).trigger(); });
$('#export_csv').on('click', function (e) { e.preventDefault(); table.button(3).trigger(); });
$('#export_pdf').on('click', function (e) { e.preventDefault(); table.button(4).trigger(); });

// GROUP CHECKABLE
$('#exilednoname_table').on('change', '.group-checkable', function () {
    var set = $(this).closest('table').find('td:first-child .checkable');
    var checked = $(this).is(':checked');
    $(set).each(function () {
        if (checked) {
            $(this).prop('checked', true);
            $('#exilednoname_table').DataTable().rows($(this).closest('tr')).select();
            var checkedNodes = $('#exilednoname_table').DataTable().rows('.selected').nodes();
            var count = checkedNodes.length;
            $('#exilednoname_selected').html(count);
            if (count > 0) {
                $('#toolbar_delete').collapse('show');
                $('#collapse_bulk').collapse('show');
            }
        } else {
            $(this).prop('checked', false);
            $('#exilednoname_table').DataTable().rows($(this).closest('tr')).deselect();
            $('#toolbar_delete').collapse('hide');
            $('#collapse_bulk').collapse('hide');
        }
    });
});

// CHECKABLE
$('#exilednoname_table').on('change', '.checkable', function () {
    var checkedNodes = $('#exilednoname_table').DataTable().rows('.selected').nodes();
    var count = checkedNodes.length;
    $('#exilednoname_selected').html(count);
    if (count > 0) {
        $('#toolbar_delete').collapse('show');
        $('#collapse_bulk').collapse('show');
    } else {
        $('#toolbar_delete').collapse('hide');
        $('#collapse_bulk').collapse('hide');
    }
});

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

$('body').on('click', '#delete-permanent', function () {
    var id = $(this).data("id");
    Swal.fire({ text: translations.default.notification.confirm.delete_permanent + "?", icon: "warning", showCancelButton: true, confirmButtonText: translations.default.label.yes, cancelButtonText: translations.default.label.no, reverseButtons: false }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: "get", url: this_url + "/../delete-permanent/" + id,
                success: function (data) {
                    KTApp.block('#exilednoname_body', {
                        overlayColor: '#000000',
                        state: 'info',
                        message: translations.default.label.processing + ' ...'
                    });
                    setTimeout(function () {
                        KTApp.unblock('#exilednoname_body');
                        var oTable = $('#exilednoname_table').dataTable();
                        oTable.fnDraw(false);
                        toastr.success(translations.default.notification.success.item_delete_permanently);
                    }, 500);
                },
                error: function (data) {
                    toastr.error(translations.default.notification.error.error);
                }
            });
        }
    });
});

$('body').on('click', '#restore', function () {
    var id = $(this).data("id");
    Swal.fire({ text: translations.default.notification.confirm.restore + "?", icon: "warning", showCancelButton: true, confirmButtonText: translations.default.label.yes, cancelButtonText: translations.default.label.no, reverseButtons: false }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: "get", url: this_url + "/../restore/" + id,
                success: function (data) {
                    KTApp.block('#exilednoname_body', {
                        overlayColor: '#000000',
                        state: 'info',
                        message: translations.default.label.processing + ' ...'
                    });
                    setTimeout(function () {
                        KTApp.unblock('#exilednoname_body');
                        var oTable = $('#exilednoname_table').dataTable();
                        oTable.fnDraw(false);
                        toastr.success(translations.default.notification.success.item_restored);
                    }, 500);
                },
                error: function (data) {
                    toastr.error(translations.default.notification.error.error);
                }
            });
        }
    });
});

$('#selected-delete-permanent').on('click', function (e) {
    var exilednonameArr = [];
    $(".checkable:checked").each(function () { exilednonameArr.push($(this).attr('data-id')); });
    var strEXILEDNONAME = exilednonameArr.join(",");
    Swal.fire({ text: translations.default.notification.confirm.selected_delete_permanent + "?", icon: "warning", showCancelButton: true, confirmButtonText: translations.default.label.yes, cancelButtonText: translations.default.label.no, reverseButtons: false }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: 'get', url: this_url + "/../selected-delete-permanent",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: 'EXILEDNONAME=' + strEXILEDNONAME,
                success: function (data) {
                    KTApp.block('#exilednoname_body', {
                        overlayColor: '#000000',
                        state: 'info',
                        message: translations.default.label.processing + ' ...'
                    });
                    setTimeout(function () {
                        KTApp.unblock('#exilednoname_body');
                        $('#collapse_bulk').collapse('hide');
                        var oTable = $('#exilednoname_table').dataTable();
                        oTable.fnDraw(false);
                        toastr.success(translations.default.notification.success.selected_delete_permanent);
                    }, 1000);
                },
                error: function (data) {
                    toastr.error(translations.default.notification.error.error);
                }
            });
        }
    });
});

$('#selected-restore').on('click', function (e) {
    var exilednonameArr = [];
    $(".checkable:checked").each(function () { exilednonameArr.push($(this).attr('data-id')); });
    var strEXILEDNONAME = exilednonameArr.join(",");
    Swal.fire({ text: translations.default.notification.confirm.selected_restore + "?", icon: "warning", showCancelButton: true, confirmButtonText: translations.default.label.yes, cancelButtonText: translations.default.label.no, reverseButtons: false }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: 'get', url: this_url + "/../selected-restore",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: 'EXILEDNONAME=' + strEXILEDNONAME,
                success: function (data) {
                    KTApp.block('#exilednoname_body', {
                        overlayColor: '#000000',
                        state: 'info',
                        message: translations.default.label.processing + ' ...'
                    });
                    setTimeout(function () {
                        KTApp.unblock('#exilednoname_body');
                        $('#collapse_bulk').collapse('hide');
                        var oTable = $('#exilednoname_table').dataTable();
                        oTable.fnDraw(false);
                        toastr.success(translations.default.notification.success.selected_restore);
                    }, 500);
                },
                error: function (data) {
                    toastr.error(translations.default.notification.error.error);
                }
            });
        }
    });
});
