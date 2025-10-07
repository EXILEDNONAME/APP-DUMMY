<?php

namespace App\Http\Traits\Backend\__System\Controllers\Datatable\Default;

trait ShowController
{
    public function show($id)
    {
        $trash = $this->model::withTrashed()->find($id);
        if (!$trash) {
            return redirect('/dashboard')->with('error', __('default.notification.error.item_not_found'));
        }

        $url = $this->url;
        $model = $this->model;
        $data = $this->model::find($id);

        if (!$data) {
            return redirect()->back()->with('error', __('default.notification.error.item_not_found'));
        }

        return view($this->path . 'show', compact('data', 'model', 'url'));
    }
}
