@extends('layouts.backend.__templates.index', ['active' => 'true'])
@section('title', 'Management Roles')

@section('table-header')
<th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Name </span><span class="kt-table-col-sort"></span></span></th>
<th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> View </span><span class="kt-table-col-sort"></span></span></th>
<th class="w-full"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Created By </span><span class="kt-table-col-sort"></span></span></th>
@endsection

@section('table-body')
{ data: 'name', 'className': 'text-nowrap' },
{ data: 'view', 'className': 'text-nowrap' },
{ data: 'created_by' },
@endsection
