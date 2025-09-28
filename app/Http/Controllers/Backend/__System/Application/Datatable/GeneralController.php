<?php

namespace App\Http\Controllers\Backend\__System\Application\Datatable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Backend\__System\Controllers\Datatable\DefaultController;
use App\Http\Traits\Backend\__System\Controllers\Datatable\ExtensionController;
use App\Http\Traits\HandlesFormRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

use App\Http\Requests\Backend\__System\Application\Datatable\General\StoreRequest;
use App\Http\Requests\Backend\__System\Application\Datatable\General\UpdateRequest;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GeneralController extends Controller implements HasMiddleware
{
    /**
     **************************************************
     * @return MIDDLEWARE
     **************************************************
     **/

    public static function middleware(): array
    {
        return [
            function (\Illuminate\Http\Request $request, \Closure $next) {
                $restrictedMethods = [
                    'create' => ['master-administrator', 'administrator'],
                    'store'  => ['master-administrator', 'administrator'],
                    'edit'   => ['master-administrator', 'administrator'],
                    'update' => ['master-administrator', 'administrator'],
                ];

                $method = $request->route()->getActionMethod();

                if (! isset($restrictedMethods[$method])) {
                    return $next($request);
                }

                if (! $request->user()?->hasAnyRole($restrictedMethods[$method])) {
                    $message = __('default.notification.error.restrict');
                    if ($request->expectsJson()) {
                        session()->flash('error', $message);
                        return response()->json(['status'  => 'error', 'redirect_url' => url('/dashboard')], 200);
                    }
                    return redirect('/dashboard')->with('error', $message);
                }

                return $next($request);
            }

        ];
    }

    /**
     **************************************************
     * @return CONSTRUCT
     **************************************************
     **/

    public function __construct()
    {
        $this->model            = 'App\Models\Backend\__System\Application\Datatable\General';
        $this->path             = 'pages.backend.__system.application.datatable.general.';
        $this->url              = '/dashboard/applications/datatables/generals';
        $this->sort             = '1, desc';
        $this->status           = 'default';

        app()->instance('current.model', $this->model);
        app()->instance('current.url', $this->url);
    }

    use DefaultController;
    use ExtensionController;
    use HandlesFormRequest;

    public function store(StoreRequest $request) {}
    public function update(UpdateRequest $request, $id) {}

    public function exportPdf(Request $request)
    {

        // $start = $request->input('start', 0);
        // $length = $request->input('length', 10);

        // $users = $this->model::skip($start)->take($length)->get();

        $ids = $request->input('ids');
        $length = $request->input('length'); // string "1,2,3" atau kosong
        $columns = $request->input('columns', []); // array dari Blade

        if ($ids) {
            $idsArray = explode(',', $ids);
            $data = $this->model::whereIn('id', $idsArray)->get();
        } else {
            $data = $this->model::paginate($length); // atau data per halaman
        }

        // buat field mapping otomatis: ambil lowercase dan replace spasi
        $fields = array_map(function ($col) {
            return [
                'label' => $col,
                'field' => strtolower(str_replace(' ', '_', $col))
            ];
        }, $columns);

        $pdf = PDF::loadView('users_pdf', [
            'title' => 'Export Data',
            'data' => $data,
            'columns' => $fields
        ]);

        return $pdf->download('export.pdf');
    }
}
