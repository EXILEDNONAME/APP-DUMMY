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
                        <input id="table_search" class="filter_form" placeholder="Search" type="text" />
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

                    @if (!empty($date) && $date == 'true')
                    <input id="datepicker" name="date" class="kt-input filter_form filter_date" placeholder="- Select Date -" />
                    @endif
                    <button class="kt-menu-toggle kt-btn kt-btn-primary kt-btn-sm reset" data-kt-tooltip="#tooltip_reset" data-kt-tooltip-placement="top-end"> {{ __('default.label.reset') }} </button>

                </div>

                <div class="kt-card-footer justify-center"></div>
            </div>

            <div class="kt-card-content">
                <div class="kt-scrollable-x-hover" style="padding-bottom: 1px;">

                    <table id="exilednoname_table" class="kt-table" width="100%">
                        <thead>
                            <tr>
                                <th class="w-px whitespace-nowrap no-export"></th>
                                <th style="display: none"> {{ __('default.label.created_at') }} </th>
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label kt-card-title text-sm"> No. </span></span></th>
                                @if (!empty($status) && $status == 'true') <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label kt-card-title text-sm"> Status </span></span></th> @endif
                                @if (!empty($file) && $file == 'true') <th class="w-px whitespace-nowrap no-export"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label kt-card-title text-sm"> File </span></span></th> @endif
                                @if (!empty($date) && $date == 'true') <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Date </span><span class="kt-table-col-sort"></span></span></th> @endif
                                @yield('table-header')
                                <th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-center"><span class="kt-table-col-label kt-card-title text-sm"> Active </span></span></th>
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
                <h3 class="kt-card-title text-sm grid gap-5"> Charts </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <a href="{{ URL::Current() }}/edit"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_edit" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-pencil"></i></button></a>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_print" data-kt-tooltip-placement="top-end" onclick="printDataCharts('printDataCharts')"><i class="ki-filled ki-printer"></i></button>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" class="kt-btn" data-kt-modal-toggle="#modalScan" data-kt-tooltip="#tooltip_qrcode" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-scan-barcode"></i></button>
                    <div id="tooltip_qrcode" class="kt-tooltip"> QR Code </div>
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
@endsection

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/datatable-plugins.js"></script>
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/datatable-index.js"></script>

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

<script>
    ! function(t, e) {
        "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : t.lozad = e()
    }(this, function() {
        "use strict";
        var g = "undefined" != typeof document && document.documentMode,
            f = {
                rootMargin: "0px",
                threshold: 0,
                load: function(t) {
                    if ("picture" === t.nodeName.toLowerCase()) {
                        var e = t.querySelector("img"),
                            r = !1;
                        null === e && (e = document.createElement("img"), r = !0), g && t.getAttribute("data-iesrc") && (e.src = t.getAttribute("data-iesrc")), t.getAttribute("data-alt") && (e.alt = t.getAttribute("data-alt")), r && t.append(e)
                    }
                    if ("video" === t.nodeName.toLowerCase() && !t.getAttribute("data-src") && t.children) {
                        for (var a = t.children, o = void 0, i = 0; i <= a.length - 1; i++)(o = a[i].getAttribute("data-src")) && (a[i].src = o);
                        t.load()
                    }
                    t.getAttribute("data-poster") && (t.poster = t.getAttribute("data-poster")), t.getAttribute("data-src") && (t.src = t.getAttribute("data-src")), t.getAttribute("data-srcset") && t.setAttribute("srcset", t.getAttribute("data-srcset"));
                    var n = ",";
                    if (t.getAttribute("data-background-delimiter") && (n = t.getAttribute("data-background-delimiter")), t.getAttribute("data-background-image")) t.style.backgroundImage = "url('" + t.getAttribute("data-background-image").split(n).join("'),url('") + "')";
                    else if (t.getAttribute("data-background-image-set")) {
                        var d = t.getAttribute("data-background-image-set").split(n),
                            u = d[0].substr(0, d[0].indexOf(" ")) || d[0]; // Substring before ... 1x
                        u = -1 === u.indexOf("url(") ? "url(" + u + ")" : u, 1 === d.length ? t.style.backgroundImage = u : t.setAttribute("style", (t.getAttribute("style") || "") + "background-image: " + u + "; background-image: -webkit-image-set(" + d + "); background-image: image-set(" + d + ")")
                    }
                    t.getAttribute("data-toggle-class") && t.classList.toggle(t.getAttribute("data-toggle-class"))
                },
                loaded: function() {}
            };

        function A(t) {
            t.setAttribute("data-loaded", !0)
        }
        var m = function(t) {
                return "true" === t.getAttribute("data-loaded")
            },
            v = function(t) {
                var e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : document;
                return t instanceof Element ? [t] : t instanceof NodeList ? t : e.querySelectorAll(t)
            };
        return function() {
            var r, a, o = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : ".lozad",
                t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                e = Object.assign({}, f, t),
                i = e.root,
                n = e.rootMargin,
                d = e.threshold,
                u = e.load,
                g = e.loaded,
                s = void 0;
            "undefined" != typeof window && window.IntersectionObserver && (s = new IntersectionObserver((r = u, a = g, function(t, e) {
                t.forEach(function(t) {
                    (0 < t.intersectionRatio || t.isIntersecting) && (e.unobserve(t.target), m(t.target) || (r(t.target), A(t.target), a(t.target)))
                })
            }), {
                root: i,
                rootMargin: n,
                threshold: d
            }));
            for (var c, l = v(o, i), b = 0; b < l.length; b++)(c = l[b]).getAttribute("data-placeholder-background") && (c.style.background = c.getAttribute("data-placeholder-background"));
            return {
                observe: function() {
                    for (var t = v(o, i), e = 0; e < t.length; e++) m(t[e]) || (s ? s.observe(t[e]) : (u(t[e]), A(t[e]), g(t[e])))
                },
                triggerLoad: function(t) {
                    m(t) || (u(t), A(t), g(t))
                },
                observer: s
            }
        }
    });

    $(document).on('shown.bs.modal', '.kt-modal', function() {
        $(this).find('img.lazy-img').each(function() {
            var $img = $(this);
            var realSrc = $img.attr('data-src');
            var currentSrc = $img.attr('src');

            if (realSrc && currentSrc !== realSrc) {
                $img.attr('src', realSrc);
            }
        });
    });
</script>
@endpush