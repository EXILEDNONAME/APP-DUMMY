<?php

namespace App\Http\Controllers\Backend\__System\Administrative;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Response;

class SessionController extends Controller implements HasMiddleware
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

    protected $data, $model, $path, $url;

    function __construct()
    {
        $this->model = 'App\Models\Backend\__System\Administrative\Session';
        $this->path = 'pages.backend.__system.administrative.session.';
        $this->url = '/dashboard/administratives/sessions';
        $this->data = $this->model::get();
    }

    /**
     **************************************************
     * @return INDEX
     **************************************************
     **/

    public function index()
    {
        $model = $this->model;
        if (request()->ajax()) {
            return DataTables::of($this->data)
                ->editColumn('avatar', function ($order) {
                    if (!empty($order->user_id)) {
                        $data = \App\Models\User::where('id', $order->user_id)->where('avatar', '!=', '')->first();
                        if (!empty($data)) {
                            return '<div class="symbol symbol-lg-35 symbol-30 symbol-circle symbol-light-success" bis_skin_checked="1"><img src="' . env("APP_URL") . '/storage/avatar/' . $order->user_id . "/" . $data->avatar . '"></div>';
                        } else {
                            return '<div class="symbol symbol-lg-35 symbol-30 symbol-circle symbol-light-success" bis_skin_checked="1"><img src="' . env("APP_URL") . '/assets/backend/media/users/blank.png"></div>';
                        }
                    }
                })
                ->editColumn('user_id', function ($order) {
                    if (!empty($order->user_id)) {
                        $data = \App\Models\User::where('id', $order->user_id)->first();
                        return $data->username;
                    }
                })
                ->editColumn('last_activity', function ($order) {
                    $data = $order->last_activity;
                    $datetime = date("d F Y, H:i:s", $data);
                    return $datetime;
                })
                ->editColumn('user_agent', function ($order) {
                    $userAgent = $order->user_agent;
                    $browser = 'Unknown';
                    $os = 'Unknown';

                    // 🧠 Deteksi Browser
                    if (strpos($userAgent, 'Brave') !== false) {
                        $browser = 'Brave';
                    } elseif (strpos($userAgent, 'Edg') !== false) {
                        $browser = 'Microsoft Edge';
                    } elseif (strpos($userAgent, 'OPR') !== false || strpos($userAgent, 'Opera') !== false) {
                        $browser = 'Opera';
                    } elseif (strpos($userAgent, 'Vivaldi') !== false) {
                        $browser = 'Vivaldi';
                    } elseif (strpos($userAgent, 'Chrome') !== false) {
                        $browser = 'Google Chrome';
                    } elseif (strpos($userAgent, 'Firefox') !== false) {
                        $browser = 'Mozilla Firefox';
                    } elseif (strpos($userAgent, 'Safari') !== false) {
                        $browser = 'Safari';
                    } elseif (strpos($userAgent, 'Chromium') !== false) {
                        $browser = 'Chromium';
                    }

                    // 🧩 Deteksi Sistem Operasi
                    if (strpos($userAgent, 'Windows NT 10') !== false) $os = 'Windows 10';
                    elseif (strpos($userAgent, 'Windows NT 11') !== false) $os = 'Windows 11';
                    elseif (strpos($userAgent, 'Windows NT 6.3') !== false) $os = 'Windows 8.1';
                    elseif (strpos($userAgent, 'Windows NT 6.1') !== false) $os = 'Windows 7';
                    elseif (strpos($userAgent, 'Mac OS X') !== false) $os = 'macOS';
                    elseif (strpos($userAgent, 'Linux') !== false) $os = 'Linux';
                    elseif (strpos($userAgent, 'Android') !== false) $os = 'Android';
                    elseif (strpos($userAgent, 'iPhone') !== false) $os = 'iOS';

                    return $browser . " - " . $os;
                })
                ->rawColumns(['user_id', 'avatar', 'user_agent'])
                ->addIndexColumn()->make(true);
        }
        return view($this->path . 'index', compact('model'));
    }

    /**
     **************************************************
     * @return RESET
     **************************************************
     **/

    public function reset()
    {
        $data = $this->model::truncate();
        return Response::json($data);
    }
}
