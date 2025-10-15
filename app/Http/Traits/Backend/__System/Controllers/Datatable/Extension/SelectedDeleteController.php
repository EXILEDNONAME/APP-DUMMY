<?php

namespace App\Http\Traits\Backend\__System\Controllers\Datatable\Extension;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

trait SelectedDeleteController
{
    public function selected_delete(Request $request)
    {
        $data = $request->EXILEDNONAME;
        $ids = explode(",", $data);
        $data2 = $this->model::whereIn('id', $ids)->get();

        foreach ($data2 as $data3) {
            if (Auth::User()->id != 1 && Auth::User()->id != 2 && $data3->created_by != Auth::User()->id) {
                return response()->json([
                'status' => 'error',
                'message' => __('default.notification.error.restrict')
            ]);
            }
        }

        foreach ($data2 as $data3) {
            $this->model::destroy($data3->id);
        }
        Cache::forget($this->url);
        return Response::json($data);
    }
}
