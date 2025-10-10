<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.frontend.index');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/backend/dashboard.php';
require __DIR__ . '/backend/language.php';
require __DIR__ . '/backend/administrative/application.php';
require __DIR__ . '/backend/administrative/database.php';
require __DIR__ . '/backend/administrative/management.php';
require __DIR__ . '/backend/administrative/session.php';

require __DIR__ . '/backend/application/datatable.php';

Route::get('/templates', function () {
    return view('layouts.template');
});

Route::get('/check-environment', function() {
    return [
        'proc_open' => function_exists('proc_open') ? 'Available' : 'Disabled',
        'exec' => function_exists('exec') ? 'Available' : 'Disabled',
        'shell_exec' => function_exists('shell_exec') ? 'Available' : 'Disabled',
        'disabled_functions' => ini_get('disable_functions'),
        'memory_limit' => ini_get('memory_limit'),
        'max_execution_time' => ini_get('max_execution_time'),
        'temp_dir' => sys_get_temp_dir(),
        'storage_writable' => is_writable(storage_path()),
        'php_version' => phpversion(),
    ];
});