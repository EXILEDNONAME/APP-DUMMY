<?php

namespace App\Http\Traits\Backend\__System\Controllers\Datatable\Extension;

use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

trait ActivityController
{
    public function activity()
    {
        $model = $this->model;
        $url = $this->url;
        if (request()->ajax()) {
            $query = Activity::where('subject_type', $this->model);

            if (request()->has('filter_status') && request()->filter_status != '') {
                $query->where('description', request()->filter_status);
            }

            return DataTables::of($query)
                ->editColumn('subjects', function ($order) {
                    if (!empty($order->properties['attributes']['name'])) {
                        return $order->properties['attributes']['name'];
                    } else {
                        return '-';
                    }
                })
                ->editColumn('causer_id', function ($order) {
                    return $order->causer->name;
                })
                ->editColumn('updated_at', function ($order) {
                    return \Carbon\Carbon::parse($order->updated_at)->format('d F Y, H:i');
                })
                ->addIndexColumn()->make(true);
        }
        return view($this->path . 'activity', compact('model', 'url'));
    }
}
