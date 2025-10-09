@extends('layouts.backend.default')
@section('title', 'Change Password')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.account-informations') }} </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <div id="tooltip_back" class="kt-tooltip">
                        Back
                    </div>
                </div>
            </div>
            <form method="POST" id="exilednoname-form" action="{{ URL::current() }}/../update-password" accept-charset="UTF-8" class="kt-form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="kt-card-content p-7.5 grid gap-5">

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Avatar </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::text('name', (isset($data->name) ? $data->name : ''))->class([ $errors->has('name ') ? 'kt-input w-full is-invalid' : 'kt-input w-full'])->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Name </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::text('name', (isset($data->name) ? $data->name : ''))->class([ $errors->has('name ') ? 'kt-input w-full is-invalid' : 'kt-input w-full'])->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Email </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::email('email', (isset($data->email) ? $data->email : ''))->class([ $errors->has('email') ? 'kt-input w-full is-invalid' : 'kt-input w-full'])->isReadOnly() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Phone </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::text('phone', (isset($data->phone) ? $data->phone : ''))->class([ $errors->has('phone ') ? 'kt-input w-full is-invalid' : 'kt-input w-full'])->isReadOnly() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Username </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::text('username', (isset($data->username) ? $data->username : ''))->class([ $errors->has('username ') ? 'kt-input w-full is-invalid' : 'kt-input w-full'])->isReadOnly() }}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="kt-card-footer flex justify-end space-x-2">
                <button type="submit" form="exilednoname-form" class="kt-btn kt-btn-primary"> {{ __('default.label.save_changes') }} </button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b" data-card="true" id="exilednoname_card">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"> {{ __('default.label.change-password') }} </h3>
                </div>
                <div class="card-toolbar">
                    <a href="javascript:void(0);" class="btn btn-icon btn-xs btn-hover-light-primary" data-card-tool="toggle"><i class="fas fa-caret-down"></i></a>
                </div>
            </div>

            <div class="card-body">
                <form id="exilednoname-form" method="POST" action="{{ URL::current() }}/../update-password" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label class="col-4 col-form-label"> Current Password </label>
                        <div class="col-8">
                            {{ Html::password('current-password')->class($errors->has('current-password') ? 'form-control is-invalid' : 'form-control')->required() }}
                            @error('current-password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-4 col-form-label"> New Password </label>
                        <div class="col-8">
                            {{ Html::password('new-password')->class($errors->has('new-password') ? 'form-control is-invalid' : 'form-control')->required() }}
                            @error('new-password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-4 col-form-label"> Confirm Password </label>
                        <div class="col-8">
                            {{ Html::password('confirm-password')->class($errors->has('confirm-password') ? 'form-control is-invalid' : 'form-control')->required() }}
                            @error('confirm-password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>

                </form>
                <div class="form-group row">
                    <div class="col-4"></div>
                    <div class="col-8">
                        <button type="submit" form="exilednoname-form" class="btn btn-success font-weight-bold mr-2"><span class="ml-1 mr-1"> {{ __('default.label.save') }} </span></button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection