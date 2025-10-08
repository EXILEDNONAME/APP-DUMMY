@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.create') }} </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <a href="{{ $url }}"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_back" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-black-right-line"></i></button></a>
                </div>
            </div>
            <form method="POST" id="exilednoname-form" action="{{ URL::current() }}/../" accept-charset="UTF-8" class="kt-form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="kt-card-content p-7.5 grid gap-5">
                    <input name="created_by" type="hidden" value="{{ Auth::User()->id }}">
                    @include($path . 'form', ['formMode' => 'create'])
                    @include('layouts.backend.__extensions.form.date')
                    @include('layouts.backend.__extensions.form.daterange')
                    @include('layouts.backend.__extensions.form.status')
                    @include('layouts.backend.__extensions.form.active')
                    @include('layouts.backend.__extensions.form.file', ['formMode' => 'create'])
                </div>
            </form>
            <div class="kt-card-footer flex justify-end space-x-2">
                <a href="{{ $url }}"><button class="kt-btn kt-btn-mono"> {{ __('default.label.back') }} </button></a>
                <button type="submit" form="exilednoname-form" class="kt-btn kt-btn-primary"> {{ __('default.label.save_changes') }} </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/exilednoname-dt-form.js"></script>
@endpush