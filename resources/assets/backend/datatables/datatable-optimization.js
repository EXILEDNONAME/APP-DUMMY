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
        columns: [
            {
                data: null, name: 'autonumber', orderable: false, searchable: false, 'className': 'text-center', 'width': '1',
                render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }
            },
            { data: 'name', 'className': 'text-nowrap' },
            { data: 'description' },
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `<button data-id="${row.id}" class="kt-btn kt-btn-sm kt-btn-outline rounded-full start_optimizing"> Start </button`;
                }
            },
        ],

        rowId: 'Collocation',
        select: {
            style: 'multi',
            selector: 'td:first-child .checkable',
        },
        order: [1, 'asc']
    });
});