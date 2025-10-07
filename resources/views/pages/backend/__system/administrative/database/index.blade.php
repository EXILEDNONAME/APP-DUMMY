@extends('layouts.backend.default', ['administrative' => 'true'])
@section('title', 'Administrative Databases')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b" data-card="true" id="exilednoname_card">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"> {{ __('default.label.databases') }} </h3>
                </div>
                <div class="card-toolbar">
                    <a id="create-backup" class="btn btn-icon btn-xs btn-hover-light-primary" data-toggle="tooltip" data-original-title="{{ __('default.label.create_backup') }}"><i class="fas fa-database text-info"></i></a>
                    <a id="table-reset" class="btn btn-icon btn-xs btn-hover-light-primary" data-toggle="tooltip" data-original-title="{{ __('default.label.reset') }}"><i class="fas fa-redo-alt text-danger"></i></a>
                    <a id="table_refresh" class="btn btn-icon btn-xs btn-hover-light-primary" data-toggle="tooltip" data-original-title="{{ __('default.label.refresh') }}"><i class="fas fa-sync-alt"></i></a>
                    <a href="#" class="btn btn-icon btn-xs btn-hover-light-primary" data-card-tool="toggle"><i class="fas fa-caret-down"></i></a>
                </div>
            </div>
            <div class="card-body" id="exilednoname_body">
                <div class="row dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="col-sm-12 col-md-6">
                        <div id="ex_table_length"></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="ex_table_filter"></div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table width="100%" class="table table-hover table-checkable table-sm rounded" id="exilednoname_table">
                        <thead>
                            <tr>
                                <th> No. </th>
                                <th class="text-nowrap"> Date </th>
                                <th class="text-nowrap"> Name </th>
                                <th class="text-nowrap"> </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="row dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="col-sm-12 col-md-5">
                        <div id="ex_table_info"></div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div id="ex_table_paginate"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ env('APP_URL') }}{{ env('APP_URL') }}/assets/backend/mix/js/datatable.js"></script>
<script src="{{ env('APP_URL') }}{{ env('APP_URL') }}/assets/backend/mix/js/datatable-database.js"></script>
@endpush