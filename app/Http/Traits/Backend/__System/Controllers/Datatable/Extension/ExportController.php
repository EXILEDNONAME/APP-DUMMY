<?php

namespace App\Http\Traits\Backend\__System\Controllers\Datatable\Extension;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

trait ExportController
{
    public function exportPdf(Request $request)
    {
        $ids = $request->input('ids');
        $columns = $request->input('columns', []);
        $orderBy = $request->input('order_by', 'id');
        $orderDir = $request->input('order_dir', 'asc');
        $page = (int) $request->input('page', 1);
        $length = (int) $request->input('length', 10);

        if ($ids) {
            $idsArray = explode(',', $ids);
            $query = $this->model::whereIn('id', $idsArray);
        } else {
            $query = $this->model::query()->skip(($page - 1) * $length)->take($length);
        }

        $model = new $this->model;
        $table = $model->getTable();

        if (Schema::hasColumn($table, $orderBy)) {
            $query->orderBy($orderBy, $orderDir);
        }

        $data = $query->get();

        foreach ($data as $index => $item) {
            $item->autonumber = $index + 1;
        }

        $fields = array_map(fn($col) => [
            'label' => $col,
            'field' => strtolower(str_replace(' ', '_', $col))
        ], $columns);

        $pdf = PDF::loadView('users_pdf', [
            'title' => 'Export Data',
            'data' => $data,
            'columns' => $fields
        ]);

        return $pdf->download('export.pdf');
    }
}
