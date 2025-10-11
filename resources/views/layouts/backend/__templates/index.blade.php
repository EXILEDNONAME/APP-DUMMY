@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.main') }} </h3>
                <div class="kt-menu">
                    <a href="{{ URL::Current() }}/create"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_create" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-plus"></i></button></a>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost table_reload" data-kt-tooltip="#tooltip_reload" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-arrows-circle"></i></button>
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

                    <select class="kt-select filter_form table_filter_active">
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

                    @if (!empty($date) && $date == 'true')
                    <input id="datepicker" name="date" class="kt-input filter_form table_filter_date" placeholder="- Select Date -" />
                    @endif
                    <input type="text" id="dateRange" class="kt-input filter_form" placeholder="- Select Daterange -">
                    <button class="kt-menu-toggle kt-btn kt-btn-primary kt-btn-sm table_reset_filter"> {{ __('default.label.reset') }} </button>


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
                                @if (!empty($status) && $status == 'true') <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-semibold text-sm"> Status </span><span class="kt-table-col-sort"></span></span></th> @endif
                                @if (!empty($file) && $file == 'true') <th class="w-px whitespace-nowrap no-export"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-semibold text-sm"> File </span></span></th> @endif
                                @if (!empty($date) && $date == 'true') <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> Date </span><span class="kt-table-col-sort"></span></span></th> @endif
                                @if (!empty($daterange) && $daterange == 'true') 
                                <th class="w-px whitespace-nowrap"> <span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.date_start') }} </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-px whitespace-nowrap"> <span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.date_end') }} </span><span class="kt-table-col-sort"></span></span></th>
                                @endif
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
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/exilednoname-dt-index.js"></script>

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