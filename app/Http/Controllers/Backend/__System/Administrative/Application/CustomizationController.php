<?php

namespace App\Http\Controllers\Backend\__System\Administrative\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Artisan;

class CustomizationController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth', 'verified', 'role:master-administrator'];
    }

    /**
     **************************************************
     * @return __CONSTRUCT
     **************************************************
     **/

    protected $data, $model, $path;

    public function __construct()
    {
        $this->model  = 'App\Models\Backend\__System\Administrative\Application\Customization';
        $this->path   = 'pages.backend.__system.administrative.application.customization.';
        $this->data   = $this->model::get();
    }

    /**
     **************************************************
     * @return INDEX
     **************************************************
     **/

    public function index()
    {
        $data = $this->model::first();
        return view($this->path . 'index', compact('data'));
    }

    /**
     **************************************************
     * @return UPDATE
     **************************************************
     **/

    public function update(Request $request)
    {
        $updated = $this->model::where('id', 1)->update([
            'topbar_application'    => $request->get('topbar_application'),
            'topbar_chat'           => $request->get('topbar_chat'),
            'topbar_notification'   => $request->get('topbar_notification'),            
            'topbar_search'         => $request->get('topbar_search'),
        ]);

        Artisan::call('cache:clear');
        return redirect()->back()->with('success', __('default.notification.success.customization-updated'));
    }
}
