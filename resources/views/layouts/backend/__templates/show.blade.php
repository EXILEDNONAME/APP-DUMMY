@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-2">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title"> Details </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <a href="{{ URL::Current() }}/edit"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_edit" data-kt-tooltip-placement="bottom-start"><i class="ki-filled ki-pencil"></i></button></a>
                    <div id="tooltip_edit" class="kt-tooltip">
                        Edit
                    </div>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" class="kt-btn" data-kt-modal-toggle="#modal" data-kt-tooltip="#tooltip_qrcode" data-kt-tooltip-placement="bottom-start"><i class="ki-filled ki-scan-barcode"></i></button>
                    <div id="tooltip_qrcode" class="kt-tooltip">
                        QR Code
                    </div>
                    <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-trash"></i></button>
                </div>
            </div>
            <div class="kt-card-body">
                <table id="serverTable" class="kt-table" width="100%">
                    <!-- <table class="" data-kt-datatable-table="true" id="kt_datatable_1"> -->
                    <tbody>
                        @yield('table-header')




                    </tbody>
                </table>
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
            <div class="kt-card-content lg:p-7.5 lg:pt-6 p-5">
                <div class="flex flex-col" bis_skin_checked="1">
                    <div class="flex items-start relative" bis_skin_checked="1">
                        <div class="w-9 start-0 top-9 absolute bottom-0 rtl:-translate-x-1/2 translate-x-1/2 border-s border-s-input" bis_skin_checked="1">
                        </div>
                        <div class="flex items-center justify-center shrink-0 rounded-full bg-accent/60 border border-input size-9 text-secondary-foreground" bis_skin_checked="1">
                            <i class="ki-filled ki-people text-base">
                            </i>
                        </div>
                        <div class="ps-2.5 mb-7 text-base grow" bis_skin_checked="1">
                            <div class="flex flex-col" bis_skin_checked="1">
                                <div class="text-sm text-foreground" bis_skin_checked="1">
                                    Posted a new article
                                    <a class="text-sm font-medium kt-link" href="/metronic/tailwind/demo1/public-profile/profiles/blogger">
                                        Top 10 Tech Trends
                                    </a>
                                </div>
                                <span class="text-xs text-secondary-foreground">
                                    Today, 9:00 AM
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start relative" bis_skin_checked="1">
                        <div class="w-9 start-0 top-9 absolute bottom-0 rtl:-translate-x-1/2 translate-x-1/2 border-s border-s-input" bis_skin_checked="1">
                        </div>
                        <div class="flex items-center justify-center shrink-0 rounded-full bg-accent/60 border border-input size-9 text-secondary-foreground" bis_skin_checked="1">
                            <i class="ki-filled ki-entrance-left text-base">
                            </i>
                        </div>
                        <div class="ps-2.5 mb-7 text-base grow" bis_skin_checked="1">
                            <div class="flex flex-col" bis_skin_checked="1">
                                <div class="text-sm text-foreground" bis_skin_checked="1">
                                    I had the privilege of interviewing an industry expert for an
                                    <a class="text-sm kt-link" href="/metronic/tailwind/demo1/public-profile/profiles/blogger">
                                        upcoming blog post
                                    </a>
                                </div>
                                <span class="text-xs text-secondary-foreground">
                                    2 days ago, 4:07 PM
                                </span>
                            </div>
                        </div>
                    </div>
                   
                    
                    
                    
                    
                    
                    
                
                    
                    <div class="flex items-start relative" bis_skin_checked="1">
                        <div class="flex items-center justify-center shrink-0 rounded-full bg-accent/60 border border-input size-9 text-secondary-foreground" bis_skin_checked="1">
                            <i class="ki-filled ki-cup text-base">
                            </i>
                        </div>
                        <div class="ps-2.5 text-base grow" bis_skin_checked="1">
                            <div class="flex flex-col" bis_skin_checked="1">
                                <div class="text-sm text-foreground" bis_skin_checked="1">
                                    We recently
                                    <a class="text-sm font-medium kt-link" href="/metronic/tailwind/demo1/public-profile/profiles/nft">
                                        celebrated
                                    </a>
                                    the blog's 1-year anniversary
                                </div>
                                <span class="text-xs text-secondary-foreground">
                                    3 months ago, 4:07 PM
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="kt-modal" data-kt-modal="true" id="modal">
    <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
        <div class="kt-modal-header">
            <h3 class="kt-modal-title">
                Share Profile
            </h3>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="kt-modal-body grid gap-5 px-0 py-5">
            <div class="flex flex-col items-center px-5 gap-2.5">
                {!! QrCode::size(250)->generate(URL::current()); !!}
            </div>
        </div>
        <div class="kt-modal-footer">
            <div></div>
            <div class="flex gap-4">
                <button
                    class="kt-btn kt-btn-secondary"
                    data-kt-modal-dismiss="#modal">
                    Cancel</button><button class="kt-btn"><i class="ki-filled ki-printer"></i> Print</button>
            </div>
        </div>
    </div>
</div>
@endsection