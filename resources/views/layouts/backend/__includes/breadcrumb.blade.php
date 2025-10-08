<div class="lg:col-span-3">
    <div class="kt-card kt-card-grid h-full min-w-full">
        <div class="kt-card-content justify-between flex px-5 p-2 w-full">
            <ol class="kt-breadcrumb flex items-center">
                <li class="kt-breadcrumb-item">
                    <a href="/dashboard" class="kt-breadcrumb-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house" aria-hidden="true">
                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                            <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        </svg>
                    </a>
                </li>
                <li class="kt-breadcrumb-separator">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </li>
                <li class="kt-breadcrumb-item"><span class="kt-breadcrumb-page font-bold"> @yield('title') </span></li>
            </ol>

            <div class="flex">
                <button type="button" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_activities" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-graph-3"></i></button>
                <button type="button" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_trash" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-trash"></i></button>
            </div>

        </div>
    </div>
</div>