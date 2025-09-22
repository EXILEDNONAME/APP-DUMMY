<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/license/validate', function (Request $request) {
    $license = $request->get('license');
    $validLicense = DB::table('system_licenses')->where('license_key', $license)->first();

    if ($validLicense) {
        return response()->json(['status' => 'valid']);
    }

    return response()->json(['status' => 'invalid']);
});
