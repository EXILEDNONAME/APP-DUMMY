<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title> {{ \DB::table('system_settings')->first()->application_name; }} - @yield('title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link href="{{ env('APP_URL') }}/assets/backend/media/app/favicon.ico" rel="shortcut icon" />
    <link href="{{ env('APP_URL') }}/assets/backend/vendors/keenicons/styles.bundle.css" rel="stylesheet" />
    <link href="{{ env('APP_URL') }}/assets/backend/css/styles.css" rel="stylesheet" />
    @php if (class_exists(\Barryvdh\Debugbar\Facades\Debugbar::class)) { \Barryvdh\Debugbar\Facades\Debugbar::disable(); } @endphp
</head>

<body class="antialiased flex h-full text-base text-foreground bg-background">
    <style>
        .page-bg {
            background-image: url("{{ env('APP_URL') }}/assets/backend/media/images/2600x1200/bg-10.png");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
    </style>

    <div class="grid lg:grid-cols-1 grow">
        <div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1 page-bg">
            <div class="kt-card max-w-[440px] w-full">
                <div action="#" class="kt-card-content p-10" id="check_email_form" method="post">
                    <div class="flex justify-center py-10">
                        <img alt="image" class="dark:hidden max-h-[130px]" src="{{ env('APP_URL') }}/assets/backend/media/illustrations/30.svg">
                        <img alt="image" class="light:hidden max-h-[130px]" src="{{ env('APP_URL') }}/assets/backend/media/illustrations/30-dark.svg">
                    </div>
                    <h3 class="text-lg font-medium text-mono text-center"> Check your email </h3>
                    <div class="flex items-center gap-2"><span class="border-t border-border w-full mt-2 mb-2"></span></div>
                    <div class="text-sm text-center text-secondary-foreground">
                        Please click the link sent to your email.<br>
                        <a class="text-sm text-mono font-medium hover:text-primary" href="#"> {{ mask_email(Auth::User()->email) }} </a>
                        <div class="flex items-center gap-2"><span class="border-t border-border w-full mt-2 mb-2"></span></div>
                    </div>

                    <div id="message-container" class="text-xs font-semibold"></div>

                    <div class="flex justify-center mb-5">
                        <a href="#" id="ajax-logout" class="kt-btn kt-btn-primary flex justify-center w-full">
                            Logout
                        </a>
                    </div>
                    <div class="flex items-center justify-center gap-1 text-sm">
                        <span class="text-secondary-foreground"> Didn't receive an email? </span>
                        <form id="verify-form" action="{{ route('verification.send') }}" method="post" class="flex items-center">
                            @csrf
                            <button type="submit" id="ajax-verify" class="font-medium kt-link p-0 bg-transparent border-none text-primary hover:underline">
                                Resend
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ env('APP_URL') }}/assets/backend/js/core.bundle.js"></script>
    <script src="{{ env('APP_URL') }}/assets/backend/vendors/ktui/ktui.min.js"></script>

    <script>
        $(document).ready(function() {
            const form = $('#verify-form');
            const message = $('#message-container');
            const btn = $('#ajax-verify');

            btn.on('click', function(e) {
                e.preventDefault();
                message.html('');
                btn.text('Sending...').addClass('opacity-60 pointer-events-none');

                fetch(form.attr('action'), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(async (response) => {
                        let data = {};
                        try {
                            data = await response.clone().json();
                        } catch {}

                        if (response.ok) {
                            message.html(`
                                <div class="text-green-500 text-center">
                                    Verification link sent successfully!
                                </div>
                                <div class="items-center gap-2 flex justify-center">
                                    <span class="border-b border-border w-full max-w-[150px] mt-2 mb-5"></span>
                                </div>
                            `);
                        } else if (response.status === 429) {
                            message.html(`
                                <div class="text-center" style="color:var(--destructive)">
                                    Please wait before requesting again.
                                </div>
                                <div class="items-center gap-2 flex justify-center">
                                    <span class="border-b border-border w-full max-w-[150px] mt-2 mb-5"></span>
                                </div>
                            `);
                        } else {
                            message.html(`
                                <div class="text-center" style="color:var(--destructive)">
                                    {{ __("auth.error") }}
                                </div>
                                <div class="items-center gap-2 flex justify-center">
                                    <span class="border-b border-border w-full max-w-[150px] mt-2 mb-5"></span>
                                </div>
                            `);
                        }
                    })
                    .catch((err) => {
                        message.html('<div class="text-center" style="color:var(--destructive)">{{ __("auth.error") }}</div><div class="items-center gap-2"><span class="border-b border-border w-full mt-2"></span></div>');
                    })
                    .finally(() => {
                        btn.text('Resend').removeClass('opacity-60 pointer-events-none');
                    });
            });
        });
    </script>

    <script>
        $(document).on('click', '#ajax-logout', function(e) {
            e.preventDefault();

            fetch("{{ route('logout') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => {
                if (response.ok) {
                    window.location.href = "/login";
                } else {
                    console.error("Logout failed", response);
                }
            }).catch(err => console.error("Error:", err));
        });
    </script>

</body>

</html>