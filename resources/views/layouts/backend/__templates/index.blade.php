@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.main') }} </h3>
                <div class="kt-menu">
                    <a href="{{ URL::Current() }}/create"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_create" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-plus"></i></button></a>
                    <button id="table_reload" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_reload" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-arrows-circle"></i></button>
                    <button id="toggle_filters" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_filter" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-setting-4"></i></button>
                    <div class="inline-flex" data-kt-dropdown="true" data-kt-dropdown-trigger="hover" data-kt-dropdown-placement="bottom-end">
                        <div class="kt-menu" data-kt-menu="true">
                            <div class="kt-menu-item" data-kt-menu-item-placement="bottom-end" data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="hover">
                                <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_export" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-exit-down"></i></button>
                                <div class="kt-menu-dropdown kt-menu-default" data-kt-menu-dismiss="true">
                                    <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_copy" data-kt-tooltip-placement="top-end"><a id="export_copy" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-copy"></i></span><span class="kt-menu-title"> {{ __('default.label.export.copy') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_csv" data-kt-tooltip-placement="top-end"><a id="export_csv" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-notepad"></i></span><span class="kt-menu-title"> {{ __('default.label.export.csv') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_excel" data-kt-tooltip-placement="top-end"><a id="export_excel" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-tablet-text-up"></i></span><span class="kt-menu-title"> {{ __('default.label.export.excel') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_pdf" data-kt-tooltip-placement="top-end"><a id="export_pdf" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-document"></i></span><span class="kt-menu-title"> {{ __('default.label.export.pdf') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-tooltip="#tooltip_export_description_print" data-kt-tooltip-placement="top-end"><a id="export_print" class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-printer"></i></span><span class="kt-menu-title"> {{ __('default.label.export.print') }} </span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inline-flex" data-kt-dropdown="true" data-kt-dropdown-trigger="hover" data-kt-dropdown-placement="bottom-end">
                        <div class="kt-menu" data-kt-menu="true">
                            <div class="kt-menu-item" data-kt-menu-item-placement="bottom-end" data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="hover">
                                <button id="checkbox_batch" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost hidden" data-kt-tooltip="#tooltip_batch_action" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-dots-vertical"></i></button>
                                <div class="kt-menu-dropdown kt-menu-default" data-kt-menu-dismiss="true">
                                    <div class="kt-menu-item" data-kt-modal-toggle="#modalSelectedActive"><a class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-check"></i></span><span class="kt-menu-title"> {{ __('default.label.active') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-modal-toggle="#modalSelectedInactive"><a class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-cross"></i></span><span class="kt-menu-title"> {{ __('default.label.inactive') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-modal-toggle="#modalSelectedDelete"><a class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-trash"></i></span><span class="kt-menu-title"> {{ __('default.label.delete.delete') }} </span></a></div>
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
                        <input id="table_search" class="filter_form" placeholder="{{ __('default.label.search') }}" type="text" />
                    </label>

                    <select class="kt-select filter_form filter_active">
                        <option value=""> - {{ __('default.select.active') }} - </option>
                        <option value="1"> {{ __('default.label.yes') }} </option>
                        <option value="0"> {{ __('default.label.no') }} </option>
                    </select>

                    @if (!empty($status) && $status == 'true')
                    <select class="kt-select filter_form filter_status">
                        <option value=""> - {{ __('default.select.status') }} - </option>
                        @foreach ($attributes as $key => $label)
                        <option value="{{ $key }}">
                            {{ __('default.label.' . strtolower($label)) }}
                        </option>
                        @endforeach
                    </select>
                    @endif

                    <!-- <div class="flex items-center">
                        <div class="kt-form-control flex-1">
                            <select class="kt-select filter_form">
                                <option value="">- {{ __('default.select.status') }} -</option>
                                <option value="1"> {{ __('default.label.yes') }} </option>
                                <option value="2"> {{ __('default.label.no') }} </option>
                            </select>
                        </div>
                    </div> -->

                    @if (!empty($date) && $date == 'true')
                    <input id="datepicker" name="date" class="kt-input filter_form filter_date" placeholder="- Select Date -" />
                    @endif
                    <button class="kt-menu-toggle kt-btn kt-btn-primary kt-btn-sm reset" data-kt-tooltip="#tooltip_reset" data-kt-tooltip-placement="top-end"> {{ __('default.label.reset') }} </button>

                </div>
            </div>

            <div class="kt-card-content">
                <div class="kt-scrollable-x-hover" style="padding-bottom: 1px;">

                    <table id="exilednoname_table" class="kt-table" width="100%">
                        <thead>
                            <tr>
                                <th class="w-px whitespace-nowrap no-export"></th>
                                <th style="display: none"> {{ __('default.label.created_at') }} </th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-semibold text-sm"> No. </span></span></th>
                                @if (!empty($status) && $status == 'true') <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-semibold text-sm"> Status </span></span></th> @endif
                                @if (!empty($file) && $file == 'true') <th class="w-px whitespace-nowrap no-export"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-semibold text-sm"> File </span></span></th> @endif
                                @if (!empty($date) && $date == 'true') <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> Date </span><span class="kt-table-col-sort"></span></span></th> @endif
                                @yield('table-header')
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-semibold text-sm"> Active </span></span></th>
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

<div class="lg:col-span-1">
    <div class="grid">
        <div id="printData">
            <div class="kt-card kt-card-grid w-full">
                <div class="kt-card-header">
                    <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.activities') }} </h3>
                    <div class="kt-menu" data-kt-menu="true">
                        <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_print" data-kt-tooltip-placement="top-end" onclick="printData('printData')"><i class="ki-filled ki-printer"></i></button>
                    </div>
                </div>
                <div class="kt-card-body p-1 w-full">
                    <div class="kt-scrollable-x-auto"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (!empty($charts) && $charts == 'true')
<div class="lg:col-span-2">
    <div class="grid">
        <div class="kt-card kt-card-grid w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.charts') }} </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_print" data-kt-tooltip-placement="top-end" onclick="printDataCharts('printDataCharts')"><i class="ki-filled ki-printer"></i></button>
                </div>
            </div>
            <div id="printDataCharts">
                <div class="kt-card-body p-1 w-full">
                    <div id="area_chart" class="w-full"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="kt-modal" data-kt-modal="true" id="modalDelete">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header items-center justify-center">
            <h3 class="kt-modal-title text-sm"> Are You Sure Delete This Item? </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-delete"> Yes </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> Cancel </button>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalSelectedActive">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header items-center justify-center">
            <h3 class="kt-modal-title text-sm"> Are You Sure Set Active This Selected Item? </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-selected-active"> Yes </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> Cancel </button>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalSelectedInactive">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header items-center justify-center">
            <h3 class="kt-modal-title text-sm"> Are You Sure Set Inactive This Selected Item? </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-selected-inactive"> Yes </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> Cancel </button>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalSelectedDelete">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header items-center justify-center">
            <h3 class="kt-modal-title text-sm"> Are You Sure Delete This Selected Item? </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-selected-delete"> Yes </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> Cancel </button>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/exilednoname-dt-plugins.js"></script>

<!-- <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script> -->

<script src="{{ env('APP_URL') }}/assets/backend/mix/js/exilednoname-dt-index.js"></script>
<script>
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
</script>

@if (!empty($charts) && $charts == 'true')
<script src="{{ env('APP_URL') }}/assets/backend/vendors/apexcharts/apexcharts.min.js"></script>
<script>
    fetch(this_url + '/chart')
        .then(response => response.json())
        .then(data => {
            const created = data.created;
            const updated = data.updated;
            const deleted = data.deleted;
            const categories = [
                "{{ __('default.month.january') }}",
                "{{ __('default.month.february') }}",
                "{{ __('default.month.march') }}",
                "{{ __('default.month.april') }}",
                "{{ __('default.month.may') }}",
                "{{ __('default.month.june') }}",
                "{{ __('default.month.july') }}",
                "{{ __('default.month.august') }}",
                "{{ __('default.month.september') }}",
                "{{ __('default.month.october') }}",
                "{{ __('default.month.november') }}",
                "{{ __('default.month.december') }}",
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
                    show: false,
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
                    tickAmount: 5,
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
        })

    function printDataCharts(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endif

@endpush