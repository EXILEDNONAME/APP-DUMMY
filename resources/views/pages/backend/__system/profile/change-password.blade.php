@extends('layouts.backend.default')
@section('title', 'Change Password')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.change_password') }} </h3>
            </div>
            <form method="POST" id="exilednoname-form" action="{{ URL::current() }}/../update-password" accept-charset="UTF-8" class="kt-form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="kt-card-content p-7.5 grid gap-5">

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> {{ __('default.label.current_password') }} </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::password('current-password')->class($errors->has('current-password') ? 'kt-input w-full is-invalid' : 'kt-input w-full')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> {{ __('default.label.new_password') }} </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::password('new-password')->class($errors->has('new-password') ? 'kt-input w-full is-invalid' : 'kt-input w-full')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> {{ __('default.label.confirm_password') }} </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::password('confirm-password')->class($errors->has('confirm-password') ? 'kt-input w-full is-invalid' : 'kt-input w-full')->required() }}
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