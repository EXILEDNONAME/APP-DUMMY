@extends('layouts.backend.default')

@push('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.main') }} </h3>
                <div class="kt-menu">
                    <a href="{{ URL::Current() }}/create"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_create" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-plus"></i></button></a>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost table_reload" data-kt-tooltip="#tooltip_reload" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-arrows-circle"></i></button>
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
                    <button id="toggle_filters" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_filter" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-setting-4"></i></button>
                    <!-- <div  class="">
                        <a href=""><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-dots-vertical"></i></button></a>
                    </div> -->
                    <div class="inline-flex" data-kt-dropdown="true" data-kt-dropdown-trigger="hover" data-kt-dropdown-placement="bottom-end">
                        <button id="checkbox_batch" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost hidden" data-kt-dropdown-toggle="true" data-kt-tooltip="#tooltip_export" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-dots-vertical"></i></button>
                        <div class="kt-dropdown text-sm" data-kt-dropdown-menu="true">
                            <div class="kt-card-body grid gap-3">
                                <div class="flex">
                                    <div class="kt-menu-default w-px whitespace-nowrap" data-kt-menu-dismiss="true">
                                        <div class="kt-menu-item" data-kt-tooltip="#tooltip_select_active" data-kt-tooltip-placement="top-end"><a id="selected-active" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-check"></i></span><span class="kt-menu-title"> {{ __('default.select.active') }} </span></a></div>
                                        <div class="kt-menu-item" data-kt-tooltip="#tooltip_select_inactive" data-kt-tooltip-placement="top-end"><a id="selected-inactive" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-cross"></i></span><span class="kt-menu-title"> {{ __('default.select.inactive') }} </span></a></div>
                                        <div class="kt-menu-item" data-kt-tooltip="#tooltip_select_delete" data-kt-tooltip-placement="top-end"><a id="selected-delete" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-trash"></i></span><span class="kt-menu-title"> {{ __('default.select.delete') }} </span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="filters" class="hidden">
                <div class="grid gap-2 p-5">
                    <label class="kt-input">
                        <i class="ki-filled ki-magnifier"></i>
                        <input id="searchInput" class="filter_form" placeholder="Search" type="text" />
                    </label>

                    <select class="kt-select filter_form filter_active">
                        <option value=""> - {{ __('default.select.active') }} - </option>
                        <option value="1"> {{ __('default.label.yes') }} </option>
                        <option value="0"> {{ __('default.label.no') }} </option>
                    </select>

                    <div class="flex items-center">
                        <div class="kt-form-control flex-1">
                            <select class="kt-select filter_form">
                                <option value="">- Select Status -</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <input id="datepicker" name="date" class="kt-input filter_form filter_date" placeholder="- Select Date -" />

                    <button class="kt-menu-toggle kt-btn kt-btn-primary kt-btn-sm reset" data-kt-tooltip="#tooltip_reset" data-kt-tooltip-placement="top-end"> {{ __('default.label.reset') }} </button>

                </div>

                <div class="kt-card-footer justify-center"></div>
            </div>

            <div class="kt-card-content">
                <div class="kt-scrollable overflow-x-auto p-0.5">

                    <table id="exilednoname_table" class="kt-table" width="100%">
                        <thead>
                            <tr>
                                <th class="w-px whitespace-nowrap no-export"></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-bold"> No. </span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-bold"> Date </span><span class="kt-table-col-sort"></span></span></th>
                                <!-- <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-bold"> Name </span><span class="kt-table-col-sort"></span></span></th>
                            <th class="w-full"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-bold"> Description </span><span class="kt-table-col-sort"></span></span></th> -->
                                @yield('table-header')
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-bold"> Active </span></span></th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-bold"> Status </span></span></th>
                                <th class="w-px whitespace-nowrap no-export"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="kt-card-footer flex flex-col md:flex-row justify-center md:justify-between gap-5 text-secondary-foreground text-sm font-medium">
                <div class="flex items-center gap-2 order-2 md:order-1">
                    <label for="perpage" class="text-sm">Show</label>
                    <select id="perpage" class="kt-select w-16 border rounded px-2 py-1">
                        <option value="25" selected>25</option>
                        <option value="100">100</option>
                        <option value="250">250</option>
                        <option value="500">500</option>
                    </select>
                    <span class="text-sm">entries</span>
                </div>
                <div class="flex items-center gap-2 order-1 md:order-2">
                    <div id="kt-pagination" class="kt-datatable-pagination" data-kt-datatable-pagination="true"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="lg:col-span-1">
    <div class="grid">
        <div id="printData">
            <div class="kt-card kt-card-grid w-full">
                <div class="kt-card-header">
                    <h3 class="kt-card-title text-sm grid gap-5"> Activities </h3>
                    <div class="kt-menu" data-kt-menu="true">
                        <a href="{{ URL::Current() }}/edit"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_edit" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-pencil"></i></button></a>
                        <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_print" data-kt-tooltip-placement="top-end" onclick="printData('printData')"><i class="ki-filled ki-printer"></i></button>
                        <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" class="kt-btn" data-kt-modal-toggle="#modalScan" data-kt-tooltip="#tooltip_qrcode" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-scan-barcode"></i></button>
                        <div id="tooltip_qrcode" class="kt-tooltip"> QR Code </div>
                    </div>
                </div>

                <div class="kt-card-body p-1 w-full">
                    <div class="kt-scrollable-x-auto">

                    </div>
                </div>

                <!-- <div class="kt-card-footer"></div> -->
            </div>
        </div>
    </div>
