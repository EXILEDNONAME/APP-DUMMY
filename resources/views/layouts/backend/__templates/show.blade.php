@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-2">
    <div class="grid">
        <div id="printData">
            <div class="kt-card kt-card-grid h-full min-w-full">
                <div class="kt-card-header">
                    <h3 class="kt-card-title text-sm grid gap-5"> Details </h3>
                    <div class="kt-menu" data-kt-menu="true">
                        <a href="{{ URL::Current() }}/edit"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_edit" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-pencil"></i></button></a>
                        <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_print" data-kt-tooltip-placement="top-end" onclick="printData('printData')"><i class="ki-filled ki-printer"></i></button>
                        <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" class="kt-btn" data-kt-modal-toggle="#modalScan" data-kt-tooltip="#tooltip_qrcode" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-scan-barcode"></i></button>
                        <form method="POST" action="{{ URL::current() }}/../{{ $data->id }}" class="form-horizontal delete-form" enctype="multipart/form-data">
                            @method('DELETE')
                            @csrf
                            <button type="button" class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-modal-toggle="#modalDeleteStatic" data-kt-tooltip="#tooltip_delete" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-trash"></i></button>
                        </form>
                        @if(!empty($extension) && $extension == 'management-users')
                        <form method="POST" action="{{ URL::current() }}/../reset-password-static/{{ $data->id }}" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" class="kt-btn" data-kt-modal-toggle="#modalResetPasswordStatic" data-kt-tooltip="#tooltip_reset_password" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-key"></i></button>
                        </form>
                        @endif
                        <a href="{{ $url }}"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_back" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-black-right-line"></i></button></a>
                    </div>
                </div>

                <div class="kt-card-content">
                    <table class="kt-table w-full" width="100%">
                        @if(!empty($data->file))
                        <tr>
                            <td class="align-middle text-nowrap"> {{ __('default.label.file') }} </td>
                            <td class="">
                                <a href="javascript:void(0);" data-kt-modal-toggle="#modalPicture" data-kt-tooltip="#tooltip_preview" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-picture"></i></a>
                                <div class="kt-modal" data-kt-modal="true" id="modalPicture">
                                    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
                                        <div class="kt-modal-header">
                                            <h3 class="kt-modal-title text-sm"> {{ __('default.label.preview') }} </h3>
                                            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true"><i class="ki-filled ki-cross"></i></button>
                                        </div>
                                        <div class="kt-modal-body grid gap-5 px-0 py-5">
                                            <div class="flex flex-col items-center px-5 gap-2.5">
                                                <img data-src="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" class="lazy-img" loading="lazy" alt="Preview">
                                            </div>
                                        </div>
                                        <div class="kt-modal-footer">
                                            <div></div>
                                            <div class="flex gap-2">
                                                <a href="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" download="{{ $data->file }}"><button class="kt-btn kt-btn-sm"><i class="ki-filled ki-cloud-download"></i> {{ __('default.label.download') }} </button></a>
                                                <button class="kt-btn kt-btn-sm kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.close') }} </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @endif

                        @if(!empty($data->date))
                        <tr>
                            <td class="align-middle text-nowrap"> {{ __('default.label.date') }} </td>
                            <td> {{ !empty($data->date) ? \Carbon\Carbon::parse($data->date)->format('d F Y') : '-' }} </td>
                        </tr>
                        @endif
                        @if(!empty($data->date_start))
                        <tr>
                            <td class="align-middle text-nowrap"> {{ __('default.label.date_start') }} </td>
                            <td> {{ !empty($data->date_start) ? \Carbon\Carbon::parse($data->date_start)->format('d F Y') : '-' }} </td>
                        </tr>
                        @endif
                        @if(!empty($data->date_end))
                        <tr>
                            <td class="align-middle text-nowrap"> {{ __('default.label.date_end') }} </td>
                            <td> {{ !empty($data->date_end) ? \Carbon\Carbon::parse($data->date_end)->format('d F Y') : '-' }} </td>
                        </tr>
                        @endif
                        @yield('table-header')
                        <tr>
                            <td class="align-middle text-nowrap"> {{ __('default.label.active') }} </td>
                            <td> {{ $data->active == 1 ? __('default.label.yes') : __('default.label.no') }} </td>
                        </tr>
                        @if(!empty($data->status))
                        <tr>
                            <td class="align-middle text-nowrap"> {{ __('default.label.status') }} </td>
                            <td>
                                @if( $data->status == 1 ) <span class="text-black"> {{ __('default.label.default') }} </span>
                                @elseif( $data->status == 2 ) <span class="text-yellow-600"> {{ __('default.label.pending') }} </span>
                                @elseif( $data->status == 3 ) <span class="text-violet-500"> {{ __('default.label.progress') }} </span>
                                @elseif( $data->status == 4 ) <span class="text-green-600"> {{ __('default.label.success') }} </span>
                                @elseif( $data->status == 5 ) <span class="text-red-600"> {{ __('default.label.failed') }} </span>
                                @else {{ __('default.label.unknown') }}
                                @endif
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td class="align-middle text-nowrap"> {{ __('default.label.created_at') }} </td>
                            <td class="text-nowrap">
                                <div class="overflow-x-auto">
                                    {{ \Carbon\Carbon::parse($data->created_at)->format('d F Y, H:i') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle text-nowrap"> {{ __('default.label.updated_at') }} </td>
                            <td> {{ \Carbon\Carbon::parse($data->updated_at)->format('d F Y, H:i') }} </td>
                        </tr>
                        @if(!empty($data->created_by))
                        <tr>
                            <td class="align-middle text-nowrap"> {{ __('default.label.created_by') }} </td>
                            <td> {{ \DB::table('users')->where('id', $data->created_by)->first()->name ?? '-' }} </td>
                        </tr>
                        @endif
                        @if(!empty($data->updated_by))
                        <tr>
                            <td class="align-middle text-nowrap"> {{ __('default.label.last_updated_by') }} </td>
                            <td class="text-nowrap"> {{ \DB::table('users')->where('id', $data->updated_by)->first()->name ?? '-' }} </td>
                        </tr>
                        @endif
                        <tr>
                            <td class="w-48"></td>
                            <td class="text-nowrap"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="lg:col-span-1">
    <div class="grid">
        <div id="printDataActivities">
            <div class="kt-card kt-card-grid w-full">
                <div class="kt-card-header">
                    <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.activities') }} </h3>
                    <div class="kt-menu">
                        <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_print" data-kt-tooltip-placement="top-end" onclick="printData('printDataActivities')"><i class="ki-filled ki-printer"></i></button>
                        <a href="{{ $url }}"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_back" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-black-right-line"></i></button></a>
                    </div>
                </div>
                <div class="overflow-x-auto w-full rounded-lg">

                    <div class="kt-card-content lg:p-7.5 lg:pt-6 p-5">
                        <div class="flex flex-col" bis_skin_checked="1">

                            @php $activity = activities($model)->where('subject_id', $data->id)->take(5); @endphp
                            <div class="flex flex-col">
                                @foreach($activity as $acts)
                                @php
                                $props = json_decode($acts->properties, true) ?? [];
                                $isRestored = $acts->description === 'updated' && ($props['attributes']['deleted_at'] ?? null) === null && !empty($props['old']['deleted_at']);
                                @endphp

                                <div class="flex items-start relative">
                                    @unless($loop->last)
                                    <div class="w-9 start-0 top-9 absolute bottom-0 rtl:-translate-x-1/2 translate-x-1/2 border-s border-s-input"></div>
                                    @endunless

                                    <div class="flex items-center justify-center shrink-0 rounded-full bg-accent/60 border border-input size-9 text-secondary-foreground">
                                        @if ($acts->description == 'created') <i class="ki-filled ki-plus"></i>
                                        @elseif ($isRestored) <i class="ki-filled ki-arrows-circle"></i>
                                        @elseif ($acts->description == 'updated') <i class="ki-filled ki-pencil"></i>
                                        @elseif ($acts->description == 'deleted') <i class="ki-filled ki-trash"></i>
                                        @endif
                                    </div>

                                    <div class="ps-2.5 text-base grow {{ !$loop->last ? 'mb-7' : '' }}">
                                        <div class="flex flex-col">
                                            <div class="text-sm text-foreground whitespace-nowrap">
                                                @if ($acts->description == 'created')
                                                {{ __('default.activity.item-created') }} {{ mb_strimwidth($props['attributes']['name'] ?? $data_object['name'] ?? '', 0, 10, ' ...') }}
                                                @elseif ($isRestored)
                                                {{ __('default.activity.item-restored') }} {{ mb_strimwidth($props['attributes']['name'] ?? '', 0, 10, ' ...') }}
                                                @elseif ($acts->description == 'updated')
                                                {{ __('default.activity.item-updated') }} {{ $props['attributes']['name'] }}
                                                @elseif ($acts->description == 'deleted')
                                                {{ __('default.activity.item-deleted') }} {{ mb_strimwidth($props['attributes']['name'] ?? '', 0, 10, ' ...') }}
                                                @endif
                                            </div>
                                            <span class="text-xs text-secondary-foreground">
                                                {{ $acts->created_at->diffForHumans() }}, {{ $acts->causer->name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalScan" data-kt-modal-backdrop-static="true">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header">
            <h3 class="kt-modal-title text-sm">
                {{ __('default.label.scan_code') }}
            </h3>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="kt-modal-body grid gap-5 px-0 py-5">
            <div class="flex flex-col items-center px-5 gap-2.5">
                <div id="printQR">
                    {!! QrCode::size(250)->generate(URL::current()); !!}
                </div>
            </div>
        </div>
        <div class="kt-modal-footer">
            <div></div>
            <div class="flex gap-2">
                <button class="kt-btn" onclick="printQR('printQR')"><i class="ki-filled ki-printer"></i> {{ __('default.label.print') }} </button>
                <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.close') }} </button>
            </div>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalDeleteStatic">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.notification.confirm.delete') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-delete-static"> {{ __('default.label.yes') }} </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.cancel') }} </button>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modalResetPasswordStatic">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header flex justify-center items-center">
            <h3 class="kt-modal-title text-sm text-center">
                {{ __('default.notification.confirm.reset_password') }}?
            </h3>
        </div>
        <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
            <button class="kt-btn flex items-center gap-2 btn-confirm-reset-password-static"> {{ __('default.label.yes') }} </button>
            <button class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal"> {{ __('default.label.cancel') }} </button>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/exilednoname-dt-plugins.js"></script>
@endpush