@extends('layouts.backend.default')

@section('content')
@stack('widget-top')
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
                                    <div class="kt-menu-item" data-kt-modal-toggle="#modalSelectedActive"><a class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-check"></i></span><span class="kt-menu-title"> {{ __('default.selected.active') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-modal-toggle="#modalSelectedInactive"><a class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-cross"></i></span><span class="kt-menu-title"> {{ __('default.selected.inactive') }} </span></a></div>
                                    <div class="kt-menu-item" data-kt-modal-toggle="#modalSelectedDelete"><a class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-trash"></i></span><span class="kt-menu-title"> {{ __('default.selected.delete') }} </span></a></div>
                                    @if(!empty($extension) && $extension == 'management-users')
                                    <div class="kt-menu-item" data-kt-modal-toggle="#modalSelectedResetPassword"><a class="kt-menu-link"><span class="kt-menu-icon"><i class="ki-filled ki-key"></i></span><span class="kt-menu-title"> {{ __('default.selected.reset_password') }} </span></a></div>
                                    @endif
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

                    @if (!empty($active) && $active == 'true')
                    <select class="kt-select filter_form table_filter_active">
                        <option value=""> - {{ __('default.select.active') }} - </option>
                        <option value="1"> {{ __('default.label.yes') }} </option>
                        <option value="0"> {{ __('default.label.no') }} </option>
                    </select>
                    @endif

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

                    @if (!empty($daterange) && $daterange == 'true')
                    <input type="text" id="dateRange" class="kt-input filter_form" placeholder="- Select Daterange -">
                    @endif

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
                                @if (!empty($status) && $status == 'true') <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.status') }} </span><span class="kt-table-col-sort"></span></span></th> @endif
                                @if (!empty($file) && $file == 'true') <th class="w-px whitespace-nowrap no-export"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.file') }} </span></span></th> @endif
                                @if (!empty($date) && $date == 'true') <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.date') }} </span><span class="kt-table-col-sort"></span></span></th> @endif
                                @if (!empty($daterange) && $daterange == 'true')
                                <th class="w-px whitespace-nowrap"> <span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.date_start') }} </span><span class="kt-table-col-sort"></span></span></th>
                                <th class="w-px whitespace-nowrap"> <span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.date_end') }} </span><span class="kt-table-col-sort"></span></span></th>
                                @endif
                                @yield('table-header')
                                @if(!empty($active) && $active == 'true')
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label font-semibold text-sm"> {{ __('default.label.active') }} </span></span></th>
                                @endif
                                <th class="w-px whitespace-nowrap no-export"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="kt-card-footer flex flex-col md:flex-row justify-center md:justify-between gap-5 text-secondary-foreground text-sm font-medium">
                <div class="flex items-center gap-2 order-2 md:order-1">
                    <label for="perpage" class="text-sm"> {{ __('default.label.show') }} </label>
                    <select id="perpage" class="kt-select w-16 border rounded px-2 py-1">
                        <option value="25" selected> 25 </option>
                        <option value="100"> 100 </option>
                        <option value="250"> 250 </option>
                        <option value="500"> 500 </option>
                    </select>
                    <span class="text-sm"> {{ __('default.label.entries') }} </span>
                </div>
                <div class="flex items-center gap-2 order-1 md:order-2">
                    <div id="kt-pagination" class="kt-datatable-pagination" data-kt-datatable-pagination="true"></div>
                </div>
            </div>

        </div>
    </div>
</div>

