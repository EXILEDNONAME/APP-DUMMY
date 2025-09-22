@extends('layouts.backend.__templates.index', ['active' => 'true'])
@section('title', 'Datatable Relations')

@section('table-header')
<th> Table General </th>
<th> Description </th>
@endsection

@section('table-body')
{ data: 'id_table_general' },
{ data: 'description' },
@endsection