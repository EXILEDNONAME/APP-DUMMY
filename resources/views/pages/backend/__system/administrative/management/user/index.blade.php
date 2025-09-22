@extends('layouts.backend.__templates.index', ['active' => 'true'])
@section('title', 'Management Users')

@section('table-header')
<th> Avatar </th>
<th> Name </th>
<th> Username </th>
<th> Email </th>
<th> Phone </th>
@endsection

@section('table-body')
{ data: 'avatar', orderable: false, 'className': 'align-middle text-center', 'width': '1', },
{ data: 'name' },
{ data: 'username' },
{ data: 'email' },
{ data: 'phone' },
@endsection
