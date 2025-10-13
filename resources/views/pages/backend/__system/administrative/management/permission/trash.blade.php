@extends('layouts.backend.__templates.trash', [])
@section('title', 'Management Permissions')

@section('table-header')
<th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Role </span><span class="kt-table-col-sort"></span></span></th>
<th class="w-full"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> User </span><span class="kt-table-col-sort"></span></span></th>
@endsection

@section('table-body')
{ data: 'role_id', 'className': 'text-nowrap' },
{ data: 'model_id' },
@endsection
