@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-2">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> Details </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <a href="{{ URL::Current() }}/edit"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_edit" data-kt-tooltip-placement="bottom-start"><i class="ki-filled ki-pencil"></i></button></a>
                    <div id="tooltip_edit" class="kt-tooltip"> Edit </div>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_print" data-kt-tooltip-placement="bottom-start"><i class="ki-filled ki-printer"></i></button>
                    <div id="tooltip_print" class="kt-tooltip"> Print </div>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" class="kt-btn" data-kt-modal-toggle="#modalScan" data-kt-tooltip="#tooltip_qrcode" data-kt-tooltip-placement="bottom-start"><i class="ki-filled ki-scan-barcode"></i></button>
                    <div id="tooltip_qrcode" class="kt-tooltip"> QR Code </div>

                    <form method="POST" action="{{ URL::current() }}/../{{ $data->id }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        @method('DELETE')
                        @csrf
                        <button id="delete" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-trash"></i></button>
                    </form>

                    <a href="{{ $url }}"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_back" data-kt-tooltip-placement="bottom-start"><i class="ki-filled ki-black-right-line"></i></button></a>
                    <div id="tooltip_back" class="kt-tooltip"> Back </div>
                </div>
            </div>
            <div class="kt-card-body p-1">
                <div class="kt-scrollable overflow-x-auto">
                    <table id="serverTable" class="kt-table w-full">
                        @if(!empty($data->file))
                        <tr>
                            <td> {{ __('default.label.file') }} </td>
                            <td class="">
                                <a href="javascript:void(0);" data-kt-modal-toggle="#modalPicture" data-kt-tooltip="#tooltip_preview" data-kt-tooltip-placement="bottom-start"><i class="ki-filled ki-picture"></i></a>
                                <div id="tooltip_preview" class="kt-tooltip"> Preview </div>
                                <div class="kt-modal" data-kt-modal="true" id="modalPicture">
                                    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
                                        <div class="kt-modal-header">
                                            <h3 class="kt-modal-title text-sm"> Preview </h3>
                                            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true"><i class="ki-filled ki-cross"></i></button>
                                        </div>
                                        <div class="kt-modal-body grid gap-5 px-0 py-5">
                                            <div class="flex flex-col items-center px-5 gap-2.5">
                                                <img data-src="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" class="lazy-img" loading="lazy" alt="Preview">
                                            </div>
                                        </div>
                                        <div class="kt-modal-footer">
                                            <div></div>
                                            <div class="flex gap-2">
                                                <a href="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" download="{{ $data->file }}"><button class="kt-btn kt-btn-sm"><i class="ki-filled ki-cloud-download"></i> Download </button></a>
                                                <button class="kt-btn kt-btn-sm kt-btn-mono" data-kt-modal-dismiss="#modal"> Close </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @endif

                        @if(!empty($data->date))
                        <tr>
                            <td class="align-middle font-weight-bold"> {{ __('default.label.date') }} </td>
                            <td> {{ !empty($data->date) ? \Carbon\Carbon::parse($data->date)->format('d F Y') : '-' }} </td>
                        </tr>
                        @endif
                        @if(!empty($data->date_start))
                        <tr>
                            <td class="align-middle font-weight-bold"> {{ __('default.label.date-start') }} </td>
                            <td> {{ !empty($data->date_start) ? \Carbon\Carbon::parse($data->date_start)->format('d F Y') : '-' }} </td>
                        </tr>
                        @endif
                        @if(!empty($data->date_end))
                        <tr>
                            <td class="align-middle font-weight-bold"> {{ __('default.label.date-end') }} </td>
                            <td> {{ !empty($data->date_end) ? \Carbon\Carbon::parse($data->date_end)->format('d F Y') : '-' }} </td>
                        </tr>
                        @endif
                        @yield('table-header')
                        <tr>
                            <td class="align-middle font-weight-bold"> {{ __('default.label.active') }} </td>
                            <td> {{ $data->active == 1 ? __('default.label.yes') : __('default.label.no') }} </td>
                        </tr>
                        <tr>
                            <td class="align-middle font-weight-bold"> {{ __('default.label.status') }} </td>
                            <td>
                                @if( $data->status == 1 ) <strong><span class="text-dark"> {{ __('default.label.default') }} </span></strong>
                                @elseif( $data->status == 2 ) <span class="text-yellow-600"> {{ __('default.label.pending') }} </span>
                                @elseif( $data->status == 3 ) <strong><span class="text-info"> {{ __('default.label.progress') }} </span></strong>
                                @elseif( $data->status == 4 ) <strong><span class="text-success"> {{ __('default.label.success') }} </span></strong>
                                @elseif( $data->status == 5 ) <strong><span class="text-danger"> {{ __('default.label.failed') }} </span></strong>
                                @else {{ __('default.label.unknown') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td> {{ __('default.label.created_at') }} </td>
                            <td class="text-nowrap">
                                <div class="overflow-x-auto">
                                    {{ \Carbon\Carbon::parse($data->created_at)->format('d F Y, H:i') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle font-weight-bold"> {{ __('default.label.updated_at') }} </td>
                            <td> {{ \Carbon\Carbon::parse($data->updated_at)->format('d F Y, H:i') }} </td>
                        </tr>
                        @if(!empty($data->created_by))
                        <tr>
                            <td class="align-middle font-weight-bold"> {{ __('default.label.created_by') }} </td>
                            <td> {{ \DB::table('users')->where('id', $data->created_by)->first()->name ?? '-' }} </td>
                        </tr>
                        @endif
                        @if(!empty($data->updated_by))
                        <tr>
                            <td class="align-middle font-weight-bold whitespace-nowrap"> {{ __('default.label.last_updated_by') }} </td>
                            <td class="text-nowrap"> {{ \DB::table('users')->where('id', $data->updated_by)->first()->name ?? '-' }} </td>
                        </tr>
                        @endif
                        <tr>
                            <td></td>
                            <td class="text-nowrap">
                                <div class="overflow-x-auto"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- <div class="kt-card-footer"></div> -->
        </div>
    </div>
</div>

<div class="lg:col-span-1">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> Activities </h3>
                <div class="kt-menu">
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-arrows-circle"></i></button>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-printer"></i></button>
                    <a href="{{ $url }}"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_back" data-kt-tooltip-placement="bottom-start"><i class="ki-filled ki-black-right-line"></i></button></a>
                    <div id="tooltip_back" class="kt-tooltip">
                        Back
                    </div>
                </div>
            </div>
            <div class="kt-scrollable overflow-x-auto w-full rounded-lg">
                <div class="kt-card-content lg:p-7.5 lg:pt-6 p-5">
                    <div class="flex flex-col" bis_skin_checked="1">

                        @php $activity = activities($model)->where('subject_id', $data->id)->take(7); @endphp
                        <div class="flex flex-col">
    @foreach($activity as $acts)
        @php
            $props = json_decode($acts->properties, true) ?? [];
            $isRestored = $acts->description === 'updated'
                && ($props['attributes']['deleted_at'] ?? null) === null
                && !empty($props['old']['deleted_at']);
        @endphp

        <div class="flex items-start relative">
            {{-- Garis penghubung kecuali terakhir --}}
            @unless($loop->last)
                <div class="w-9 start-0 top-9 absolute bottom-0 rtl:-translate-x-1/2 translate-x-1/2 border-s border-s-input"></div>
            @endunless

            {{-- Icon --}}
            <div class="flex items-center justify-center shrink-0 rounded-full bg-accent/60 border border-input size-9 text-secondary-foreground">
                @if ($acts->description == 'created')
                    <i class="ki-filled ki-plus"></i>
                @elseif ($isRestored)
                    <i class="ki-filled ki-arrows-circle"></i>
                @elseif ($acts->description == 'updated')
                    <i class="ki-filled ki-pencil"></i>
                @elseif ($acts->description == 'deleted')
                    <i class="ki-filled ki-trash"></i>
                @endif
            </div>

            {{-- Konten --}}
            <div class="ps-2.5 mb-7 text-base grow">
                <div class="flex flex-col">
                    <div class="text-sm text-foreground whitespace-nowrap">
                        @if ($acts->description == 'created')
                            {{ __('default.activity.item-created') }}
                            {{ mb_strimwidth($props['attributes']['name'] ?? $data_object['name'] ?? '', 0, 10, ' ...') }}
                        @elseif ($isRestored)
                            {{ __('default.activity.item-restored') }}
                            {{ mb_strimwidth($props['attributes']['name'] ?? '', 0, 10, ' ...') }}
                        @elseif ($acts->description == 'updated')
                            {{ __('default.activity.item-updated') }}
                            {{ mb_strimwidth($props['attributes']['name'] ?? '', 0, 10, ' ...') }}
                        @elseif ($acts->description == 'deleted')
                            {{ __('default.activity.item-deleted') }}
                            {{ mb_strimwidth($props['attributes']['name'] ?? '', 0, 10, ' ...') }}
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

<div class="kt-modal" data-kt-modal="true" id="modalScan">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header">
            <h3 class="kt-modal-title text-sm">
                Scan Code
            </h3>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="kt-modal-body grid gap-5 px-0 py-5">
            <div class="flex flex-col items-center px-5 gap-2.5">
                {!! QrCode::size(250)->generate(URL::current()); !!}
            </div>
        </div>
        <div class="kt-modal-footer">
            <div></div>
            <div class="flex gap-2">
                <button class="kt-btn kt-btn-sm"><i class="ki-filled ki-printer"></i> Print</button>
                <button class="kt-btn kt-btn-sm kt-btn-mono" data-kt-modal-dismiss="#modal"> Done </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('body').on('click', '#delete', function(e) {
        e.preventDefault()
        Swal.fire({
            text: "{{ __('default.notification.confirm.delete') }}?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{ __('default.label.yes') }}",
            cancelButtonText: "{{ __('default.label.no') }}",
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $(e.target).closest('form').submit()
            }
        });
    });
</script>
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
            if (!$img.attr('src')) {
                $img.attr('src', $img.data('src'));
            }
        });
    });
</script>
@endpush