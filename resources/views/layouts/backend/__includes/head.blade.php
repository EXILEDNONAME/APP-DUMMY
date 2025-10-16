<head>
    <base href="../../">
    <title> {{ \DB::table('system_settings')->first()->application_name; }} - @yield('title') </title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="follow, index" name="robots" />
    <link href="https://127.0.0.1:8001/metronic-tailwind-html/demo1/index.html" rel="canonical" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <meta content="" name="description" />
    <link href="{{ env('APP_URL') }}/assets/backend/media/app/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180" />
    <link href="{{ env('APP_URL') }}/assets/backend/media/app/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png" />
    <link href="{{ env('APP_URL') }}/assets/backend/media/app/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png" />
    <link href="{{ env('APP_URL') }}/assets/backend/media/app/favicon.ico" rel="shortcut icon" />
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/backend/mix/css/app-core.css" />
    @stack('head')
</head>