</div>

<div class="lg:col-span-2">
    <div class="grid">
        <div id="printData">
            <div class="kt-card kt-card-grid w-full">
                <div class="kt-card-header">
                    <h3 class="kt-card-title text-sm grid gap-5"> Charts </h3>
                    <div class="kt-menu" data-kt-menu="true">
                        <a href="{{ URL::Current() }}/edit"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_edit" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-pencil"></i></button></a>
                        <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_print" data-kt-tooltip-placement="top-end" onclick="printData('printData')"><i class="ki-filled ki-printer"></i></button>
                        <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" class="kt-btn" data-kt-modal-toggle="#modalScan" data-kt-tooltip="#tooltip_qrcode" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-scan-barcode"></i></button>
                        <div id="tooltip_qrcode" class="kt-tooltip"> QR Code </div>
                    </div>
                </div>

                <div class="kt-card-body p-1 w-full">
                    <div id="area_chart"></div>
                </div>

                <!-- <div class="kt-card-footer"></div> -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')


<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.min.css" /> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script> -->

<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.pdfmake.min.js"></script> -->

<script src="https://cdn.datatables.net/select/2.0.0/js/dataTables.select.min.js"></script>
<script src="/assets/backend/vendors/apexcharts/apexcharts.min.js">
</script>
<!--Custom script -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#datepicker", {
        dateFormat: "Y-m-d", // format YYYY-MM-DD
        altInput: true, // tampil lebih human readable
        altFormat: "d F Y", // format alternatif (contoh: 03 Oktober 2025)
        allowInput: false, // bisa manual ketik juga
        disableMobile: true
    });
</script>

