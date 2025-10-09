@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.main') }} </h3>
                <div class="kt-menu">
                    <button id="table_reload" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_reload" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-arrows-circle"></i></button>
                    <button id="toggle_filters" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_filter" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-setting-4"></i></button>
                    <div class="inline-flex" data-kt-dropdown="true" data-kt-dropdown-trigger="hover" data-kt-dropdown-placement="bottom-end">
                        <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-dropdown-toggle="true" data-kt-tooltip="#tooltip_export" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-exit-down"></i></button>
                        <div class="kt-dropdown text-sm" data-kt-dropdown-menu="true">
                            <div class="kt-card-body grid gap-3">
                                <div class="flex">
                                    <div class="kt-menu-default w-px whitespace-nowrap" data-kt-menu-dismiss="true">
                                        <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_copy" data-kt-tooltip-placement="top-end"><a id="export_copy" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-copy"></i></span><span class="kt-menu-title"> {{ __('default.label.export.copy') }} </span></a></div>
                                        <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_csv" data-kt-tooltip-placement="top-end"><a id="export_csv" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-notepad"></i></span><span class="kt-menu-title"> {{ __('default.label.export.csv') }} </span></a></div>
                                        <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_excel" data-kt-tooltip-placement="top-end"><a id="export_excel" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-tablet-text-up"></i></span><span class="kt-menu-title"> {{ __('default.label.export.excel') }} </span></a></div>
                                        <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_pdf" data-kt-tooltip-placement="top-end"><a id="export_pdf" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-document"></i></span><span class="kt-menu-title"> {{ __('default.label.export.pdf') }} </span></a></div>
                                        <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_print" data-kt-tooltip-placement="top-end"><a id="export_print" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-printer"></i></span><span class="kt-menu-title"> {{ __('default.label.export.print') }} </span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ $url }}"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_back" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-black-right-line"></i></button></a>
                    <div class="inline-flex" data-kt-dropdown="true" data-kt-dropdown-trigger="hover" data-kt-dropdown-placement="bottom-end">
                        <button id="checkbox_batch" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost hidden" data-kt-dropdown-toggle="true" data-kt-tooltip="#tooltip_export" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-dots-vertical"></i></button>
                        <div class="kt-dropdown text-sm" data-kt-dropdown-menu="true">
                            <div class="kt-card-body grid gap-3">
                                <div class="flex">
                                    <div class="kt-menu-default w-px whitespace-nowrap" data-kt-menu-dismiss="true">
                                        <div class="kt-menu-item" data-kt-tooltip="#tooltip_select_delete" data-kt-tooltip-placement="top-end"><a id="selected-delete" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-trash"></i></span><span class="kt-menu-title"> {{ __('default.selected.active') }} </span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-card-content">
                <div class="kt-scrollable-x-hover" style="padding-bottom: 1px;">

                    <table id="exilednoname_table" class="kt-table" width="100%">
                        <thead>
                            <tr>
                                <th class="w-px whitespace-nowrap no-export"></th>
                                <th style="display: none"> {{ __('default.label.created_at') }} </th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label kt-card-title text-sm"> No. </span></span></th>
                                @yield('table-header')
                                <th class="w-px whitespace-nowrap no-export"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="kt-card-footer flex flex-col md:flex-row justify-center md:justify-between gap-5 text-secondary-foreground text-sm font-medium">
                <div class="flex items-center gap-2 order-2 md:order-1">
                    <label for="perpage" class="text-sm"> Show </label>
                    <select id="perpage" class="kt-select w-16 border rounded px-2 py-1">
                        <option value="25" selected> 25 </option>
                        <option value="100"> 100 </option>
                        <option value="250"> 250 </option>
                        <option value="500"> 500 </option>
                    </select>
                    <span class="text-sm"> entries </span>
                </div>
                <div class="flex items-center gap-2 order-1 md:order-2">
                    <div id="kt-pagination" class="kt-datatable-pagination" data-kt-datatable-pagination="true"></div>
                </div>
            </div>


        </div>
    </div>
</div>

<button onclick="openConfirmModal()"
    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
    Hapus Data
</button>
<div id="confirmModal"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <!-- Modal -->
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md">
        <!-- Header -->
        <h2 class="text-lg font-bold text-gray-800 mb-2">
            Apakah kamu yakin?
        </h2>
        <p class="text-sm text-gray-600 mb-4">
            Data ini akan dihapus permanen, tindakan tidak bisa dibatalkan.
        </p>

        <!-- Footer -->
        <div class="flex justify-end gap-2">
            <button onclick="closeConfirmModal()"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                Batal
            </button>
            <button onclick="hapusData()"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                Hapus
            </button>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/exilednoname-dt-plugins.js"></script>
