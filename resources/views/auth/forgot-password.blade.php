<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title> {{ \DB::table('system_settings')->first()->application_name; }} - Forgot Password </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link href="{{ env('APP_URL') }}/assets/backend/media/app/favicon.ico" rel="shortcut icon" />
    <link href="{{ env('APP_URL') }}/assets/backend/vendors/keenicons/styles.bundle.css" rel="stylesheet" />
    <link href="{{ env('APP_URL') }}/assets/backend/css/styles.css" rel="stylesheet" />
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
            <div class="kt-card max-w-[420px] w-full">
                <form id="exilednoname-form" action="{{ route('password.email') }}" class="kt-card-content flex flex-col gap-5 p-10" method="post">
                    @csrf
                    <div class="text-center mb-2.5">
                        <h3 class="text-lg font-medium text-mono leading-none mb-2.5"> - FORGOT PASSWORD - </h3><br>
                        <div class="flex items-center gap-2"><span class="border-t border-border w-full"></span></div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex flex-col">
                            {{ Html::email('email')->class(['kt-input w-full'])->placeholder('Enter Email')->required() }}
                        </div>
                    </div>

                    <div id="message-container" class="text-center text-xs font-semibold hidden"></div>

                    <div class="grid grid-cols-2 gap-2.5">
                        <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow"> Submit </button>
                        <a href="/login" class="kt-btn kt-btn-mono flex justify-center grow"> Back </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ env('APP_URL') }}/assets/backend/js/core.bundle.js"></script>
    <script src="{{ env('APP_URL') }}/assets/backend/vendors/ktui/ktui.min.js"></script>

    <script>
        $(document).ready(function() {
            const form = $('#exilednoname-form');
            const messageContainer = $('#message-container');
            const submitButton = form.find('button[type="submit"]');

            form.on('submit', function(e) {
                e.preventDefault();

                messageContainer.html('');
                submitButton.prop('disabled', true).text('Loading...');

                const formData = new FormData(this);

                fetch(form.attr('action'), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                    .then(async (response) => {
                        let result;
                        try {
                            result = await response.clone().json();
                        } catch {
                            const text = await response.text();
                            console.error('Response bukan JSON:', text);
                            throw new Error('Invalid JSON');
                        }

                        if (response.ok) {
                            messageContainer.removeClass('hidden');
                            messageContainer.html('<div class="text-green-500">' + result.status + '<br><br><hr></div>');
                        } else if (response.status === 422) {
                            const errors = result.errors || {};
                            if (errors.email) {
                                messageContainer.removeClass('hidden');
                                form.find('input[name="email"]').addClass('border-red-500').attr('aria-invalid', 'true');
                                messageContainer.html(`
                                    <div class="flex items-center gap-2"><span class="border-t border-border w-full"></span></div>
                                    <div class="text-center mt-3 mb-3" style="color:var(--destructive)"> ${errors.email} </div>
                                    <div class="flex items-center gap-2"><span class="border-t border-border w-full"></span></div>
                                `);

                            } else {
                                messageContainer.removeClass('hidden');
                                messageContainer.html(`
                                    <div class="flex items-center gap-2"><span class="border-t border-border w-full"></span></div>
                                    <div class="text-center mt-3 mb-3" style="color:var(--destructive)"> {{ __("auth.error") }} </div>
                                    <div class="flex items-center gap-2"><span class="border-t border-border w-full"></span></div>
                                `);
                            }
                        } else {
                            messageContainer.removeClass('hidden');
                            messageContainer.html(`
                                <div class="flex items-center gap-2"><span class="border-t border-border w-full"></span></div>
                                <div class="text-center mt-3 mb-3" style="color:var(--destructive)"> {{ __("auth.error") }} </div>
                                <div class="flex items-center gap-2"><span class="border-t border-border w-full"></span></div>
                            `);
                        }
                    })
                    .finally(() => {
                        submitButton.prop('disabled', false).text('Submit');
                    });
            });
        });
    </script>
</body>

</html>