@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-2">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title"> Highlights </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-pencil"></i></button>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-scan-barcode"></i></button>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="lg:col-span-1">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title"> Activities </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-arrows-circle"></i></button>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-printer"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection