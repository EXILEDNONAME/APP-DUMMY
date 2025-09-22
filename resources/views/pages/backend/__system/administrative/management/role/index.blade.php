@extends('layouts.backend.__templates.index', ['active' => 'true'])
@section('title', 'Management Roles')

@section('table-header')
<th> Name </th>
<th> View </th>
<th> Created By </th>
@endsection

@section('table-body')
{ data: 'name' },
{ data: 'view' },
{ data: 'created_by' },
@endsection