<script>
    class KTExampleAreaChart {
        static init() {
            const created = [75, 25, 45, 15, 85, 35, 70, 25, 35, 15, 45, 30];
            const updated = [20, 25, 45, 15, 85, 35, 70, 25, 35, 15, 45, 30];
            const deleted = [45, 25, 45, 15, 85, 35, 70, 25, 35, 15, 45, 30];
            const categories = [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec',
            ];

            const options = {
                series: [{
                        name: 'Created',
                        data: created,
                    },
                    {
                        name: 'Updated',
                        data: updated,
                    },
                    {
                        name: 'Deleted',
                        data: deleted,
                    },
                ],
                chart: {
                    height: 250,
                    type: 'area',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: true,
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: ['var(--color-primary)', 'var(--color-mono)', 'var(--color-destructive)'],
                },
                xaxis: {
                    categories: categories,
                    axisBorder: {
                        show: false,
                    },
                    maxTicks: 12,
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        style: {
                            colors: 'var(--color-secondary-foreground)',
                            fontSize: '12px',
                        },
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: 'var(--color-primary)',
                            width: 1,
                            dashArray: 3,
                        },
                    },
                    tooltip: {
                        enabled: false,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                        },
                    },
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    tickAmount: 5, // This will create 5 ticks: 0, 20, 40, 60, 80, 100
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        style: {
                            colors: 'var(--color-secondary-foreground)',
                            fontSize: '12px',
                        },
                        formatter: (value) => {
                            return `${value}`;
                        },
                    },
                },
                tooltip: {
                    enabled: true,
                    // custom({ series, seriesIndex, dataPointIndex, w }) {
                    // 	const number = parseInt(series[seriesIndex][dataPointIndex]) * 1000;
                    // 	const month = w.globals.seriesX[seriesIndex][dataPointIndex];
                    // 	const monthName = categories[month];

                    // 	const formatter = new Intl.NumberFormat('en-US', {
                    // 		style: 'currency',
                    // 		currency: 'USD',
                    // 	});

                    // 	const formattedNumber = formatter.format(number);

                    // 	return `
                    //         <div class="flex flex-col gap-2 p-3.5">
                    //         <div class="font-medium text-2sm text-white">
                    //         ${monthName}, 2025 Sales
                    //         </div>
                    //         <div class="flex items-center gap-1.5">
                    //         <div class="font-semibold text-md text-mono">
                    //         ${formattedNumber}
                    //         </div>
                    //         <span class="kt-kt-badge kt-kt-badge-outline kt-kt-badge-success kt-badge-sm">
                    //         +24%
                    //         </span>
                    //         </div>
                    //         </div>
                    //     `;
                    // },
                },
                markers: {
                    size: 0,
                    colors: 'var(--color-primary)',
                    strokeColors: 'var(--color-primary)',
                    strokeWidth: 4,
                    strokeOpacity: 1,
                    strokeDashArray: 0,
                    fillOpacity: 1,
                    discrete: [],
                    shape: 'circle',
                    radius: 2,
                    offsetX: 0,
                    offsetY: 0,
                    onClick: undefined,
                    onDblClick: undefined,
                    showNullDataPoints: true,
                    hover: {
                        size: 8,
                        sizeOffset: 0,
                    },
                },
                fill: {
                    gradient: {
                        enabled: true,
                        opacityFrom: 0.25,
                        opacityTo: 0,
                    },
                },
                grid: {
                    borderColor: 'var(--color-border)',
                    strokeDashArray: 5,
                    clipMarkers: false,
                    yaxis: {
                        lines: {
                            show: true,
                        },
                    },
                    xaxis: {
                        lines: {
                            show: false,
                        },
                    },
                },
            };

            const element = document.querySelector('#area_chart');
            if (!element) return;

            const chart = new ApexCharts(element, options);
            chart.render();
        }
    }

    KTDom.ready(() => {
        KTExampleAreaChart.init();
    });
</script>


