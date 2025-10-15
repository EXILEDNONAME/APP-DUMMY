<?php

namespace App\Http\Controllers\Backend\__System\Administrative;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth', 'verified'];
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
                ->editColumn('region', function ($order) {
                    $ip = $order->ip_address;
                    $flag = "";

                    try {
                        $response = Http::get("https://ipinfo.io/{$ip}/json");
                        $data = $response->json();

                        if ($data['country'] == 'US') {
                            $flag = 'United States';
                        } else if ($data['country'] == 'ID') {
                            $flag = 'Indonesia';
                        }

                        return $data['city'] . ", " . $data['region'] . ", " . $flag;
                    } catch (\Exception $e) {
                        return '-';
                    }
                })
                ->editColumn('user_agent', function ($order) {
                    $userAgent = $order->user_agent;
                    $browser = 'Unknown';
                    $os = 'Unknown';

                    // BROWSER
                    if (strpos($userAgent, 'Brave') !== false) {
                        $browser = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Brave </span>';
                    } elseif (strpos($userAgent, 'Edg') !== false) {
                        $browser = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Microsoft Edge </span>';
                    } elseif (strpos($userAgent, 'OPR') !== false || strpos($userAgent, 'Opera') !== false) {
                        $browser = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Opera </span>';
                    } elseif (strpos($userAgent, 'Vivaldi') !== false) {
                        $browser = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Vivaldi </span>';
                    } elseif (strpos($userAgent, 'Chrome') !== false) {
                        $browser = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Google Chrome </span>';
                    } elseif (strpos($userAgent, 'Firefox') !== false) {
                        $browser = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Mozilla Firefox </span>';
                    } elseif (strpos($userAgent, 'Safari') !== false) {
                        $browser = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Safari </span>';
                    } elseif (strpos($userAgent, 'Chromium') !== false) {
                        $browser = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Chromium </span>';
                    }

                    // OPERATING SYSTEM
                    if (strpos($userAgent, 'Windows NT 10') !== false) $os = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Windows 10 </span>';
                    elseif (strpos($userAgent, 'Windows NT 11') !== false) $os = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Windows 11 </span>';
                    elseif (strpos($userAgent, 'Windows NT 6.3') !== false) $os = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Windows 8.1 </span>';
                    elseif (strpos($userAgent, 'Windows NT 6.1') !== false) $os = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Windows 7 </span>';
                    elseif (strpos($userAgent, 'Mac OS X') !== false) $os = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> macOS </span>';
                    elseif (strpos($userAgent, 'Linux') !== false) $os = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Linux </span>';
                    elseif (strpos($userAgent, 'Android') !== false) $os = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> Android </span>';
                    elseif (strpos($userAgent, 'iPhone') !== false) $os = '<span class="ms-auto kt-badge kt-badge-stroke shrink-0"> iOS </span>';

                    return $browser . " " . $os;
                })
                ->rawColumns(['user_id', 'avatar', 'user_agent', 'ip_address'])
                ->addIndexColumn()->make(true);
        }
        return view($this->path . 'index', compact('model'));
    }

    /**
     **************************************************
     * @return DELETE_SESSION
     **************************************************
     **/

    public function delete_session($id = null)
    {
        if (!$id) {
            return redirect('/dashboard')->with('error', __('default.notification.error.restrict'));
        }

        if (\App\Models\User::where('username', $id)->first()->id == 1 || \App\Models\User::where('username', $id)->first()->id == 2) {
            return response()->json([
                'status' => 'error',
                'message' => __('default.notification.error.restrict')
            ]);
        } else {
            $user = \App\Models\User::where('username', $id)->first()->id;
            $data = $this->model::where('user_id', $user)->delete();
            return Response::json($data);
        }
    }

    /**
     **************************************************
     * @return DELETE_ALL_SESSION
     **************************************************
     **/

    public function delete_all_session()
    {
        $data = $this->model::truncate();
        return Response::json($data);
    }
}
