// GROUP CHECKABLE, CHECKABLE
// TABLE RELOAD
// TABLE FILTER ACTIVE / INACTIVE
// TABLE FILTER DATE
// TABLE FILTER DATERANGE
// TABLE FILTER STATUS
// TABLE FILTER RESET
// TABLE ACTIVE
// TABLE INACTIVE
// TABLE DELETE
// SELECTED ACTIVE
// SELECTED INACTIVE
// TABLE SELECTED ACTIVE

$(document).ready(function () {

    function safeStrip(data, node) {
        if (node && $(node).find('input[type="checkbox"]').length) { return $(node).find('input[type="checkbox"]').is(':checked') ? translations.default.label.yes : translations.default.label.no; }
        if (data === null || data === undefined) return '';
        if (typeof data === 'string') { return data.replace(/<[^>]*>?/gm, '').trim(); }
        if (typeof data === 'number' || typeof data === 'boolean') { return String(data); }
        if (node && node.textContent) { return String(node.textContent).trim(); }
        try { return String(data).replace(/<[^>]*>?/gm, '').trim(); } catch (e) { return ''; }
    }

    function renderPaginationWindow(dt, container, windowSize = 2) {
        const pageInfo = dt.page.info();
        const totalPages = pageInfo.pages;
        const currentPage = pageInfo.page;
        container.innerHTML = "";

        const prevBtn = document.createElement("button");
        prevBtn.className = "kt-datatable-pagination-button kt-datatable-pagination-prev";
        prevBtn.disabled = currentPage === 0;
        prevBtn.innerHTML = `<svg class="rtl:transform rtl:rotate-180 size-3.5 shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.86501 16.7882V12.8481H21.1459C21.3724 12.8481 21.5897 12.7581 21.7498 12.5979C21.91 12.4378 22 12.2205 22 11.994C22 11.7675 21.91 11.5503 21.7498 11.3901C21.5897 11.2299 21.3724 11.1399 21.1459 11.1399H8.86501V7.2112C8.86628 7.10375 8.83517 6.9984 8.77573 6.90887C8.7163 6.81934 8.63129 6.74978 8.53177 6.70923C8.43225 6.66869 8.32283 6.65904 8.21775 6.68155C8.11267 6.70405 8.0168 6.75766 7.94262 6.83541L2.15981 11.6182C2.1092 11.668 2.06901 11.7274 2.04157 11.7929C2.01413 11.8584 2 11.9287 2 11.9997C2 12.0707 2.01413 12.141 2.04157 12.2065C2.06901 12.272 2.1092 12.3314 2.15981 12.3812L7.94262 17.164C8.0168 17.2417 8.11267 17.2953 8.21775 17.3178C8.32283 17.3403 8.43225 17.3307 8.53177 17.2902C8.63129 17.2496 8.7163 17.18 8.77573 17.0905C8.83517 17.001 8.86628 16.8956 8.86501 16.7882Z" fill="currentColor"></path></svg>`;
        prevBtn.addEventListener("click", () => dt.page("previous").draw(false))
        container.appendChild(prevBtn);

        const firstBtn = document.createElement("button");
        firstBtn.className = "kt-datatable-pagination-button";
        firstBtn.textContent = "1";
        if (currentPage === 0) firstBtn.classList.add("active", "disabled");
        firstBtn.addEventListener("click", () => dt.page(0).draw(false));
        container.appendChild(firstBtn);

        if (currentPage - windowSize > 1) {
            const dots = document.createElement("span");
            dots.textContent = "...";
            dots.className = "px-1";
            container.appendChild(dots);
        }

        const start = Math.max(1, currentPage - windowSize);
        const end = Math.min(totalPages - 2, currentPage + windowSize);
        for (let i = start; i <= end; i++) {
            const btn = document.createElement("button");
            btn.className = "kt-datatable-pagination-button";
            btn.textContent = i + 1;
            if (i === currentPage) btn.classList.add("active", "disabled");
            btn.addEventListener("click", () => dt.page(i).draw(false));
            container.appendChild(btn);
        }

        if (currentPage + windowSize < totalPages - 2) {
            const dots = document.createElement("span");
            dots.textContent = "...";
            dots.className = "px-1";
            container.appendChild(dots);
        }

        if (totalPages > 1) {
            const lastBtn = document.createElement("button");
            lastBtn.className = "kt-datatable-pagination-button";
            lastBtn.textContent = totalPages;
            if (currentPage === totalPages - 1) lastBtn.classList.add("active", "disabled");
            lastBtn.addEventListener("click", () => dt.page(totalPages - 1).draw(false));
            container.appendChild(lastBtn);
        }

        const nextBtn = document.createElement("button");
        nextBtn.className = "kt-datatable-pagination-button kt-datatable-pagination-next";
        nextBtn.disabled = currentPage === totalPages - 1;
        nextBtn.innerHTML = `<svg class="rtl:transform rtl:rotate-180 size-3.5 shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.135 7.21144V11.1516H2.85407C2.62756 11.1516 2.41032 11.2415 2.25015 11.4017C2.08998 11.5619 2 11.7791 2 12.0056C2 12.2321 2.08998 12.4494 2.25015 12.6096C2.41032 12.7697 2.62756 12.8597 2.85407 12.8597H15.135V16.7884C15.1337 16.8959 15.1648 17.0012 15.2243 17.0908C15.2837 17.1803 15.3687 17.2499 15.4682 17.2904C15.5677 17.3309 15.6772 17.3406 15.7822 17.3181C15.8873 17.2956 15.9832 17.242 16.0574 17.1642L21.8402 12.3814C21.8908 12.3316 21.931 12.2722 21.9584 12.2067C21.9859 12.1412 22 12.0709 22 11.9999C22 11.9289 21.9859 11.8586 21.9584 11.7931C21.931 11.7276 21.8908 11.6683 21.8402 11.6185L16.0574 6.83565C15.9832 6.75791 15.8873 6.70429 15.7822 6.68179C15.6772 6.65929 15.5677 6.66893 15.4682 6.70948C15.3687 6.75002 15.2837 6.81959 15.2243 6.90911C15.1648 6.99864 15.1337 7.10399 15.135 7.21144Z" fill="currentColor"></path></svg>`;
        nextBtn.addEventListener("click", () => dt.page("next").draw(false));
        container.appendChild(nextBtn);
    }

    var selectedIds = [];
    var defaultSort = sort.split(',').map((item, index) => { return index === 0 ? parseInt(item.trim()) : item.trim(); });
    var table = $('#exilednoname_table').DataTable({
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
                const range = $('#dateRange').val();
                if (range.includes(' to ')) { ex.date_start = range.split(' to ')[0]; ex.date_end = range.split(' to ')[1]; }
                else { ex.date_start = range; ex.date_end = range; }
            }
        },
        language: {
            loadingRecords: "",
            emptyTable: '<div class="flex flex-col items-center justify-center text-gray-500"><span class="block text-center">' + translations.default.label.no_data_available + ' ... </span></div>',
            zeroRecords: '<div class="flex flex-col items-center justify-center text-gray-500"><span class="block text-center">' + translations.default.label.no_data_matching + ' ... </span></div>',
        },
        drawCallback: function () { renderPaginationWindow(this.api(), document.getElementById("kt-pagination"), 1); },
        headerCallback: function (thead, data, start, end, display) { thead.getElementsByTagName('th')[0].innerHTML = `<input id="check" type="checkbox" class="kt-checkbox group-checkable" data-kt-datatable-row-check="true" value="0" />`; },
        columns: [
            {
                data: null, name: 'checkbox', searchable: false, orderable: false,
                render: function (data, type, row, meta) { return '<input type="checkbox" class="kt-checkbox checkable" data-id="' + row.id + '">'; },
            },
            { data: 'created_at', name: 'created_at', visible: false },
            {
                data: null, orderable: false, searchable: false, 'className': 'text-center', 'width': '1',
                render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }
            },

            ...(status ? [{
                data: 'status', name: 'status', orderable: true, className: 'text-center text-nowrap', width: '1',
                render: function (data) {
                    if (data == 1) return '<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-mono">' + translations.default.label.default + '</span>';
                    if (data == 2) return '<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-warning">' + translations.default.label.pending + '</span>';
                    if (data == 3) return '<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-info">' + translations.default.label.progress + '</span>';
                    if (data == 4) return '<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-success">' + translations.default.label.success + '</span>';
                    if (data == 5) return '<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-destructive">' + translations.default.label.failed + '</span>';
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

            {
                data: 'active', name: 'active', orderable: true, 'width': '1',
                render: function (data, type, row) {
                    if (data == 0) { return '<a class="flex justify-center table_active" data-id="' + row.id + '"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" /></a>'; }
                    if (data == 1) { return '<a class="flex justify-center table_inactive" data-id="' + row.id + '"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" checked="" /></a>'; }
                    if (data == 2) { return '<a class="flex justify-center" id="table_active" data-id="' + row.id + '"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" /></a>'; }
                }
            },
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
    $('#export_pdf').on('click', function (e) {
        e.preventDefault();

        function triggerPdfButton() {
            const pdfBtn = table.button('.btn-export-pdf');
            if (pdfBtn.length) { pdfBtn.trigger(); } else { toast_notification(translations.default.notification.error.error); }
        }

        if (typeof pdfMake === 'undefined' || typeof pdfMake.createPdf === 'undefined') {
            $.when(
                $.getScript('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js'),
                $.getScript('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js')
            ).then(function () {
                table.button().add(4, {
                    extend: 'pdfHtml5', text: 'PDF', className: 'btn-export-pdf', exportOptions: {
                        columns: "thead th:not(.no-export)", orthogonal: "Export",
                        format: { body: function (data, row, column, node) { return safeStrip(data, node); } }
                    }
                });
                triggerPdfButton();
            })
        } else {
            triggerPdfButton();
        }
    });

    // GROUP CHECKABLE
    table.on('change', '.group-checkable', function () {
        const checked = $(this).is(':checked');

        table.rows().every(function () {
            const $checkbox = $(this.node()).find('.checkable');
            $checkbox.prop('checked', checked);
            checked ? this.select() : this.deselect();
        });

        const count = table.rows({ selected: true }).count();
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
    $(".table_reload").on("click", function () {
        $('#checkbox_batch').addClass('hidden');
        table.ajax.reload(null, false);
        toast_notification(translations.default.notification.table_reload)
    });

    // TABLE FILTER ACTIVE / INACTIVE
    $('.table_filter_active').on('change', function () {
        table.column('active:name').search(this.value).draw();
    });

    // TABLE FILTER DATE
    $('.table_filter_date').change(function () {
        table.draw(false);
    });

    // TABLE FILTER DATERANGE
    flatpickr("#dateRange", {
        mode: "range",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        allowInput: true,
        disableMobile: true,
        onClose: function (selectedDates, dateStr, instance) {
            table.draw(false);
        }
    });

    // TABLE FILTER STATUS
    $('.filter_status').change(function () {
        table.draw(false);
        table.column('status:name').search(this.value).draw();
    });

    // TABLE FILTER RESET
    $(".table_reset_filter").on("click", function () {
        $('#checkbox_batch').addClass('hidden');
        $('.filter_form').val('');
        table.search('').columns().search('').draw();
        table.ajax.reload();
    });

    // TABLE ACTIVE
    $('body').on('click', '.table_active', function () {
        var id = $(this).data("id");
        $.ajax({
            type: "get", url: this_url + "/active/" + id,
            success: function (data) {
                if (data.status && data.status === 'error') { toast_notification(data.message); table.ajax.reload(); return; }
                var scrollTop = $(window).scrollTop();
                table.ajax.reload(function () { $(window).scrollTop(scrollTop); }, false);
                toast_notification(translations.default.notification.success.item_active);
            },
            error: function (data) {
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

    // TABLE INACTIVE
    $('body').on('click', '.table_inactive', function () {
        var id = $(this).data("id");
        $.ajax({
            type: "get", url: this_url + "/inactive/" + id,
            success: function (data) {
                if (data.status && data.status === 'error') { toast_notification(data.message); table.ajax.reload(); return; }
                var scrollTop = $(window).scrollTop();
                table.ajax.reload(function () { $(window).scrollTop(scrollTop); }, false);
                toast_notification(translations.default.notification.success.item_inactive);
            },
            error: function (data) {
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

    // TABLE DELETE
    $('body').on('click', '[data-kt-modal-toggle="#modalDelete"]', function () {
        $('#modalDelete').attr('data-id', $(this).data('id'));
    });

    $('body').on('click', '.btn-confirm-delete', function () {
        let id = $('#modalDelete').attr('data-id');
        let modal = KTModal.getInstance(document.querySelector('#modalDelete'));
        $.ajax({
            type: 'get', url: `${this_url}/delete/${id}`,
            success: function (data) {
                if (data.status && data.status === 'error') { toast_notification(data.message); modal.hide(); table.draw(false); return; }
                toast_notification(translations.default.notification.success.item_deleted);
                modal.hide();
                table.draw(false);
            },
            error: function () {
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
                if (data.status && data.status === 'error') { toast_notification(data.message); modal.hide(); table.draw(false); return; }
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
    $('body').on('click', '[data-kt-modal-toggle="#modalSelectedInactive"]', function () {
        selectedIds = [];
        $(".checkable:checked").each(function () { selectedIds.push($(this).data('id')); });
        $('#modalSelectedInactive').attr('data-ids', selectedIds.join(','));
    });

    $('body').on('click', '.btn-confirm-selected-inactive', function () {
        let modal = KTModal.getInstance(document.querySelector('#modalSelectedInactive'));
        let ids = $('#modalSelectedInactive').attr('data-ids');
        $.ajax({
            data: { EXILEDNONAME: ids }, type: 'get', url: `${this_url}/selected-inactive`,
            success: function (data) {
                if (data.status && data.status === 'error') { toast_notification(data.message); modal.hide(); table.draw(false); return; }
                toast_notification(translations.default.notification.success.selected_inactive);
                modal.hide();
                table.draw(false);
            },
            error: function () {
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

    // SELECTED DELETE
    $('body').on('click', '[data-kt-modal-toggle="#modalSelectedDelete"]', function () {
        selectedIds = [];
        $(".checkable:checked").each(function () { selectedIds.push($(this).data('id')); });
        $('#modalSelectedDelete').attr('data-ids', selectedIds.join(','));
    });

    $('body').on('click', '.btn-confirm-selected-delete', function () {
        let modal = KTModal.getInstance(document.querySelector('#modalSelectedDelete'));
        let ids = $('#modalSelectedDelete').attr('data-ids');
        $.ajax({
            data: { EXILEDNONAME: ids }, type: 'get', url: `${this_url}/selected-delete`,
            success: function (data) {
                if (data.status && data.status === 'error') { toast_notification(data.message); modal.hide(); table.draw(false); return; }
                toast_notification(translations.default.notification.success.selected_delete);
                modal.hide();
                table.draw(false);
            },
            error: function () {
                toast_notification(translations.default.notification.error.error);
            }
        });
    });

    /***** OTHER FUNCTION *****/

    // TABLE SEARCH
    $('#table_search').on('keyup', function () {
        table.search(this.value).draw();
    });

    // RENDER COPY FILE
    var defaultCopy = $.fn.dataTable.ext.buttons.copyHtml5.action;
    $.fn.dataTable.ext.buttons.copyHtml5.action = function (e, dt, button, config) {
        defaultCopy.apply(this, arguments);
        $('.dt-button-info').remove();
        toast_notification(translations.default.notification.success.export_copy)
    };

    // PAGINATION
    $('#perpage').on('change', function () {
        let perPage = $(this).val();
        table.page.len(perPage).draw();
    });

    // HIDDEN BATCH ACTION
    table.on('draw.dt', function () {
        $('#checkbox_batch').addClass('hidden');
    });

    // TOGGLE FILTERS
    $("#toggle_filters").on("click", function () {
        if ($("#filters").hasClass("hidden")) {
            $('#filters').removeClass('hidden');
        } else {
            $('#filters').addClass('hidden');
        }
    });

});

