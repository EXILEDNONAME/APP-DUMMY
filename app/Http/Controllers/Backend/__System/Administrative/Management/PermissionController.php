<?php

namespace App\Http\Controllers\Backend\__System\Administrative\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Traits\HandlesFormRequest;
use App\Http\Traits\Backend\__System\Controllers\Datatable\DefaultController;
use App\Http\Traits\Backend\__System\Controllers\Datatable\ExtensionController;

use App\Http\Requests\Backend\__System\Administrative\Management\Permission\StoreRequest;
use App\Http\Requests\Backend\__System\Administrative\Management\Permission\UpdateRequest;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth', 'verified', 'role:master-administrator'];
    }

    use DefaultController;
    use ExtensionController;
    use HandlesFormRequest;

    /**
     **************************************************
     * @return CONSTRUCT
     **************************************************
     **/

    protected $model, $path, $sort, $url;

    function __construct()
    {
        $this->model      = 'App\Models\Permission';
        $this->path       = 'pages.backend.__system.administrative.management.permission.';
        $this->url        = '/dashboard/administratives\managements\permissions';
        $this->sort       = "1, asc";

        app()->instance('current.model', $this->model);
        app()->instance('current.url', $this->url);
    }

    public function store(StoreRequest $request) {}
    public function update(UpdateRequest $request, $id) {}

    /**
     **************************************************
     * @return INDEX
     **************************************************
     **/

    public function index()
    {
        $model = $this->model;
        $sort = $this->sort;

        if (request()->ajax()) {
            $query = $this->model::orderBy('created_at', 'desc')->get();
            if (request('date')) {
                $query->whereDate('date', request('date'));
            } else if (request('datetime')) {
                $query->whereDate('datetime', request('datetime'));
            } else if (request('date_start') && request('date_end')) {
                $query->whereBetween('date_start', [request('date_start'), request('date_end')]);
            }

            return DataTables::of($query)
                ->editColumn('date_start', function ($order) {
                    return empty($order->date_start) ? NULL : \Carbon\Carbon::parse($order->date_start)->format('d F Y, H:i');
                })
                ->editColumn('date_end', function ($order) {
                    return empty($order->date_end) ? NULL : \Carbon\Carbon::parse($order->date_end)->format('d F Y, H:i');
                })
                ->editColumn('description', function ($order) {
                    return nl2br(e($order->description));
                })
                ->editColumn('role', function ($order) {
                    $permission = DB::table('roles')->where('id', $order->role_id)->first();
                    return ucwords(str_replace(['-', '_'], ' ', $permission->name));
                })
                ->editColumn('user', function ($order) {
                    $user = DB::table('users')->where('id', $order->model_id)->first();
                    return $user->name;
                })
                ->editColumn('created_by', function ($order) {
                    return DB::table('users')->where('id', $order->created_by)->first()->name ?? '-';
                })
                ->rawColumns(['description'])
                ->addIndexColumn()->make(true);
        }
        return view($this->path . 'index', compact('model', 'sort'));
    }

    /**
     **************************************************
     * @return DESTROY
     **************************************************
     **/

    public function destroy($id)
    {
        if ($id == 1 || $id == 2) {
            return redirect($this->url)->with('error', __('default.notification.error.restrict'));
        } else {
            try {
                $this->model::destroy($id);
                return redirect($this->url)->with('success', __('default.notification.success.item-deleted'));
            } catch (\Exception $e) {
                return redirect($this->url)->with('error', __('default.notification.error'));
            }
        }
    }

    /**
     **************************************************
     * @return ACTIVE
     **************************************************
     **/

    public function active($id = null)
    {
        if ($id == 1 || $id == 2) {
            return response()->json(['status'  => 'error', 'message' => __('default.notification.error.restrict')], 200);
        } else {
            if (!$id) {
                return redirect('/dashboard')->with('error', __('default.notification.error.restrict'));
            }

            if (Auth::User()->id != 1 && Auth::User()->id != 2 && $this->model::where('id', $id)->first()->created_by != Auth::User()->id) {
                return response()->json(['status'  => 'error', 'message' => __('default.notification.error.restrict')], 200);
            } else {
                $data = $this->model::where('id', $id)->update(['active' => 1]);
                Cache::forget($this->url);
                return response()->json($data);
            }
        }
    }

    /**
     **************************************************
     * @return INACTIVE
     **************************************************
     **/

    public function inactive($id = null)
    {
        if ($id == 1 || $id == 2) {
            return response()->json(['status'  => 'error', 'message' => __('default.notification.error.restrict')], 200);
        } else {
            if (!$id) {
                return redirect('/dashboard')->with('error', __('default.notification.error.restrict'));
            }

            if (Auth::User()->id != 1 && Auth::User()->id != 2 && $this->model::where('id', $id)->first()->created_by != Auth::User()->id) {
                return response()->json(['status'  => 'error', 'message' => __('default.notification.error.restrict')], 200);
            } else {
                $data = $this->model::where('id', $id)->update(['active' => 0]);
                Cache::forget($this->url);
                return response()->json($data);
            }
        }
    }

    /**
     **************************************************
     * @return SELECTED_ACTIVE
     **************************************************
     **/

    public function selected_active(Request $request)
    {
        $data = "0," . $request->EXILEDNONAME;
        $array = explode(",", $data);

        if (array_search("1", $array) || array_search("2", $array)) {
            return response()->json(['status'  => 'error', 'message' => __('default.notification.error.restrict')], 200);
        } else {
            $data = $request->EXILEDNONAME;
            $data2 = $this->model::whereIn('id', explode(",", $data))->get();
            foreach ($data2 as $data3) {
                $this->model::where('id', $data3->id)->update(['active' => 1]);
            }
            return response()->json($data);
        }
    }

    /**
     **************************************************
     * @return SELECTED_INACTIVE
     **************************************************
     **/

    public function selected_inactive(Request $request)
    {
        $data = "0," . $request->EXILEDNONAME;
        $array = explode(",", $data);

        if (array_search("1", $array) || array_search("2", $array)) {
            return response()->json(['status'  => 'error', 'message' => __('default.notification.error.restrict')], 200);
        } else {
            $data = $request->EXILEDNONAME;
            $data2 = $this->model::whereIn('id', explode(",", $data))->get();
            foreach ($data2 as $data3) {
                $this->model::where('id', $data3->id)->update(['active' => 0]);
            }
            return response()->json($data);
        }
    }

    /**
     **************************************************
     * @return DELETE
     **************************************************
     **/

    public function delete($id)
    {
        if ($id == 1 || $id == 2) {
            return response()->json(['status'  => 'error', 'message' => __('default.notification.error.restrict')], 200);
        } else {
            $this->model::destroy($id);
            $data = $this->model::where('id', $id)->delete();
            return response()->json($data);
        }
    }

    /**
     **************************************************
     * @return SELECTED_DELETE
     **************************************************
     **/

    public function selected_delete(Request $request)
    {
        $data = "0," . $request->EXILEDNONAME;
        $array = explode(",", $data);

        if (array_search("1", $array) || array_search("2", $array)) {
            return response()->json(['status'  => 'error', 'message' => __('default.notification.error.restrict')], 200);
        } else {
            $data = $request->EXILEDNONAME;
            $data2 = $this->model::whereIn('id', explode(",", $data))->get();
            foreach ($data2 as $data3) {
                $this->model::destroy($data3->id);
            }
            return response()->json($data);
        }
    }

    /**
     **************************************************
     * @return TRASH
     **************************************************
     **/
    public function trash()
    {
        $statusName = property_exists($this, 'status') && $this->status ? $this->status : 'default';
        $statusFilter = DB::table('system_status_filters')->where('name', $statusName)->first();
        $attributes = json_decode($statusFilter->properties ?? '[]', true);

        $model = $this->model;
        $sort = $this->sort;
        $url = $this->url;

        if (request()->ajax()) {
            $tableName = (new $this->model)->getTable();
            $query = $this->model::onlyTrashed()
                ->leftJoin('users', 'users.id', '=', $tableName . '.model_id')
                ->leftJoin('roles', 'roles.id', '=', $tableName . '.role_id')
                ->select($tableName . '.*', 'users.name as user_name', 'roles.name as role_name');

            if (request('deleted_at')) {
                $query->whereDate($tableName . '.deleted_at', request('deleted_at'));
            }

            $datatable = DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('deleted_at', function ($order) {
                    return empty($order->deleted_at) ? NULL : \Carbon\Carbon::parse($order->deleted_at)->format('d F Y, H:i');
                })
                ->editColumn('description', function ($order) {
                    return nl2br(e($order->description));
                })
                ->editColumn('role_id', function ($order) {
                    return ucwords(str_replace(['-', '_'], ' ', $order->role->name));
                })
                ->editColumn('model_id', function ($order) {
                    return DB::table('users')->where('id', $order->model_id)->first()->name;
                })
                ->filterColumn('role_id', function ($query, $keyword) {
                    $query->where('roles.name', 'like', "%{$keyword}%");
                })
                ->filterColumn('model_id', function ($query, $keyword) {
                    $query->where('users.name', 'like', "%{$keyword}%");
                });
            return $datatable->rawColumns(['description'])->make(true);
        }
        return view($this->path . 'trash', compact(['attributes', 'model', 'sort', 'url']));
    }
}
