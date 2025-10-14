<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../../../">
    <meta charset="utf-8" />
    <title>
        @php $title = Cache::remember('title', 300, function () { return \DB::table('system_settings')->first(); }); @endphp
        {{ $title->application_name; }} - Login
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Login">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}/assets/login/login-5.css">
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}/assets/login/style.bundle.min.css">
    <link rel="shortcut icon" href="{{ env('APP_URL') }}/favicon.png" />
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div class="d-flex flex-column flex-root">
        <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url({{ env('APP_URL') }}{{ env('APP_URL') }}/assets/backend/media/bg/bg-2.jpg);">
                <div class="login-form text-center text-white p-7 position-relative overflow-hidden">

                    <div class="login-signin text-white">
                        <div class="mb-10">
                            <h3 class="opacity-40 font-weight-normal"> - LOGIN AREA - </h3>
                            <p class="opacity-40"> Enter Your Details to Login Your Account </p>
                        </div>

                        <form id="exilednoname-form" class="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Account" name="login" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="password" placeholder="Password" name="password" id="password" required />
                            </div>

                            <center>
                                <div class="fv-plugins-message-container mt-0">
                                    <div data-field="login" class="fv-help-block"><strong>
                                            <div id="message"></div>
                                        </strong></div>
                                </div>
                            </center>
                            <hr>

                            <center>
                                @error('login')
                                <div class="fv-plugins-message-container mt-0">
                                    <div data-field="login" class="fv-help-block"><strong>{{ $message }}</strong></div>
                                </div>
                                <br>
                                @enderror

                                @error('password')
                                <div class="fv-plugins-message-container mt-0">
                                    <div data-field="password" class="fv-help-block"><strong>{{ $message }}</strong></div>
                                </div>
                                <br>
                                @enderror
                            </center>

                            @if ($message = Session::get('status'))
                            <div id="toast-container" class="toast-bottom-right">
                                <div class="toast toast-success" aria-live="polite">
                                    <div class="toast-message">{{ $message }}</div>
                                </div>
                            </div>
                            @endif

                            <div class="form-group text-center d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                                        <input type="checkbox" name="" onclick="showPassword()">
                                        <span></span>
                                        Show Password
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}" class="text-white font-weight-bold">Forget Password ?</a>
                            </div>
                            <div class="form-group text-center mt-10">
                                <a href="/"><span class="btn btn-pill btn-danger opacity-90 px-15 py-3 mr-5"> {{ __('default.label.back') }} </span></a>
                                <button type="submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Sign In</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("exilednoname-form").addEventListener("submit", async function(e) {
            e.preventDefault();

            let form = e.target;
            let formData = new FormData(form);

            let response = await fetch("/login", {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Accept": "application/json"
                }
            });

            let result = await response.json();

            if (result.success) {
                window.location.href = result.redirect;
            } else {
                document.getElementById("message").innerText = result.message;
            }
        });
    </script>

    <script>
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>