<script>
    $('body').on('click', '#restore', function() {
        var id = $(this).data("id");
        Swal.fire({
            text: "{{ __('default.notification.confirm.restore') }}?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{ __('default.label.yes') }}",
            cancelButtonText: "{{ __('default.label.no') }}",
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: "{{ URL::Current() }}/../restore/" + id,
                    success: function(data) {
                        // KTApp.block('#exilednoname_body', {
                        //     overlayColor: '#000000',
                        //     state: 'info',
                        //     message: "{{ __('default.label.processing') }} ..."
                        // });
                        setTimeout(function() {
                            KTApp.unblock('#exilednoname_body');
                            var oTable = $('#exilednoname_table').dataTable();
                            oTable.fnDraw(false);
                            // toastr.success(__('default.notification.success.item_restored'));
                        }, 500);
                    },
                    error: function(data) {
                        // toastr.error(translations.default.notification.error.error);
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        var defaultSort = sort.split(',').map((item, index) => {
            return index === 0 ? parseInt(item.trim()) : item.trim();
        });
        var table = $('#exilednoname_table').DataTable({
            "initComplete": function(settings, json) {
                $('#exilednoname_table_info').appendTo('#kt-pagination');
                $('.dt-paging').appendTo('#kt-pagination');
                $('#dt-length-0').appendTo('#ex_table_length');
                $('#exilednoname_table_filter').appendTo('#ex_table_filter');
            },
            dom: 't',
            info: false,
            lengthChange: false,
            pageLength: 25,
            processing: false,
            serverSide: true,
            searchDelay: 2000,
            "pagingType": "simple_numbers",
            ajax: "{{ route('dashboard.system.application.datatable.generals.trash') }}",
            language: {
                loadingRecords: "",
                emptyTable: '<div class="flex flex-col items-center justify-center text-gray-500"><span class="block text-center">' + translations.default.label.no_data_available + '</span></div>'
            },
            drawCallback: function() {
                renderPaginationWindow(this.api(), document.getElementById("kt-pagination"), 1);
            },
            headerCallback: function(thead, data, start, end, display) {
                thead.getElementsByTagName('th')[0].innerHTML = `<input id="check" type="checkbox" class="kt-checkbox group-checkable" data-kt-datatable-row-check="true" value="0" />`;
            },
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return '<input type="checkbox" class="kt-checkbox checkable" data-id="' + row.id + '">';
                    },
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    visible: false
                },
                {
                    data: 'autonumber',
                    orderable: false,
                    searchable: false,
                    'className': 'text-center',
                    'width': '1',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name',
                    'className': 'text-nowrap',
                },
                {
                    data: 'description',
                    name: 'description',
                    'className': 'text-nowrap',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                        <td>
                            <div class="kt-menu" data-kt-menu="true">
                                <div class="kt-menu-item" data-kt-menu-item-placement="bottom-end" data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="hover">
                                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-dots-vertical text-lg"></i></button>
                                    <div class="kt-menu-dropdown kt-menu-default" data-kt-menu-dismiss="true">
                                        <div class="kt-menu-item"><a class="kt-menu-link" href="${this_url}/${row.id}"><span class="kt-menu-icon"><i class="ki-filled ki-search-list"></i></span><span class="kt-menu-title"> ${translations.default.label.view} </span></a></div>
                                        <div class="kt-menu-item"><a class="kt-menu-link" href="${this_url}/${row.id}/edit"><span class="kt-menu-icon"><i class="ki-filled ki-message-edit"></i></span><span class="kt-menu-title"> ${translations.default.label.edit} </span></a></div>
                                        <div class="kt-menu-item"><a class="kt-menu-link" id="single_delete" data-id="${row.id}"><span class="kt-menu-icon"><i class="ki-filled ki-trash-square"></i></span><span class="kt-menu-title"> ${translations.default.label.delete.delete} </span></a></div>
                                    </div>
                                </div>
                            </div>
                        </td>`;
                    }
                },
            ],
            order: [defaultSort]
        });

        // GROUP CHECKABLE
        table.on('change', '.group-checkable', function() {
            const checked = $(this).is(':checked');

            table.rows().every(function() {
                const $checkbox = $(this.node()).find('.checkable');
                $checkbox.prop('checked', checked);
                checked ? this.select() : this.deselect();
            });

            const count = table.rows({
                selected: true
            }).count();

            $('#exilednoname_selected').text(count);

            const isChecked = count > 0;
            $('#checkbox_batch').toggleClass('hidden', !isChecked);
            toast_notification(isChecked ? translations.default.notification.row_checked : translations.default.notification.row_unchecked);
        });

        // CHECKABLE
        table.on('change', '.checkable', function() {
            $(this).closest('tr').toggleClass('selected', $(this).is(':checked'));
            $('#exilednoname_selected').html(table.rows('.selected').nodes().length);
            $('#checkbox_batch').toggleClass('hidden', table.rows('.selected').nodes().length === 0);
            document.querySelector('#check').indeterminate = table.rows('.selected').nodes().length > 0;
        });

        // TABLE RELOAD
        $("#table_reload").on("click", function() {
            $('#checkbox_batch').addClass('hidden');
            $('.filter_form').val('');
            table.ajax.reload(null, false);
            toast_notification(translations.default.notification.table_reload)
        });

    });
</script>
@endpush