@extends('layouts.backend.__templates.trash', [])
@section('title', 'Management Roles')

@section('table-header')
<th class="w-full"><span class="kt-table-col flex items-center justify-between"><span class="kt-table-col-label kt-card-title text-sm"> Name </span><span class="kt-table-col-sort"></span></span></th>
@endsection

@section('table-body')
{ data: 'name', 'className': 'text-nowrap' },
@endsection
