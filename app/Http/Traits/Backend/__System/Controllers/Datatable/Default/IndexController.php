<?php

namespace App\Http\Traits\Backend\__System\Controllers\Datatable\Default;

use \Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;

trait IndexController
{
    protected $model, $path, $url, $sort, $status;
    protected $table_relation_1, $table_relation_2, $table_relation_3, $table_relation_4, $table_relation_5;

    public function index()
    {
        $statusName = property_exists($this, 'status') && $this->status ? $this->status : 'default';
        $statusFilter = DB::table('system_status_filters')->where('name', $statusName)->first();
        $attributes = json_decode($statusFilter->properties ?? '[]', true);

        $model = $this->model;
        $sort = $this->sort;

        if (request()->ajax()) {
            $query = $this->model::query();

            if (request('date')) {
                $query->whereDate('date', request('date'));
            }
            if (request('date_start') && request('date_end')) {
                $query->whereBetween('date_start', [request('date_start'), request('date_end')]);
            }

            $datatable = DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('date', function ($order) {
                    return empty($order->date) ? NULL : \Carbon\Carbon::parse($order->date)->format('d F Y');
                })
                ->editColumn('date_start', function ($order) {
                    return empty($order->date_start) ? NULL : \Carbon\Carbon::parse($order->date_start)->format('d F Y');
                })
                ->editColumn('date_end', function ($order) {
                    return empty($order->date_end) ? NULL : \Carbon\Carbon::parse($order->date_end)->format('d F Y');
                })
                ->editColumn('description', function ($order) {
                    return nl2br(e($order->description));
                })
                ->editColumn('file', function ($order) {
                    if (!$order->file) {
                        return '<span class="text-muted"> - </span>';
                    }
                    $imgUrl = env("APP_URL") . '/storage/files/form-uploads/' . $order->file;
                    $modalId = 'modal-file-' . $order->id;
                    $baseUrl = config('app.url');
                    $placeholder = "$baseUrl/assets/backend/media/images/image-placeholder.png";
                    return <<<HTML
                        <a href="javascript:void(0);" data-kt-modal-toggle="#$modalId"><i class="ki-filled ki-picture"></i></a>
                            <div class="kt-modal" data-kt-modal="true" id="$modalId" data-kt-modal-backdrop-static="true">
                                <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
                                    <div class="kt-modal-header">
                                        <h3 class="kt-modal-title text-sm">
                                            Preview
                                        </h3>
                                        <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true">
                                            <i class="ki-filled ki-cross">
                                            </i>
                                        </button>
                                    </div>
                                    <div class="kt-modal-body grid gap-5 px-0 py-5">
                                        <div class="flex flex-col items-center px-5 gap-2.5">
                                            <img width="100%" src="$placeholder" data-src="$imgUrl" class="lazy-img" loading="lazy" alt="Preview">
                                        </div>
                                    </div>
                                    <div class="kt-modal-footer">
                                        <div></div>
                                        <div class="flex gap-2">
                                            <a href="$imgUrl" download="{$order->file}"><button class="kt-btn"> Download </button></a>
                                            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> Done </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        HTML;
                    return $html;
                });
            if ($this->table_relation_1 instanceof \Closure) {
                $datatable = ($this->table_relation_1)($datatable);
            }
            if ($this->table_relation_2 instanceof \Closure) {
                $datatable = ($this->table_relation_2)($datatable);
            }
            if ($this->table_relation_3 instanceof \Closure) {
                $datatable = ($this->table_relation_3)($datatable);
            }
            if ($this->table_relation_4 instanceof \Closure) {
                $datatable = ($this->table_relation_4)($datatable);
            }
            if ($this->table_relation_5 instanceof \Closure) {
                $datatable = ($this->table_relation_5)($datatable);
            }
            return $datatable->rawColumns(['description', 'file'])->make(true);
        }
        return view($this->path . 'index', compact(['attributes', 'model', 'sort']));
    }
}
