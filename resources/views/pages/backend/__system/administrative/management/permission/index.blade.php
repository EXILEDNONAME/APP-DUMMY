@extends('layouts.backend.__templates.index', ['active' => 'true'])
@section('title', 'Management Permissions')

@section('table-header')
<th> Role </th>
<th> User </th>
<th> Created By </th>
@endsection

@section('table-body')
{ data: 'role' },
{ data: 'user' },
{ data: 'created_by' },
@endsection
