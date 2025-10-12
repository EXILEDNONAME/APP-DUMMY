@extends('layouts.backend.default')
@section('title', 'Account Informations')

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
            <form method="POST" id="exilednoname-form" action="{{ URL::current() }}/update/{{ $data->id }}" accept-charset="UTF-8" class="kt-form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="kt-card-content p-7.5 grid gap-5">

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Avatar </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::text('avatar', (isset($data->avatar) ? $data->avatar : ''))->class([ $errors->has('avatar ') ? 'kt-input w-full is-invalid' : 'kt-input w-full'])->required() }}
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
@endsection