<?php

use Illuminate\Support\Facades\Route;

// ADMINISTRATIVE - SESSIONS
Route::group([
    'as' => 'dashboard.system.administrative.sessions.',
    'prefix' => 'dashboard/administratives/sessions',
    'namespace' => 'App\Http\Controllers\Backend\__System\Administrative',
    'middleware' => ['auth', 'verified'],
], function () {
    Route::get('delete-session/{id}', 'SessionController@delete_session')->name('delete-session');
    Route::get('delete-all-session', 'SessionController@delete_all_session')->name('delete-all-session');
    Route::get('/', 'SessionController@index');
});