<script>
    // COPY
    var defaultCopy = $.fn.dataTable.ext.buttons.copyHtml5.action;

    $.fn.dataTable.ext.buttons.copyHtml5.action = function(e, dt, button, config) {
        // Jalankan action bawaan dengan apply (bukan call biasa)
        defaultCopy.apply(this, arguments);

        // Hapus notifikasi default bawaan DataTables
        $('.dt-button-info').remove();

        // Tampilkan custom toast
        KTToast.show({
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-info-icon lucide-info">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 16v-4"/>
                    <path d="M12 8h.01"/>
               </svg>`,
            progress: true,
            pauseOnHover: true,
            maxToasts: 3,
            position: 'bottom-end',
            variant: 'mono',
            message: "{{ __('default.notification.success.export_copy') }}"
        });
    };

    function renderPaginationWindow(dt, container, windowSize = 2) {
        const pageInfo = dt.page.info();
        const totalPages = pageInfo.pages;
        const currentPage = pageInfo.page; // 0-indexed
        container.innerHTML = "";

        // Prev
        const prevBtn = document.createElement("button");
        prevBtn.className = "kt-datatable-pagination-button kt-datatable-pagination-prev";
        prevBtn.disabled = currentPage === 0;
        prevBtn.innerHTML = `<svg class="rtl:transform rtl:rotate-180 size-3.5 shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.86501 16.7882V12.8481H21.1459C21.3724 12.8481 21.5897 12.7581 21.7498 12.5979C21.91 12.4378 22 12.2205 22 11.994C22 11.7675 21.91 11.5503 21.7498 11.3901C21.5897 11.2299 21.3724 11.1399 21.1459 11.1399H8.86501V7.2112C8.86628 7.10375 8.83517 6.9984 8.77573 6.90887C8.7163 6.81934 8.63129 6.74978 8.53177 6.70923C8.43225 6.66869 8.32283 6.65904 8.21775 6.68155C8.11267 6.70405 8.0168 6.75766 7.94262 6.83541L2.15981 11.6182C2.1092 11.668 2.06901 11.7274 2.04157 11.7929C2.01413 11.8584 2 11.9287 2 11.9997C2 12.0707 2.01413 12.141 2.04157 12.2065C2.06901 12.272 2.1092 12.3314 2.15981 12.3812L7.94262 17.164C8.0168 17.2417 8.11267 17.2953 8.21775 17.3178C8.32283 17.3403 8.43225 17.3307 8.53177 17.2902C8.63129 17.2496 8.7163 17.18 8.77573 17.0905C8.83517 17.001 8.86628 16.8956 8.86501 16.7882Z" fill="currentColor"></path>
        </svg>`;
        prevBtn.addEventListener("click", () => dt.page("previous").draw(false))
        container.appendChild(prevBtn);

        // Halaman 1
        const firstBtn = document.createElement("button");
        firstBtn.className = "kt-datatable-pagination-button";
        firstBtn.textContent = "1";
        if (currentPage === 0) firstBtn.classList.add("active", "disabled");
        firstBtn.addEventListener("click", () => dt.page(0).draw(false));
        container.appendChild(firstBtn);

        // ... sebelum window
        if (currentPage - windowSize > 1) {
            const dots = document.createElement("span");
            dots.textContent = "...";
            dots.className = "px-1";
            container.appendChild(dots);
        }

        // Window sekitar current page
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

        // ... setelah window
        if (currentPage + windowSize < totalPages - 2) {
            const dots = document.createElement("span");
            dots.textContent = "...";
            dots.className = "px-1";
            container.appendChild(dots);
        }

        // Halaman terakhir
        if (totalPages > 1) {
            const lastBtn = document.createElement("button");
            lastBtn.className = "kt-datatable-pagination-button";
            lastBtn.textContent = totalPages;
            if (currentPage === totalPages - 1) lastBtn.classList.add("active", "disabled");
            lastBtn.addEventListener("click", () => dt.page(totalPages - 1).draw(false));
            container.appendChild(lastBtn);
        }

        // Next
        const nextBtn = document.createElement("button");
        nextBtn.className = "kt-datatable-pagination-button kt-datatable-pagination-next";
        nextBtn.disabled = currentPage === totalPages - 1;
        nextBtn.innerHTML = `<svg class="rtl:transform rtl:rotate-180 size-3.5 shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.135 7.21144V11.1516H2.85407C2.62756 11.1516 2.41032 11.2415 2.25015 11.4017C2.08998 11.5619 2 11.7791 2 12.0056C2 12.2321 2.08998 12.4494 2.25015 12.6096C2.41032 12.7697 2.62756 12.8597 2.85407 12.8597H15.135V16.7884C15.1337 16.8959 15.1648 17.0012 15.2243 17.0908C15.2837 17.1803 15.3687 17.2499 15.4682 17.2904C15.5677 17.3309 15.6772 17.3406 15.7822 17.3181C15.8873 17.2956 15.9832 17.242 16.0574 17.1642L21.8402 12.3814C21.8908 12.3316 21.931 12.2722 21.9584 12.2067C21.9859 12.1412 22 12.0709 22 11.9999C22 11.9289 21.9859 11.8586 21.9584 11.7931C21.931 11.7276 21.8908 11.6683 21.8402 11.6185L16.0574 6.83565C15.9832 6.75791 15.8873 6.70429 15.7822 6.68179C15.6772 6.65929 15.5677 6.66893 15.4682 6.70948C15.3687 6.75002 15.2837 6.81959 15.2243 6.90911C15.1648 6.99864 15.1337 7.10399 15.135 7.21144Z" fill="currentColor"></path></svg>`;
        nextBtn.addEventListener("click", () => dt.page("next").draw(false));
        container.appendChild(nextBtn);
    }

    $(document).ready(function() {
        // var copyHtml5Action = $.fn.dataTable.ext.buttons.copyHtml5.action;
        var url = "{{ URL::Current() }}";
        var table = $('#exilednoname_table').DataTable({

            "initComplete": function(settings, json) {
                $('#exilednoname_table_info').appendTo('#kt-pagination');
                $('.dt-paging').appendTo('#kt-pagination');
                $('#dt-length-0').appendTo('#ex_table_length');
                $('#exilednoname_table_filter').appendTo('#ex_table_filter');
            },

            processing: false,
            serverSide: true,
            "pagingType": "simple_numbers",
            pageLength: 25,
            lengthChange: false,
            info: false,
            dom: 't',
            responsive: true,
            language: {
                loadingRecords: "" // kosongkan teks
            },

            ajax: {
                url: "{{ URL::Current() }}",
                "data": function(ex) {
                    ex.date = $('.filter_date').val();
                }
            },
            headerCallback: function(thead, data, start, end, display) {
                thead.getElementsByTagName('th')[0].innerHTML = `<input id="check" type="checkbox" class="kt-checkbox group-checkable" data-kt-datatable-row-check="true" value="0" />`;
            },
            drawCallback: function() {
                renderPaginationWindow(this.api(), document.getElementById("kt-pagination"), 1);
            },
            buttons: [{
                    extend: 'print',
                    title: '',
                    exportOptions: {
                        rows: function(idx, data, node) {
                            var selectedCount = table.rows('.selected').count();
                            if (selectedCount > 0) {
                                return $(node).hasClass('selected');
                            }
                            return true;
                        },
                        columns: "thead th:not(.no-export)",
                        orthogonal: "Export",
                    },
                },
                {
                    extend: 'copyHtml5',
                    title: '',
                    autoClose: 'true',
                    exportOptions: {
                        rows: function(idx, data, node) {
                            var selectedCount = table.rows('.selected').count();
                            if (selectedCount > 0) {
                                return $(node).hasClass('selected');
                            }
                            return true;
                        },
                        columns: "thead th:not(.no-export)",
                        orthogonal: "Export"
                    },

                },
                {
                    extend: 'pdfHtml5',
                    title: '',
                    exportOptions: {
                        columns: "thead th:not(.no-export)",
                        orthogonal: "Export"
                    },
                },
                {
                    extend: 'excelHtml5',
                    title: '',
                    exportOptions: {
                        columns: "thead th:not(.no-export)",
                        orthogonal: "Export",
                        rows: {
                            selected: true
                        }
                    },
                },
            ],
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
                    data: 'autonumber',
                    orderable: false,
                    searchable: false,
                    'className': 'align-middle text-center',
                    'width': '1',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'date',
                    'className': 'text-nowrap'
                },
                @yield('table-body') {
                    data: 'active',
                    name: 'active',
                    orderable: true,
                    'width': '1',
                    render: function(data, type, row) {
                        if (data == 1) {
                            return '<a class="flex justify-center" id="table_inactive" data-id="' + row.id + '"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" checked="" /></a>';
                        } else {
                            return '<a class="flex justify-center" id="table_active" data-id="' + row.id + '"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" /></a>';
                        }
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false,
                    className: 'text-center text-nowrap',
                    render: function(data, type, row) {
                        if (data == 1) return '<span class="kt-badge kt-badge-mono"> {{ __("default.label.default") }}</span>';
                        if (data == 2) return '<span class="kt-badge kt-badge-warning"> {{ __("default.label.pending") }}</span>';
                        if (data == 3) return '<span class="kt-badge kt-badge-info"> {{ __("default.label.progress") }}</span>';
                        if (data == 4) return '<span class="kt-badge kt-badge-success"> {{ __("default.label.success") }}</span>';
                        if (data == 5) return '<span class="kt-badge kt-badge-destructive"> {{ __("default.label.failed") }}</span>';
                    },
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
                                <div class="kt-menu-item" data-kt-menu-item-offset="0, 10px" data-kt-menu-item-placement="bottom-end" data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="hover">
                                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-dots-vertical text-lg"></i></button>
                                    <div class="kt-menu-dropdown kt-menu-default" data-kt-menu-dismiss="true">
                                        <div class="kt-menu-item"><a class="kt-menu-link" href="${url}/${row.id}"><span class="kt-menu-icon"><i class="ki-filled ki-search-list"></i></span><span class="kt-menu-title"> {{ __('default.label.view') }} </span></a></div>
                                        <div class="kt-menu-item"><a class="kt-menu-link" href="${url}/${row.id}/edit"><span class="kt-menu-icon"><i class="ki-filled ki-message-edit"></i></span><span class="kt-menu-title"> {{ __('default.label.edit') }} </span></a></div>
                                        <div class="kt-menu-item"><a class="kt-menu-link" id="single_delete" data-id="${row.id}"><span class="kt-menu-icon"><i class="ki-filled ki-trash-square"></i></span><span class="kt-menu-title"> {{ __('default.label.delete.delete') }} </span></a></div>
                                    </div>
                                </div>
                            </div>
                        </td>`;
                    }
                },
            ],


        });

        $('#export_copy').on('click', function(e) {
            e.preventDefault();
            table.button(1).trigger();
        });
        $('#export_csv').on('click', function(e) {
            e.preventDefault();
            table.button(1).trigger();
        });
        $('#export_print').on('click', function(e) {
            e.preventDefault();
            table.button(0).trigger();
        });

        $('#export_excel').on('click', function(e) {
            e.preventDefault();
            table.button(3).trigger();
        });
        $('#export_pdf').on('click', function() {

            let info = table.page.info();
            let columns = [];
            let selectedIds = [];

            $('#exilednoname_table thead th').each(function() {
                if (!$(this).hasClass('no-export')) {
                    columns.push($(this).text().trim());
                }
            });

            $('#exilednoname_table .checkable:checked').each(function() {
                selectedIds.push($(this).data('id'));
            });

            $.ajax({
                url: '{{ URL::Current() }}/export-users-pdf',
                method: 'POST',
                data: {
                    ids: selectedIds.join(','),
                    columns: columns,
                    length: info.length,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
            });

        });

        $('#perpage').on('change', function() {
            let perPage = $(this).val();
            table.page.len(perPage).draw();
        });

        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('.filter_active').on('change', function() {
            table.column('active:name').search(this.value).draw();
        });

        // FILTER DATE
        $('.filter_date').change(function() {
            $('#exilednoname_table').DataTable().draw();
        });

        table.on('draw.dt', function() {
            $('#checkbox_batch').addClass('hidden');
        });

        $("#toggle_filters").on("click", function() {
            if ($("#filters").hasClass("hidden")) {
                $('#filters').removeClass('hidden');
            } else {
                $('#filters').addClass('hidden');
            }
        });

    });

    // GROUP CHECKABLE
    $('#exilednoname_table').on('change', '.group-checkable', function() {
        var table = $('#exilednoname_table').DataTable();
        var checked = $(this).is(':checked');

        table.rows().every(function() {
            var $checkbox = $(this.node()).find('.checkable');
            $checkbox.prop('checked', checked);

            if (checked) {
                this.select();
            } else {
                this.deselect();
            }
        });

        var count = table.rows({
            selected: true
        }).count();
        $('#exilednoname_selected').html(count);

        if (count > 0) {
            KTToast.show({
                icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                progress: true,
                pauseOnHover: true,
                maxToasts: 3,
                position: 'bottom-end',
                variant: 'mono',
                message: "{{ __('default.notification.row_checked') }}",
            });
            $('#checkbox_batch').removeClass('hidden');
        } else {
            KTToast.show({
                icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                progress: true,
                pauseOnHover: true,
                maxToasts: 3,
                position: 'bottom-end',
                variant: 'mono',
                message: "{{ __('default.notification.row_unchecked') }}",
            });
            $('#checkbox_batch').addClass('hidden');
        }

    });

    // CHECKABLE
    $('#exilednoname_table').on('change', '.checkable', function() {
        var $row = $(this).closest('tr');
        var checkboxEl = document.querySelector('#check');
        if ($(this).is(':checked')) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        var checkedNodes = $('#exilednoname_table').DataTable().rows('.selected').nodes();
        var count = checkedNodes.length;
        $('#exilednoname_selected').html(count);
        if (count > 0) {
            $('#checkbox_batch').removeClass('hidden');
            checkboxEl.indeterminate = true;
        } else {
            $('#checkbox_batch').addClass('hidden');
            checkboxEl.indeterminate = false;
        }
    });

    // REFRESH TABLE
    $(".table_reload").on("click", function() {
        setTimeout(function() {
            $('#checkbox_batch').addClass('hidden');
            $('.filter_form').val('');
            $('#exilednoname_table').DataTable().search('').columns().search('').draw();
            $('#exilednoname_table').DataTable().ajax.reload();
            KTToast.show({
                icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                progress: true,
                pauseOnHover: true,
                maxToasts: 3,
                position: 'bottom-end',
                variant: 'mono',
                message: "{{ __('default.notification.table_reload') }}",
            });
        }, 500);
    });

    // RESET TABLE
    $(".reset").on("click", function() {
        setTimeout(function() {
            $('#checkbox_batch').addClass('hidden');
            $('.filter_form').val('');
            $('#exilednoname_table').DataTable().search('').columns().search('').draw();
            $('#exilednoname_table').DataTable().ajax.reload();
        }, 500);
    });
