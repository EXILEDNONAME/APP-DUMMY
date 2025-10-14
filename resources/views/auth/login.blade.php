<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title> EXILEDNONAME - Register </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link href="{{ env('APP_URL') }}/assets/backend/media/app/favicon.ico" rel="shortcut icon" />
    <link href="{{ env('APP_URL') }}/assets/backend/vendors/keenicons/styles.bundle.css" rel="stylesheet" />
    <link href="{{ env('APP_URL') }}/assets/backend/css/styles.css" rel="stylesheet" />
</head>

<body class="antialiased flex h-full text-base text-foreground bg-background">
    <div class="grid lg:grid-cols-1 grow">
        <div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1">
            <div class="kt-card max-w-[370px] w-full">
                <form id="exilednoname-form" action="{{ route('login') }}" class="kt-card-content flex flex-col gap-5 p-10" method="post">
                    @csrf
                    <div class="text-center mb-2.5">
                        <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                            - LOGIN AREA -
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 gap-2.5">
                        <a class="kt-btn kt-btn-outline justify-center" href="#">
                            <img alt="" class="size-3.5 shrink-0" src="{{ env('APP_URL') }}/assets/backend/media/brand-logos/google.svg" />
                            Use Google
                        </a>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="border-t border-border w-full"></span>
                        <span class="text-xs text-secondary-foreground uppercase"> or </span>
                        <span class="border-t border-border w-full"></span>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex flex-col">
                            {{ Html::text('login')->class(['kt-input w-full'])->required() }}
                        </div>
                    </div>

                    <!-- <div class="kt-form-item">
                        <div class="flex flex-col">
                            <input class="kt-input" name="password" placeholder="password" type="password" value="" />
                            <span id="errors" class="font-semibold mt-2 text-center text-sm" style="color:var(--destructive)"> </span>
                        </div>
                    </div> -->

                    <div class="kt-input" data-kt-toggle-password="true" data-kt-toggle-password-initialized="true" name="passwordCustom">
                        <input name="password" placeholder="Enter Password" type="password" value="" data-gtm-form-interact-field-id="0">
                        <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5" data-kt-toggle-password-trigger="true" type="button">
                            <span class="kt-toggle-password-active:hidden"><i class="ki-filled ki-eye text-muted-foreground"></i></span>
                            <span class="hidden kt-toggle-password-active:block"><i class="ki-filled ki-eye-slash text-muted-foreground"></i>
                            </span>
                        </button>
                    </div>
                    <span id="errors" class="font-semibold mt-2 text-center text-sm" style="color:var(--destructive)"> </span>

                    <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow" form="exilednoname-form">
                        {{ __('default.label.login') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ env('APP_URL') }}/assets/backend/js/core.bundle.js"></script>
    <script src="{{ env('APP_URL') }}/assets/backend/vendors/ktui/ktui.min.js"></script>
    <script>
        document.getElementById("exilednoname-form").addEventListener("submit", async function(e) {
            e.preventDefault();

            let form = e.target;
            let formData = new FormData(form);
            $('#errors').html('');
            $('#success').html('');

            try {
                let response = await fetch("/login", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "Accept": "application/json"
                    }
                });

                let result = await response.json();

                if (response.ok && result.success) {
                    window.location.href = result.redirect;
                } else if (response.status === 422) {

                    let message = '';
                    let inputLogin = $('[name="login"]');
                    let inputPassword = $('[name="passwordCustom"]');

                    if (result.message) {
                        message = result.message;

                        if (message == "{{ __('auth.failed') }}") {
                            inputLogin.attr('aria-invalid', 'true').addClass('border-red-500');
                        } else {
                            inputLogin.removeAttr('aria-invalid').removeClass('border-red-500');
                        }

                        if (message == "{{ __('auth.password') }}") {
                            inputPassword.attr('aria-invalid', 'true').addClass('border-red-500');
                        } else {
                            inputPassword.removeAttr('aria-invalid').removeClass('border-red-500');
                        }

                        if (message == "{{ __('auth.inactived') }}") {
                            inputLogin.attr('aria-invalid', 'true').addClass('border-red-500');
                            inputPassword.attr('aria-invalid', 'true').addClass('border-red-500');
                        }

                    } else if (result.errors && result.errors.login) {
                        message = result.errors.login[0];
                    } else {
                        message = '{{ __("auth.error") }}';
                    }

                    $('#errors').html('<div class="text-red-500 mt-2 text-center">' + message + '</div>');
                } else {
                    $('#errors').html('<div class="text-red-500 mt-2 text-center"> {{ __("auth.error") }} </div>');
                }
            } catch (error) {
                console.error(error);
                $('#errors').html('<div class="text-red-500 mt-2 text-center"> {{ __("auth.error") }} </div>');
            }
        });
    </script>
</body>

</html>