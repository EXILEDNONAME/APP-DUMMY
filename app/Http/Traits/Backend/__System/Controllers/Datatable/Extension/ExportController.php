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

        $data->each(function ($item) {
            $item->makeVisible($item->getHidden());
            $item->append([]);
        });

        $dataArray = [];
        foreach ($data as $index => $item) {
            $rowData = [];

            $rowData['autonumber'] = ($request->page - 1) * $request->length + $index + 1;

            foreach ($columns as $col) {
                $field = strtolower(str_replace(' ', '_', $col));

                $value = $item->getAttributes()[$field] ?? null;

                if ($value !== null) {
                    if (strpos($field, 'date') !== false || strpos($field, '_at') !== false || strpos($field, 'time') !== false) {
                        try {
                            $carbon = \Carbon\Carbon::parse($value);
                            // $carbon->locale('id');
                            $value = $carbon->format('d F Y');
                        } catch (\Exception $e) {
                            // 
                        }
                    }

                    if ($field === 'active') {
                        $value = $value == 1 ? 'Yes' : 'No';
                    }

                    if ($field === 'status') {
                        $value = match ((int)$value) {
                            1 => 'Default',
                            2 => 'Pending',
                            3 => 'Progress',
                            4 => 'Success',
                            5 => 'Failed',
                            default => '-',
                        };
                    }
                }

                $rowData[$field] = $value ?? '-';
            }

            $dataArray[] = $rowData;
        }

        $fields = array_map(fn($col) => [
            'label' => $col,
            'field' => strtolower(str_replace(' ', '_', $col))
        ], $columns);

        $pdf = PDF::loadView('users_pdf', [
            'title' => 'Export Data',
            'data' => $dataArray,
            'columns' => $fields
        ]);

        return $pdf->download('export.pdf');
    }
}
