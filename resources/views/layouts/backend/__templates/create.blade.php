@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title"> Create </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <a href="{{ $url }}"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_back" data-kt-tooltip-placement="bottom-start"><i class="ki-filled ki-arrow-up-right"></i></button></a>
                    <div id="tooltip_back" class="kt-tooltip">
                        Back
                    </div>
                </div>
            </div>
            <div class="kt-card-content lg:p-7.5 grid gap-5">
                <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5" bis_skin_checked="1">
                    <label class="kt-form-label max-w-56">
                        Webhook URL
                    </label>
                    <div class="grow" bis_skin_checked="1">
                        <input class="kt-input" placeholder="Enter URL" type="text" value="">
                    </div>
                </div>
                <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5" bis_skin_checked="1">
                    <label class="kt-form-label max-w-56">
                        Webhook Name
                    </label>
                    <div class="grow" bis_skin_checked="1">
                        <input class="kt-input" placeholder="" type="text" value="CostaRicaHook">
                    </div>
                </div>
                <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5 mb-2.5" bis_skin_checked="1">
                    <label class="kt-form-label max-w-56">
                        Active
                    </label>
                    <div class="grow" bis_skin_checked="1">
                        <label class="kt-label">
                            <input checked="" class="kt-switch" type="checkbox" value="1">
                        </label>
                    </div>
                </div>
                <div class="flex justify-end" bis_skin_checked="1">
                    <button class="kt-btn kt-btn-primary">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection