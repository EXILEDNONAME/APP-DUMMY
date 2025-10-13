@extends('layouts.backend.__templates.index', ['active' => 'true'])
@section('title', 'Management Permissions')

@section('table-header')
<th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Role </span><span class="kt-table-col-sort"></span></span></th>
<th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> User </span><span class="kt-table-col-sort"></span></span></th>
<th class="w-full"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Created By </span><span class="kt-table-col-sort"></span></span></th>
@endsection

@section('table-body')
{ data: 'role', 'className': 'text-nowrap' },
{ data: 'user' },
{ data: 'created_by' },
@endsection