</script>

<script>
    $('body').on('click', '#table_active', function() {
        var id = $(this).data("id");
        $.ajax({
            type: "get",
            url: "{{ URL::Current() }}/active/" + id,
            processing: true,
            serverSide: true,
            success: function(data) {
                $('#exilednoname_table').DataTable().draw(false);
                KTToast.show({
                    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                    progress: true,
                    pauseOnHover: true,
                    maxToasts: 3,
                    position: 'bottom-end',
                    variant: 'mono',
                    message: "{{ __('default.notification.success.item_active') }}",
                });
            },
            error: function(data) {
                KTToast.show({
                    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                    progress: true,
                    pauseOnHover: true,
                    maxToasts: 3,
                    position: 'bottom-end',
                    variant: 'mono',
                    message: "{{ __('default.notification.error.error') }}",
                }, 500);
            }
        });
    });

    $('body').on('click', '#table_inactive', function() {
        var id = $(this).data("id");
        $.ajax({
            type: "get",
            url: "{{ URL::Current() }}/inactive/" + id,
            processing: true,
            serverSide: true,
            success: function(data) {
                if (data.status && data.status === 'error') {
                    toastr.error(data.message);
                    return;
                }

                $('#exilednoname_table').DataTable().draw(false);
                KTToast.show({
                    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                    progress: true,
                    pauseOnHover: true,
                    maxToasts: 3,
                    position: 'bottom-end',
                    variant: 'mono',
                    message: "{{ __('default.notification.success.item_inactive') }}",
                }, 500);
            },
            error: function(data) {
                KTToast.show({
                    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                    progress: true,
                    pauseOnHover: true,
                    maxToasts: 3,
                    position: 'bottom-end',
                    variant: 'mono',
                    message: "{{ __('default.notification.error.error') }}",
                }, 500);
            }
        });
    });

    $('body').on('click', '#single_delete', function() {
        var id = $(this).data("id");
        Swal.fire({
            text: "{{ __('default.notification.confirm.delete') }}?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{ __('default.label.yes') }}",
            cancelButtonText: "{{ __('default.label.no') }}",
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: "{{ URL::Current() }}/delete/" + id,
                    success: function(data) {
                        if (data.status && data.status === 'error') {
                            toastr.error(data.message);
                            return;
                        }

                        $('#exilednoname_table').DataTable().draw(false);
                        KTToast.show({
                            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                            progress: true,
                            pauseOnHover: true,
                            maxToasts: 3,
                            position: 'bottom-end',
                            variant: 'mono',
                            message: "{{ __('default.notification.success.item_deleted') }}",
                        }, 500);

                    },
                    error: function(data) {
                        KTToast.show({
                            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                            progress: true,
                            pauseOnHover: true,
                            maxToasts: 3,
                            position: 'bottom-end',
                            variant: 'mono',
                            message: "{{ __('default.notification.error.error') }}",
                        }, 500);
                    }
                });
            }
        });
    });

    // SELECTED ACTIVE
    $('#selected-active').on('click', function(e) {
        var exilednonameArr = [];
        $(".checkable:checked").each(function() {
            exilednonameArr.push($(this).attr('data-id'));
        });
        var strEXILEDNONAME = exilednonameArr.join(",");
        Swal.fire({
            text: "{{ __('default.notification.confirm.selected_active') }}?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{ __('default.label.yes') }}",
            cancelButtonText: "{{ __('default.label.no') }}",
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "{{ URL::Current() }}/selected-active",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'EXILEDNONAME=' + strEXILEDNONAME,
                    success: function(data) {
                        if (data.status && data.status === 'error') {
                            toastr.error(data.message);
                            return;
                        }

                        $('#checkbox_batch').addClass('hidden');
                        $('#exilednoname_table').DataTable().draw(false);
                        KTToast.show({
                            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                            progress: true,
                            pauseOnHover: true,
                            maxToasts: 3,
                            position: 'bottom-end',
                            variant: 'mono',
                            message: "{{ __('default.notification.success.selected_active') }}",
                        }, 500);
                    },
                    error: function(data) {
                        KTToast.show({
                            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                            progress: true,
                            pauseOnHover: true,
                            maxToasts: 3,
                            position: 'bottom-end',
                            variant: 'mono',
                            message: "{{ __('default.notification.error.error') }}",
                        }, 500);
                    }
                });
            }
        });
    });

    // SELECTED INACTIVE
    $('#selected-inactive').on('click', function(e) {
        var exilednonameArr = [];
        $(".checkable:checked").each(function() {
            exilednonameArr.push($(this).attr('data-id'));
        });
        var strEXILEDNONAME = exilednonameArr.join(",");
        Swal.fire({
            text: "{{ __('default.notification.confirm.selected_inactive') }}?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{ __('default.label.yes') }}",
            cancelButtonText: "{{ __('default.label.no') }}",
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "{{ URL::Current() }}/selected-inactive",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'EXILEDNONAME=' + strEXILEDNONAME,
                    success: function(data) {
                        if (data.status && data.status === 'error') {
                            toastr.error(data.message);
                            return;
                        }
                        $('#checkbox_batch').addClass('hidden');
                        $('#exilednoname_table').DataTable().draw(false);
                        KTToast.show({
                            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                            progress: true,
                            pauseOnHover: true,
                            maxToasts: 3,
                            position: 'bottom-end',
                            variant: 'mono',
                            message: "{{ __('default.notification.success.selected_inactive') }}",
                        }, 500);
                    },
                    error: function(data) {
                        KTToast.show({
                            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                            progress: true,
                            pauseOnHover: true,
                            maxToasts: 3,
                            position: 'bottom-end',
                            variant: 'mono',
                            message: "{{ __('default.notification.error.error') }}",
                        }, 500);
                    }
                });
            }
        });
    });

    // SELECTED DELETE
    $('#selected-delete').on('click', function(e) {
        var exilednonameArr = [];
        $(".checkable:checked").each(function() {
            exilednonameArr.push($(this).attr('data-id'));
        });
        var strEXILEDNONAME = exilednonameArr.join(",");
        Swal.fire({
            text: "{{ __('default.notification.confirm.selected_delete') }}?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{ __('default.label.yes') }}",
            cancelButtonText: "{{ __('default.label.no') }}",
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "{{ URL::Current() }}/selected-delete",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'EXILEDNONAME=' + strEXILEDNONAME,
                    success: function(data) {
                        if (data.status && data.status === 'error') {
                            toastr.error(data.message);
                            return;
                        }
                        $('#checkbox_batch').addClass('hidden');
                        $('#exilednoname_table').DataTable().draw(false);
                        KTToast.show({
                            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                            progress: true,
                            pauseOnHover: true,
                            maxToasts: 3,
                            position: 'bottom-end',
                            variant: 'mono',
                            message: "{{ __('default.notification.success.selected_inactive') }}",
                        }, 500);
                    },
                    error: function(data) {
                        KTToast.show({
                            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`,
                            progress: true,
                            pauseOnHover: true,
                            maxToasts: 3,
                            position: 'bottom-end',
                            variant: 'mono',
                            message: "{{ __('default.notification.error.error') }}",
                        }, 500);
                    }
                });
            }
        });
    });
</script>
@endpush