<?php

namespace App\Http\Traits\Backend\__System\Controllers\Datatable\Default;

trait CreateController
{
    public function create()
    {
        $path = $this->path;
        $url = $this->url;
        $statusName = $this->status;
        return view($this->path . 'create', compact('path', 'statusName', 'url'));
    }
}
