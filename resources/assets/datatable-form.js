var card = new KTCard('exilednoname_card');
var card = new KTCard('exilednoname_activity');
var card = new KTCard('exilednoname_chart');

! function (t, e) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : t.lozad = e()
}(this, function () {
    "use strict";
    var g = "undefined" != typeof document && document.documentMode,
        f = {
            rootMargin: "0px",
            threshold: 0,
            load: function (t) {
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
                    u = -1 === u.indexOf(" url(") ? "url(" + u + ")" : u, 1 === d.length ? t.style.backgroundImage = u : t.setAttribute("style", (t.getAttribute("style") || "") + "background-image: " + u + "; background-image: -webkit-image-set(" + d + "); background-image: image-set(" + d + ")")
                }
                t.getAttribute("data-toggle-class") && t.classList.toggle(t.getAttribute("data-toggle-class"))
            },
            loaded: function () { }
        };

    function A(t) {
        t.setAttribute("data-loaded", !0)
    }
    var m = function (t) {
        return "true" === t.getAttribute("data-loaded")
    },
        v = function (t) {
            var e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : document;
            return t instanceof Element ? [t] : t instanceof NodeList ? t : e.querySelectorAll(t)
        };
    return function () {
        var r, a, o = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : ".lozad",
            t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
            e = Object.assign({}, f, t),
            i = e.root,
            n = e.rootMargin,
            d = e.threshold,
            u = e.load,
            g = e.loaded,
            s = void 0;
        "undefined" != typeof window && window.IntersectionObserver && (s = new IntersectionObserver((r = u, a = g, function (t, e) {
            t.forEach(function (t) {
                (0 < t.intersectionRatio || t.isIntersecting) && (e.unobserve(t.target), m(t.target) || (r(t.target), A(t.target), a(t.target)))
            })
        }), {
            root: i,
            rootMargin: n,
            threshold: d
        }));
        for (var c, l = v(o, i), b = 0; b < l.length; b++)(c = l[b]).getAttribute("data-placeholder-background") && (c.style.background = c.getAttribute("data-placeholder-background"));
        return {
            observe: function () {
                for (var t = v(o, i), e = 0; e < t.length; e++) m(t[e]) || (s ? s.observe(t[e]) : (u(t[e]), A(t[e]), g(t[e])))
            },
            triggerLoad: function (t) {
                m(t) || (u(t), A(t), g(t))
            },
            observer: s
        }
    }
});

$(document).on('shown.bs.modal', '.modal', function () {
    $(this).find('img.lazy-img').each(function () {
        var $img = $(this);
        if (!$img.attr('src')) {
            $img.attr('src', $img.data('src'));
        }
    });
});

$('#exilednoname-form').on('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let fileInput = $(this).find('input[type="file"]')[0];
    let hasFile = fileInput && fileInput.files.length > 0;

    let progressBar = $('#uploadProgress');
    let bar = progressBar.find('.progress-bar');

    $('#errors').html('');
    $('#success').html('');

    $.ajax({
        xhr: function () {
            let xhr = new window.XMLHttpRequest();

            // ✅ progress hanya ditrigger kalau ada file
            if (hasFile) {
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        let percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        progressBar.show();
                        bar.css('width', percentComplete + '%').text(percentComplete + '%');
                    }
                }, false);
            }

            return xhr;
        },

        url: this_url + "/../",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,

        beforeSend: function () {
            if (hasFile) {
                progressBar.show();
                bar.css('width', '0%').text('0%');
            } else {
                progressBar.hide(); // ⛔ kalau tidak ada file, pastikan progress disembunyikan
            }
        },

        success: function (res) {
            $('.invalid-feedback').remove();
            $('.is-invalid').removeClass('is-invalid');

            if (res.status === 'success') {
                window.location.href = res.redirect_url;
            } else if (res.status === 'error') {
                window.location.href = res.redirect_url;
            } else {
                alert(res.message);
            }
        },

        error: function (xhr) {
            if (xhr.status === 422) {
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {
                    let input = $('[name="' + key + '"]');
                    input.addClass('is-invalid');
                    input.after('<div class="invalid-feedback">' + value[0] + '</div>');
                });
            }
        }
    });
});

var KTBootstrapDatepicker = function () {
    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }
    var datepicker = function () {
        $('#ex_datepicker_date').datepicker({
            orientation: "bottom right",
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            templates: arrows
        });

        $('#ex_datepicker_daterange').datepicker({
            orientation: "bottom right",
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            templates: arrows
        });
    }
    return {
        init: function () {
            datepicker();
        }
    };
}();

var KTBootstrapDatetimepicker = function () {
    var baseDemos = function () {
        $('#ex_datetimepicker').datetimepicker({
            locale: 'en', format: 'YYYY-MM-DD HH:mm',
        });

    }
    return {
        init: function () {
            baseDemos();
        }
    };
}();

jQuery(document).ready(function () {
    KTBootstrapDatepicker.init();
    KTBootstrapDatetimepicker.init();
});
