<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">

@include('layouts.backend.__includes.head')

<body class="antialiased flex h-full text-base text-foreground bg-background demo1 kt-sidebar-fixed kt-header-fixed">

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
                            <div class="lg:col-span-3">
                                <div class="grid">
                                    <div class="kt-card kt-card-grid h-full min-w-full">
                                        <div class="kt-card-header">
                                            <h3 class="kt-card-title">
                                                Teams
                                            </h3>
                                            <div class="kt-input max-w-48">
                                                <i class="ki-filled ki-magnifier">
                                                </i>
                                                <input data-kt-datatable-search="#kt_datatable_1" placeholder="Search Teams" type="text">
                                                </input>
                                            </div>
                                        </div>
                                        <div class="kt-card-table">
                                            <div class="grid" data-kt-datatable="true" data-kt-datatable-page-size="5" id="teams_datatable">
                                                <div class="kt-scrollable-x-auto">
                                                    <table class="kt-table kt-table-border table-fixed" data-kt-datatable-table="true" id="kt_datatable_1">
                                                        <thead>
                                                            <tr>
                                                                <th class="w-[50px]">
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-check="true" type="checkbox" />
                                                                </th>
                                                                <th class="w-[280px]">
                                                                    <span class="kt-table-col">
                                                                        <span class="kt-table-col-label">
                                                                            Team
                                                                        </span>
                                                                        <span class="kt-table-col-sort">
                                                                        </span>
                                                                    </span>
                                                                </th>
                                                                <th class="w-[125px]">
                                                                    <span class="kt-table-col">
                                                                        <span class="kt-table-col-label">
                                                                            Rating
                                                                        </span>
                                                                        <span class="kt-table-col-sort">
                                                                        </span>
                                                                    </span>
                                                                </th>
                                                                <th class="w-[135px]">
                                                                    <span class="kt-table-col">
                                                                        <span class="kt-table-col-label">
                                                                            Last Modified
                                                                        </span>
                                                                        <span class="kt-table-col-sort">
                                                                        </span>
                                                                    </span>
                                                                </th>
                                                                <th class="w-[125px]">
                                                                    <span class="kt-table-col">
                                                                        <span class="kt-table-col-label">
                                                                            Members
                                                                        </span>
                                                                        <span class="kt-table-col-sort">
                                                                        </span>
                                                                    </span>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="1" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Product Management
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Product development & lifecycle
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    21 Oct, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-4.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-1.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-2.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <span class="relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-2xs size-[30px] text-white ring-background bg-green-500">
                                                                                +10
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="2" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Marketing Team
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Campaigns & market analysis
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label indeterminate">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none" style="width: 50.0%">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    15 Oct, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-4.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <span class="hover:z-5 relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-2xs size-[30px] uppercase text-white ring-background bg-yellow-500">
                                                                                g
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="3" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            HR Department
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Talent acquisition, employee welfare
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    10 Oct, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-4.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-1.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-2.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <span class="relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-2xs size-[30px] text-white ring-background bg-violet-500">
                                                                                +A
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="4" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Sales Division
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Customer relations, sales strategy
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    05 Oct, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-24.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-7.png" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="5" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Development Team
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Software development
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label indeterminate">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none" style="width: 50.0%">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    01 Oct, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-3.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-8.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-9.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <span class="relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-2xs size-[30px] text-white ring-background bg-destructive">
                                                                                +5
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="6" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Quality Assurance
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Product testing
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    25 Sep, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-6.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-5.png" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="7" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Finance Team
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Financial planning
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    20 Sep, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-10.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-11.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-12.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <span class="relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-2xs size-[30px] text-primary-foreground ring-background bg-primary">
                                                                                +8
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="8" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Customer Support
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Customer service
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label indeterminate">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none" style="width: 50.0%">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    15 Sep, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-13.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-14.png" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="9" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            R&D Team
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Research & development
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    10 Sep, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-15.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-16.png" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="10" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Operations Team
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Operations management
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    05 Sep, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-17.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-18.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-19.png" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="11" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            IT Support
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Technical support
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    01 Sep, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-20.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-21.png" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="12" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Legal Team
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Legal support
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    25 Aug, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-22.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-23.png" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="13" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Logistics Team
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Supply chain
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label indeterminate">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none" style="width: 50.0%">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    20 Aug, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-24.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-25.png" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="14" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Procurement Team
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Supplier management
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    15 Aug, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-26.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-27.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-28.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <span class="relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-2xs size-[30px] text-white ring-background bg-violet-500">
                                                                                +3
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-row-check="true" type="checkbox" value="15" />
                                                                </td>
                                                                <td>
                                                                    <div class="flex flex-col gap-2">
                                                                        <a class="leading-none font-medium text-sm text-mono hover:text-primary" href="#">
                                                                            Training Team
                                                                        </a>
                                                                        <span class="text-2sm text-secondary-foreground font-normal leading-3">
                                                                            Employee training
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-rating">
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label checked">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                        <div class="kt-rating-label">
                                                                            <i class="kt-rating-on ki-solid ki-star text-base leading-none">
                                                                            </i>
                                                                            <i class="kt-rating-off ki-outline ki-star text-base leading-none">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    10 Aug, 2024
                                                                </td>
                                                                <td>
                                                                    <div class="flex -space-x-2">
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-29.png" />
                                                                        </div>
                                                                        <div class="flex">
                                                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-[30px]" src="/assets/backend/media/avatars/300-30.png" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="kt-card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-secondary-foreground text-sm font-medium">
                                                    <div class="flex items-center gap-2 order-2 md:order-1">
                                                        Show
                                                        <select class="kt-select w-16" data-kt-datatable-size="true" data-kt-select="" name="perpage">
                                                        </select>
                                                        per page
                                                    </div>
                                                    <div class="flex items-center gap-4 order-1 md:order-2">
                                                        <span data-kt-datatable-info="true">
                                                        </span>
                                                        <div class="kt-datatable-pagination" data-kt-datatable-pagination="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
</body>

</html>