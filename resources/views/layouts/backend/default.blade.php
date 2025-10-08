<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.backend.__includes.head')

<body class="antialiased flex h-full text-base text-foreground bg-background exilednoname kt-sidebar-fixed kt-header-fixed">

    <div class="flex grow">
        <div class="kt-sidebar bg-background border-e border-e-border fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0 [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false]" data-kt-drawer="true" data-kt-drawer-class="kt-drawer kt-drawer-start top-0 bottom-0" id="sidebar">
            @include('layouts.backend.__includes.header')
            @include('layouts.backend.__includes.sidebar')
        </div>

        <div class="kt-wrapper flex grow flex-col">

            <header class="kt-header fixed top-0 z-10 start-0 end-0 flex items-stretch shrink-0 bg-background" data-kt-sticky="true" data-kt-sticky-class="border-b border-border" data-kt-sticky-name="header" id="header">
                <div class="kt-container-fluid flex justify-between items-stretch lg:gap-4" id="headerContainer">
                    @include('layouts.backend.__includes.mobile-header')
                    @include('layouts.backend.__includes.topbar-left')
                    @include('layouts.backend.__includes.topbar-right')
                </div>
            </header>

            <main class="grow pt-5" id="content" role="content">
                <div class="kt-container-fluid" id="contentContainer"></div>
                <div class="kt-container-fluid">
                    <div class="grid gap-5 lg:gap-7.5">
                        <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">

                            @include('layouts.backend.__includes.breadcrumb')
                            @yield('content')

                        </div>
                        <!-- end: grid -->
                    </div>
                </div>
                <!-- End of Container -->
            </main>
            <!-- End of Content -->
            <!-- Footer -->
            @include('layouts.backend.__includes.footer')
        </div>
    </div>
    
    @include('layouts.backend.__includes.modal-search')
    @include('layouts.backend.__includes.js')

    <div class="kt-modal" data-kt-modal="true" id="modalLogout">
        <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
            <div class="kt-modal-header items-center justify-center">
                <h3 class="kt-modal-title text-sm">
                    Are You Sure Logout This Session?
                </h3>
            </div>

            <div class="kt-modal-footer flex justify-center gap-2 p-4 border-t">
                <button id="confirmLogoutBtn" class="kt-btn flex items-center gap-2">
                    Yes
                </button>
                <button id="cancelLogoutBtn" class="kt-btn kt-btn-mono" data-kt-modal-dismiss="#modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>



</body>

</html>