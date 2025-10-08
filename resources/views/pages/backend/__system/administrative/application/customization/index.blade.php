@extends('layouts.backend.default', ['administrative' => 'true'])
@section('title', 'Customizations')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.customizations') }} </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <div id="tooltip_back" class="kt-tooltip">
                        Back
                    </div>
                </div>
            </div>
            <form method="POST" id="exilednoname-form" action="{{ URL::current() }}/update" accept-charset="UTF-8" class="kt-form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="kt-card-content p-7.5 grid gap-5">

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Application </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::select('topbar_application', ['1' => __('default.label.yes'), '0' => __('default.label.no')], (isset($data->topbar_application) ? $data->topbar_application : '1'))->class($errors->has('topbar_application') ? 'kt-input w-full is-invalid' : 'kt-input w-full')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Chat </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::select('topbar_chat', ['1' => __('default.label.yes'), '0' => __('default.label.no')], (isset($data->topbar_chat) ? $data->topbar_chat : '1'))->class($errors->has('topbar_chat') ? 'kt-input w-full is-invalid' : 'kt-input w-full')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Notification </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::select('topbar_notification', ['1' => __('default.label.yes'), '0' => __('default.label.no')], (isset($data->topbar_notification) ? $data->topbar_notification : '1'))->class($errors->has('topbar_notification') ? 'kt-input w-full is-invalid' : 'kt-input w-full')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Search </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::select('topbar_search', ['1' => __('default.label.yes'), '0' => __('default.label.no')], (isset($data->topbar_search) ? $data->topbar_search : '1'))->class($errors->has('topbar_search') ? 'kt-input w-full is-invalid' : 'kt-input w-full')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="kt-btn kt-btn-primary">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection