<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title> EXILEDNONAME - Login </title>
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

        .dark .page-bg {
            background-image: url("{{ env('APP_URL') }}/assets/backend/media/images/2600x1200/bg-10-dark.png");
        }
    </style>

    <div class="grid lg:grid-cols-1 grow">
        <div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1 page-bg">
            <div class="kt-card max-w-[420px] w-full">

                <form id="exilednoname-form" class="kt-card-content flex flex-col gap-5 p-10">
                    @csrf

                    <div class="text-center mb-2.5">
                        <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                            - RESET PASSWORD -
                        </h3>
                    </div>

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Field -->
                    <div class="form-group">
                        <input class="kt-input w-full @error('email') is-invalid @enderror"
                            id="email"
                            type="email"
                            value="{{ $request->email ?? old('email') }}"
                            placeholder="Email Address"
                            name="email"
                            autocomplete="off"
                            autofocus
                            required />
                        @error('email')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password Field --}}
                    <div class="form-group">
                        <div class="kt-input"
                            id="password-wrapper"
                            data-kt-toggle-password="true"
                            data-kt-toggle-password-initialized="true">
                            <input id="password"
                                name="password"
                                placeholder="New Password"
                                type="password"
                                autocomplete="new-password"
                                required>
                            <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                                data-kt-toggle-password-trigger="true"
                                type="button">
                                <span class="kt-toggle-password-active:hidden">
                                    <i class="ki-filled ki-eye text-muted-foreground"></i>
                                </span>
                                <span class="hidden kt-toggle-password-active:block">
                                    <i class="ki-filled ki-eye-slash text-muted-foreground"></i>
                                </span>
                            </button>
                        </div>
                        <span class="error-message" id="error-password"></span>
                    </div>

                    {{-- Password Confirmation Field --}}
                    <div class="form-group">
                        <div class="kt-input"
                            id="password-confirmation-wrapper"
                            data-kt-toggle-password="true"
                            data-kt-toggle-password-initialized="true">
                            <input id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Confirm New Password"
                                type="password"
                                autocomplete="new-password"
                                required>
                            <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                                data-kt-toggle-password-trigger="true"
                                type="button">
                                <span class="kt-toggle-password-active:hidden">
                                    <i class="ki-filled ki-eye text-muted-foreground"></i>
                                </span>
                                <span class="hidden kt-toggle-password-active:block">
                                    <i class="ki-filled ki-eye-slash text-muted-foreground"></i>
                                </span>
                            </button>
                        </div>
                        <span class="error-message" id="error-password_confirmation"></span>
                    </div>

                    @error('email')
                    <strong>{{ $message }}</strong>
                    <br>
                    @enderror
                    @error('password')
                    <strong>{{ $message }}</strong>
                    <br>
                    @enderror

                    @if (session('status'))
                    {{ session('status') }}
                    @endif

                    {{-- Submit Button --}}
                    <button type="submit" id="submit-btn" class="kt-btn kt-btn-primary flex justify-center grow">
                        <span id="btn-text">{{ __('Reset Password') }}</span>
                    </button>

                    {{-- Back to Login --}}
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-sm opacity-70 hover:opacity-100 transition-opacity">
                            <i class="ki-filled ki-left text-xs"></i> Back to Login
                        </a>
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
            // Setup AJAX CSRF Token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Reset Password Form Submit
            $('#exilednoname-form').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                clearErrors();

                // Get form data
                const formData = {
                    token: $('input[name="token"]').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val()
                };

                // Show loading state
                showLoading();

                // AJAX Request
                $.ajax({
                    url: '{{ route("password.store") }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        hideLoading();

                        // Show success message
                        showAlert('success', response.message || 'Password has been reset successfully!');

                        // Reset form
                        $('#exilednoname-form')[0].reset();

                        // Redirect to login after 2 seconds
                        setTimeout(function() {
                            window.location.href = '{{ route("login") }}';
                        }, 2000);
                    },
                    error: function(xhr) {
                        hideLoading();

                        if (xhr.status === 422) {
                            // Validation errors
                            const errors = xhr.responseJSON.errors;
                            displayErrors(errors);
                        } else if (xhr.status === 400 || xhr.status === 404) {
                            // Token expired or invalid
                            showAlert('error', xhr.responseJSON.message || 'Invalid or expired reset token.');
                        } else {
                            // Other errors
                            showAlert('error', 'An error occurred. Please try again.');
                        }
                    }
                });
            });

            // Function to clear errors
            function clearErrors() {
                $('.error-message').text('').hide();
                $('.kt-input').removeClass('is-invalid');
                $('#email').removeClass('is-invalid');
                $('#alert-message').hide().removeClass('alert-success alert-error');
            }

            // Function to display validation errors
            function displayErrors(errors) {
                $.each(errors, function(field, messages) {
                    const errorElement = $('#error-' + field);
                    const inputElement = $('#' + field);
                    const wrapperElement = $('#' + field + '-wrapper');

                    errorElement.text(messages[0]).show();

                    if (wrapperElement.length) {
                        wrapperElement.addClass('is-invalid');
                    } else {
                        inputElement.addClass('is-invalid');
                    }
                });
            }

            // Function to show alert
            function showAlert(type, message) {
                const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
                $('#alert-message')
                    .removeClass('alert-success alert-error')
                    .addClass(alertClass)
                    .text(message)
                    .fadeIn();
            }

            // Function to show loading state
            function showLoading() {
                $('#submit-btn').addClass('btn-loading').prop('disabled', true);
                $('#btn-text').text('Processing...');
            }

            // Function to hide loading state
            function hideLoading() {
                $('#submit-btn').removeClass('btn-loading').prop('disabled', false);
                $('#btn-text').text('{{ __("Reset Password") }}');
            }
        });
    </script>

</body>

</html>