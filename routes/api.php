<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

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

Route::get('/datatable/generals', function (Request $request) {
    $query = DB::table('system_application_table_generals');
    return DataTables::of($query)->make(true);

    // $pageSize = $request->get('size', 25);
    // $page = $request->get('page', 1);

    // $query = DB::table('system_application_table_generals');

    // $data = $query->paginate($pageSize, ['*'], 'page', $page);

    // return response()->json([
    //     'data' => $data->items(),
    //     'totalCount' => $data->total(),
    //     'page' => $data->currentPage(),
    //     'pageSize' => $data->perPage(),
    //     'totalPages' => $data->lastPage(),
    // ]);
});