@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.edit') }} </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <a href="{{ $url }}"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_back" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-black-right-line"></i></button></a>
                </div>
            </div>
            <form method="POST" id="exilednoname-form" action="{{ URL::current() }}/../" accept-charset="UTF-8" class="kt-form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="kt-card-content p-7.5 grid gap-5">
                    <input name="id" type="hidden" value="{{ $data->id }}">
                    <input name="updated_by" type="hidden" value="{{ Auth::User()->id }}">
                    @include($path . 'form', ['formMode' => 'edit'])
                    @include('layouts.backend.__extensions.form.date')
                    @include('layouts.backend.__extensions.form.daterange')
                    @include('layouts.backend.__extensions.form.status')
                    @include('layouts.backend.__extensions.form.active')
                    @include('layouts.backend.__extensions.form.file', ['formMode' => 'edit'])
                </div>
            </form>
            <div class="kt-card-footer flex justify-end space-x-2">
                <a href="{{ $url }}"><button class="kt-btn kt-btn-mono"> {{ __('default.label.back') }} </button></a>
                <button type="submit" form="exilednoname-form" class="kt-btn kt-btn-primary"> {{ __('default.label.save_changes') }} </button>
            </div>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalPicture">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header">
            <h3 class="kt-modal-title text-sm"> {{ __('default.label.preview') }} </h3>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true"><i class="ki-filled ki-cross"></i></button>
        </div>
        <div class="kt-modal-body grid gap-5 px-0 py-5">
            <div class="flex flex-col items-center px-5 gap-2.5">
                <img width="100%" data-src="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" class="lazy-img" loading="lazy" alt="Preview">
            </div>
        </div>
        <div class="kt-modal-footer">
            <div></div>
            <div class="flex gap-2">
                <a href="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" download="{{ $data->file }}"><button class="kt-btn kt-btn-sm"><i class="ki-filled ki-cloud-download"></i> {{ __('default.label.download') }} </button></a>
                <button class="kt-btn kt-btn-sm kt-btn-mono" data-kt-modal-dismiss="#modalPicture"> {{ __('default.label.close') }} </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/exilednoname-dt-form.js"></script>
@endpush