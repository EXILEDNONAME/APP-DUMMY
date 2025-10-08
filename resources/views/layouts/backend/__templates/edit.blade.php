@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.edit') }} </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <a href="{{ $url }}"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_back" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-black-right-line"></i></button></a>
                </div>
            </div>
            <form method="POST" id="exilednoname-form" action="{{ URL::current() }}/../" accept-charset="UTF-8" class="kt-form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="kt-card-content p-7.5 grid gap-5">
                    <input class="form-control" name="id" type="hidden" value="{{ $data->id }}">
                    @include($path . 'form', ['formMode' => 'edit'])
                    @include('layouts.backend.__extensions.form.date')
                    @include('layouts.backend.__extensions.form.daterange')
                    @include('layouts.backend.__extensions.form.status')
                    @include('layouts.backend.__extensions.form.active')
                    @include('layouts.backend.__extensions.form.file', ['formMode' => 'edit'])

                    <div class="flex justify-end" bis_skin_checked="1">
                        <button type="submit" class="kt-btn kt-btn-primary">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>

            <div class="kt-modal" data-kt-modal="true" id="modalPicture">
                <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
                    <div class="kt-modal-header">
                        <h3 class="kt-modal-title text-sm"> Preview </h3>
                        <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true"><i class="ki-filled ki-cross"></i></button>
                    </div>
                    <div class="kt-modal-body grid gap-5 px-0 py-5">
                        <div class="flex flex-col items-center px-5 gap-2.5">
                            <img width="100%" data-src="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" class="lazy-img" loading="lazy" alt="Preview">
                        </div>
                    </div>
                    <div class="kt-modal-footer">
                        <div></div>
                        <div class="flex gap-2">
                            <a href="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" download="{{ $data->file }}"><button class="kt-btn kt-btn-sm"><i class="ki-filled ki-cloud-download"></i> Download </button></a>
                            <button class="kt-btn kt-btn-sm kt-btn-mono" data-kt-modal-dismiss="#modalPicture"> Close </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $('#exilednoname-form').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let fileInput = $(this).find('input[type="file"]')[0];
        let hasFile = fileInput && fileInput.files.length > 0;

        let progressBar = $('#uploadProgress');
        let bar = progressBar.find('.progress-bar');

        $('#errors').html('');
        $('#success').html('');

        $.ajax({
            xhr: function() {
                let xhr = new window.XMLHttpRequest();

                // ✅ progress hanya ditrigger kalau ada file
                if (hasFile) {
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            let percentComplete = Math.round((evt.loaded / evt.total) * 100);
                            progressBar.show();
                            bar.css('width', percentComplete + '%').text(percentComplete + '%');
                        }
                    }, false);
                }

                return xhr;
            },

            url: "{{ URL::Current() }}/../",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,

            beforeSend: function() {
                if (hasFile) {
                    progressBar.show();
                    bar.css('width', '0%').text('0%');
                } else {
                    progressBar.hide(); // ⛔ kalau tidak ada file, pastikan progress disembunyikan
                }
            },

            success: function(res) {
                $('.kt-form-message').remove();
                $('[aria-invalid="true"]').attr('aria-invalid', 'false').removeClass('border-red-500');

                if (res.status === 'success') {
                    window.location.href = res.redirect_url;
                } else if (res.status === 'error') {
                    window.location.href = res.redirect_url;
                } else {
                    alert(res.message);
                }
            },

            error: function(xhr) {
                if (xhr.status === 422) {
                    // hapus pesan error lama
                    $('.kt-form-message').remove();
                    $('[aria-invalid="true"]').attr('aria-invalid', 'false').removeClass('border-red-500');

                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        let input = $('[name="' + key + '"]');

                        // kasih tanda invalid
                        input.attr('aria-invalid', 'true');
                        input.addClass('border-red-500');

                        // tambahin pesan error custom
                        input.closest('.kt-form-control')
                            .next('.kt-form-message')
                            .text(value[0]);
                        input.after('<div class="kt-form-message">' + value[0] + '</div>');
                    });
                }
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
            var realSrc = $img.attr('data-src');
            var currentSrc = $img.attr('src');

            if (realSrc && currentSrc !== realSrc) {
                $img.attr('src', realSrc);
            }
        });
    });
</script>
@endpush