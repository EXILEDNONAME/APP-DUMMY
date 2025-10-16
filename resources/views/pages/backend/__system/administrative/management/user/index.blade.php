@extends('layouts.backend.__templates.index', ['active' => 'true', 'extension' => 'management-users'])
@section('title', 'Management Users')

@section('table-header')
<th class="w-full"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Name </span><span class="kt-table-col-sort"></span></span></th>
<th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Username </span><span class="kt-table-col-sort"></span></span></th>
<th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Email </span><span class="kt-table-col-sort"></span></span></th>
<th class="w-px whitespace-nowrap"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Phone </span><span class="kt-table-col-sort"></span></span></th>
@endsection

@section('table-body')
{ data: 'name' },
{ data: 'username' },
{ data: 'email' },
{ data: 'phone' },
@endsection