@if (!empty($activities) && $activities == 'true')
<div class="lg:col-span-1">
    <div class="grid">
        <div id="printDataActivities">
            <div class="kt-card kt-card-grid w-full">
                <div class="kt-card-header">
                    <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.activities') }} </h3>
                    <div class="kt-menu" data-kt-menu="true">
                        <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_print" data-kt-tooltip-placement="top-end" onclick="printData('printDataActivities')"><i class="ki-filled ki-printer"></i></button>
                    </div>
                </div>
                <div class="kt-card-body p-1 w-full">
                    <div class="kt-scrollable-x-auto">
                        <div class="kt-card-content lg:p-7.5 lg:pt-6 p-5">
                            <div class="flex flex-col" bis_skin_checked="1">

                                @php $activity = activities($model)->take(5); @endphp
                                <div class="flex flex-col">
                                    @foreach($activity as $acts)
                                    @php
                                    $props = json_decode($acts->properties, true) ?? [];
                                    $isRestored = $acts->description === 'updated' && ($props['attributes']['deleted_at'] ?? null) === null && !empty($props['old']['deleted_at']);
                                    @endphp

                                    <div class="flex items-start relative">
                                        @unless($loop->last)
                                        <div class="w-9 start-0 top-9 absolute bottom-0 rtl:-translate-x-1/2 translate-x-1/2 border-s border-s-input"></div>
                                        @endunless

                                        <div class="flex items-center justify-center shrink-0 rounded-full bg-accent/60 border border-input size-9 text-secondary-foreground">
                                            @if ($acts->description == 'created') <i class="ki-filled ki-plus"></i>
                                            @elseif ($isRestored) <i class="ki-filled ki-arrows-circle"></i>
                                            @elseif ($acts->description == 'updated') <i class="ki-filled ki-pencil"></i>
                                            @elseif ($acts->description == 'deleted') <i class="ki-filled ki-trash"></i>
                                            @endif
                                        </div>

                                        <div class="ps-2.5 text-base grow {{ !$loop->last ? 'mb-7' : '' }}">
                                            <div class="flex flex-col">
                                                <div class="text-sm text-foreground whitespace-nowrap">
                                                    @if ($acts->description == 'created')
                                                    {{ __('default.activity.item-created') }} {{ mb_strimwidth($props['attributes']['name'] ?? $data_object['name'] ?? '', 0, 10, ' ...') }}
                                                    @elseif ($isRestored)
                                                    {{ __('default.activity.item-restored') }} {{ mb_strimwidth($props['attributes']['name'] ?? '', 0, 10, ' ...') }}
                                                    @elseif ($acts->description == 'updated')
                                                    {{ __('default.activity.item-updated') }} {{ $props['attributes']['name'] }}
                                                    @elseif ($acts->description == 'deleted')
                                                    {{ __('default.activity.item-deleted') }} {{ mb_strimwidth($props['attributes']['name'] ?? '', 0, 10, ' ...') }}
                                                    @endif
                                                </div>
                                                <span class="text-xs text-secondary-foreground">
                                                    {{ $acts->created_at->diffForHumans() }}, {{ $acts->causer->name }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if (!empty($charts) && $charts == 'true')
<div class="lg:col-span-2">
    <div class="grid">
        <div id="printDataCharts">
            <div class="kt-card kt-card-grid w-full">
                <div class="kt-card-header">
                    <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.charts') }} </h3>
                    <div class="kt-menu" data-kt-menu="true">
                        <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_print" data-kt-tooltip-placement="top-end" onclick="printDataCharts('printDataCharts')"><i class="ki-filled ki-printer"></i></button>
                    </div>
                </div>
                <div class="kt-card-body p-1 w-full">
                    <div id="area_chart" class="w-full"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@stack('widget-bottom')

<!-- MODAL -->
<div class="kt-modal" data-kt-modal="true" id="modalDelete">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.notification.confirm.delete') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-delete"> {{ __('default.label.yes') }} </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.cancel') }} </button>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalSelectedActive">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.notification.confirm.selected_active') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-selected-active"> {{ __('default.label.yes') }} </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.cancel') }} </button>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalSelectedInactive">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.notification.confirm.selected_inactive') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-selected-inactive"> {{ __('default.label.yes') }} </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.cancel') }} </button>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalSelectedDelete">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.notification.confirm.selected_delete') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-selected-delete"> {{ __('default.label.yes') }} </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.cancel') }} </button>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalResetPassword">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.notification.confirm.reset_password') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-reset-password"> {{ __('default.label.yes') }} </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.cancel') }} </button>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalSelectedResetPassword">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.label.are_you_sure') }} <br>
                {{ __('default.notification.confirm.selected_reset_password') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-selected-reset-password"> {{ __('default.label.yes') }} </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.cancel') }} </button>
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
    fetch(this_url + '/chart').then(response => response.json()).then(data => {
        const created = data.created;
        const updated = data.updated;
        const deleted = data.deleted;
        const categories = [
            translations.default.month.january,
            translations.default.month.february,
            translations.default.month.march,
            translations.default.month.april,
            translations.default.month.may,
            translations.default.month.june,
            translations.default.month.july,
            translations.default.month.august,
            translations.default.month.september,
            translations.default.month.october,
            translations.default.month.november,
            translations.default.month.december,
        ];

        const options = {
            series: [{
                    name: translations.default.label.created,
                    data: created
                },
                {
                    name: translations.default.label.updated,
                    data: updated,
                },
                {
                    name: translations.default.label.deleted,
                    data: deleted,
                },
            ],
            chart: {
                height: 331,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ['var(--color-green-500)', 'var(--color-yellow-500)', 'var(--color-destructive)'],
            legend: {
                show: false
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: ['var(--color-green-500)', 'var(--color-yellow-500)', 'var(--color-destructive)']
            },
            xaxis: {
                categories: categories,
                axisBorder: {
                    show: false
                },
                maxTicks: 12,
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: 'var(--color-secondary-foreground)',
                        fontSize: '12px'
                    }
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
                    enabled: true,
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
                borderColor: 'var(--color-mono)',
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
</script>
@endif

@endpush