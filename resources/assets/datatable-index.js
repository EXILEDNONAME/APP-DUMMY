// DELETE

var defaultCopy = $.fn.dataTable.ext.buttons.copyHtml5.action;
$.fn.dataTable.ext.buttons.copyHtml5.action = function (e, dt, button, config) {
    defaultCopy.apply(this, arguments);
    $('.dt-button-info').remove();
    toast_notification(translations.default.notification.success.export_copy)
};

$(document).ready(function () {

    let selectedIds = [];

    function safeStrip(data, node) {
        // Jika cell mengandung checkbox (switch), kembalikan Active/Inactive
        if (node && $(node).find('input[type="checkbox"]').length) {
            return $(node).find('input[type="checkbox"]').is(':checked') ? translations.default.label.yes : translations.default.label.no;
        }

        // Jika data null/undefined, kembalikan empty string
        if (data === null || data === undefined) return '';

        // Jika data sudah berupa string, bersihkan HTML dan trim
        if (typeof data === 'string') {
            return data.replace(/<[^>]*>?/gm, '').trim();
        }

        // Jika data adalah number / boolean, konversi ke string
        if (typeof data === 'number' || typeof data === 'boolean') {
            return String(data);
        }

        // Kalau data adalah objek (mis. node), coba ambil textContent dari node parameter
        if (node && node.textContent) {
            return String(node.textContent).trim();
        }

        // Fallback aman
        try {
            return String(data).replace(/<[^>]*>?/gm, '').trim();
        } catch (e) {
            return '';
        }
    }

    var defaultSort = sort.split(',').map((item, index) => {
        return index === 0 ? parseInt(item.trim()) : item.trim();
    });
    var table = $('#exilednoname_table').DataTable({
        "initComplete": function (settings, json) {
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
        ajax: {
            url: this_url,
            "data": function (ex) {
                ex.date = $('.filter_date').val();
            }
        },
        language: {
            loadingRecords: "",
            emptyTable: '<div class="flex flex-col items-center justify-center text-gray-500"><span class="block text-center">' + translations.default.label.no_data_available + ' ... </span></div>'
        },
        drawCallback: function () {
            renderPaginationWindow(this.api(), document.getElementById("kt-pagination"), 1);
        },
        headerCallback: function (thead, data, start, end, display) {
            thead.getElementsByTagName('th')[0].innerHTML = `<input id="check" type="checkbox" class="kt-checkbox group-checkable" data-kt-datatable-row-check="true" value="0" />`;
        },
        columns: [{
            data: 'checkbox',
            name: 'checkbox',
            searchable: false,
            orderable: false,
            render: function (data, type, row, meta) {
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
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },

        ...(file ? [{
            data: 'file',
            orderable: false,
            'className': 'text-center text-nowrap ',
            'width': '1'
        },] : []),

        ...(date ? [{
            data: 'date',
            orderable: true,
            'className': 'text-nowrap',
            'width': '1',
            render: function (data, type, row) {
                if (data == null) {
                    return '<center> - </center>'
                } else {
                    return data;
                }
            }
        },] : []),

        ...window.tableBodyColumns,

        {
            data: 'active',
            name: 'active',
            orderable: true,
            'width': '1',
            render: function (data, type, row) {
                if (data == 1) {
                    return '<a class="flex justify-center" id="table_inactive" data-id="' + row.id + '"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" checked="" /></a>';
                } else {
                    return '<a class="flex justify-center" id="table_active" data-id="' + row.id + '"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" /></a>';
                }
            }
        },

        ...(status ? [{
            data: 'status',
            name: 'status',
            orderable: true,
            className: 'text-center text-nowrap',
            width: '1',
            render: function (data) {
                if (data == 1) return '<span class="kt-badge kt-badge-mono">' + translations.default.label.default + '</span>';
                if (data == 2) return '<span class="kt-badge kt-badge-warning">' + translations.default.label.pending + '</span>';
                if (data == 3) return '<span class="kt-badge kt-badge-info">' + translations.default.label.progress + '</span>';
                if (data == 4) return '<span class="kt-badge kt-badge-success">' + translations.default.label.success + '</span>';
                if (data == 5) return '<span class="kt-badge kt-badge-destructive">' + translations.default.label.failed + '</span>';
            }
        },] : []),

        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
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
                            </div>
                        </div>
                    </div>
                </td>`;
            }
        },
        ],
        buttons: [
            {
                extend: 'print',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    format: {
                        body: function (data, row, column, node) {
                            return safeStrip(data, node);
                        }
                    }
                }
            },
            {
                extend: 'copyHtml5',
                title: '',
                autoClose: true,
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    format: {
                        body: function (data, row, column, node) {
                            return safeStrip(data, node);
                        }
                    }
                }
            },
            {
                extend: 'excelHtml5',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    format: {
                        body: function (data, row, column, node) {
                            return safeStrip(data, node);
                        }
                    }
                }
            },
            {
                extend: 'pdfHtml5',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    format: {
                        body: function (data, row, column, node) {
                            return safeStrip(data, node);
                        }
                    }
                }
            },

            // --- versi SELECTED ROWS ---
            {
                extend: 'print',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    rows: { selected: true },
                    format: {
                        body: function (data, row, column, node) {
                            return safeStrip(data, node);
                        }
                    }
                }
            },
            {
                extend: 'copyHtml5',
                title: '',
                autoClose: true,
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    rows: { selected: true },
                    format: {
                        body: function (data, row, column, node) {
                            return safeStrip(data, node);
                        }
                    }
                }
            },
            {
                extend: 'excelHtml5',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    rows: { selected: true },
                    format: {
                        body: function (data, row, column, node) {
                            return safeStrip(data, node);
                        }
                    }
                }
            },
            {
                extend: 'pdfHtml5',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    rows: { selected: true },
                    format: {
                        body: function (data, row, column, node) {
                            return safeStrip(data, node);
                        }
                    }
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
    $('#export_excel').on('click', function (e) { e.preventDefault(); table.button(2).trigger(); });
    $('#export_pdf').on('click', function (e) { e.preventDefault(); table.button(3).trigger(); });

    // TABLE SEARCH
    $('#table_search').on('keyup', function () {
        table.search(this.value).draw();
    });

    // TABLE FILTER ACTIVE / INACTIVE
    $('.filter_active').on('change', function () {
        table.column('active:name').search(this.value).draw();
    });

    // FILTER DATE
    $('.filter_date').change(function () {
        table.draw();
    });

    // GROUP CHECKABLE
    table.on('change', '.group-checkable', function () {
        const checked = $(this).is(':checked');

        table.rows().every(function () {
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
    table.on('change', '.checkable', function () {
        $(this).closest('tr').toggleClass('selected', $(this).is(':checked'));
        $('#exilednoname_selected').html(table.rows('.selected').nodes().length);
        $('#checkbox_batch').toggleClass('hidden', table.rows('.selected').nodes().length === 0);
        document.querySelector('#check').indeterminate = table.rows('.selected').nodes().length > 0;
    });

    // TABLE RELOAD
    $("#table_reload").on("click", function () {
        $('#checkbox_batch').addClass('hidden');
        $('.filter_form').val('');
        table.ajax.reload(null, false);
        toast_notification(translations.default.notification.table_reload)
    });

    // RESET TABLE
    $(".reset").on("click", function () {
        $('#checkbox_batch').addClass('hidden');
        $('.filter_form').val('');
        table.search('').columns().search('').draw();
        table.ajax.reload();
    });

    // TABLE ACTIVE
    $('body').on('click', '#table_active', function () {
        var id = $(this).data("id");
        $.ajax({
            type: "get",
            url: this_url + "/active/" + id,
            success: function (data) {
                if (data.status && data.status === 'error') {
                    toast_notification(data.message);
                    table.ajax.reload();
                    return;
                }
                var scrollTop = $(window).scrollTop();
                table.ajax.reload(function () {
                    $(window).scrollTop(scrollTop);
                }, false);
                toast_notification(translations.default.notification.success.item_active);
            },
            error: function (data) {
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

    // TABLE INACTIVE
    $('body').on('click', '#table_inactive', function () {
        var id = $(this).data("id");
        $.ajax({
            type: "get",
            url: this_url + "/inactive/" + id,
            success: function (data) {
                if (data.status && data.status === 'error') {
                    toast_notification(data.message);
                    table.ajax.reload();
                    return;
                }
                var scrollTop = $(window).scrollTop();
                table.ajax.reload(function () {
                    $(window).scrollTop(scrollTop);
                }, false);
                toast_notification(translations.default.notification.success.item_inactive);
            },
            error: function (data) {
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

    // SELECTED ACTIVE
    $('body').on('click', '[data-kt-modal-toggle="#modalSelectedActive"]', function () {
        selectedIds = [];
        $(".checkable:checked").each(function () { selectedIds.push($(this).data('id')); });
        $('#modalSelectedActive').attr('data-ids', selectedIds.join(','));
    });

    $('body').on('click', '.btn-confirm-selected-active', function () {
        let modal = KTModal.getInstance(document.querySelector('#modalSelectedActive'));
        let ids = $('#modalSelectedActive').attr('data-ids');
        $.ajax({
            data: { EXILEDNONAME: ids }, type: 'get', url: `${this_url}/selected-active`,
            success: function (data) {
                if (data.status && data.status === 'error') {
                    toast_notification(data.message);
                    modal.hide();
                    table.draw(false);
                    return;
                }
                toast_notification(translations.default.notification.success.selected_active);
                modal.hide();
                table.draw(false);
            },
            error: function () {
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

    // SELECTED INACTIVE
    $('#selected-inactive').on('click', function (e) {
        var exilednonameArr = [];
        $(".checkable:checked").each(function () {
            exilednonameArr.push($(this).attr('data-id'));
        });
        var strEXILEDNONAME = exilednonameArr.join(",");
        Swal.fire({
            text: translations.default.notification.confirm.selected_inactive + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: translations.default.label.yes,
            cancelButtonText: translations.default.label.no,
            reverseButtons: false
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: this_url + "/selected-inactive",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'EXILEDNONAME=' + strEXILEDNONAME,
                    success: function (data) {
                        if (data.status && data.status === 'error') {
                            toast_notification(data.message);
                            table.ajax.reload();
                            return;
                        }
                        $('#checkbox_batch').addClass('hidden');
                        table.draw(false);
                        toast_notification(translations.default.notification.success.selected_inactive);
                    },
                    error: function (data) {
                        toast_notification(translations.default.notification.error.error);
                    }
                });
            }
        });
    });

    // DELETE
    $('body').on('click', '[data-kt-modal-toggle="#modalDelete"]', function () {
        $('#modalDelete').attr('data-id', $(this).data('id'));
    });

    $('body').on('click', '.btn-confirm-delete', function () {
        let id = $('#modalDelete').attr('data-id');
        let modal = KTModal.getInstance(document.querySelector('#modalDelete'));
        $.ajax({
            type: 'GET', url: `${this_url}/delete/${id}`,
            success: function (data) {
                if (data.status && data.status === 'error') {
                    toast_notification(data.message);
                    modal.hide();
                    table.draw(false);
                    return;
                }
                toast_notification(translations.default.notification.success.item_deleted);
                modal.hide();
                table.draw(false);
            },
            error: function () {
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

    // SELECTED DELETE
    $('#selected-delete').on('click', function (e) {
        var exilednonameArr = [];
        $(".checkable:checked").each(function () {
            exilednonameArr.push($(this).attr('data-id'));
        });
        var strEXILEDNONAME = exilednonameArr.join(",");
        Swal.fire({
            text: translations.default.notification.confirm.selected_delete + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: translations.default.label.yes,
            cancelButtonText: translations.default.label.no,
            reverseButtons: false
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: this_url + "/selected-delete",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'EXILEDNONAME=' + strEXILEDNONAME,
                    success: function (data) {
                        if (data.status && data.status === 'error') {
                            toast_notification(data.message);
                            table.ajax.reload();
                            return;
                        }
                        $('#checkbox_batch').addClass('hidden');
                        table.draw(false);
                        toast_notification(translations.default.notification.success.selected_delete);
                    },
                    error: function (data) {
                        toast_notification(translations.default.notification.error.error);
                    }
                });
            }
        });
    });

    // OTHER

    $('#perpage').on('change', function () {
        let perPage = $(this).val();
        table.page.len(perPage).draw();
    });

    table.on('draw.dt', function () {
        $('#checkbox_batch').addClass('hidden');
    });

    $("#toggle_filters").on("click", function () {
        if ($("#filters").hasClass("hidden")) {
            $('#filters').removeClass('hidden');
        } else {
            $('#filters').addClass('hidden');
        }
    });

});