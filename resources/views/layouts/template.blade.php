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
                                                Main
                                            </h3>
                                            <div class="kt-input max-w-48">
                                                <i class="ki-filled ki-magnifier">
                                                </i>
                                                <!-- <input id="searchInput" data-kt-datatable-search="#kt_datatable_1" placeholder="Search Teams" type="text">
                                                </input> -->
                                            </div>
                                        </div>
                                        <div class="kt-card-table">
                                            <!-- <div class="kt-scrollable-x-auto"> -->
                                                <table id="serverTable" class="kt-table kt-table-border">
                                                    <!-- <table class="" data-kt-datatable-table="true" id="kt_datatable_1"> -->
                                                    <thead>
                                                        <tr>
                                                            <th class="w-px whitespace-nowrap">
                                                                <span class="kt-table-col flex items-center justify-between">
                                                                    <span class="kt-table-col-label">
                                                                        ID
                                                                    </span>
                                                                    <span class="kt-table-col-sort">
                                                                    </span>
                                                                </span>
                                                            </th>
                                                            <th class="w-full whitespace-nowrap">
                                                                <span class="kt-table-col flex items-center justify-between">
                                                                    <span class="kt-table-col-label">
                                                                        Name
                                                                    </span>
                                                                    <span class="kt-table-col-sort">
                                                                    </span>
                                                                </span>
                                                            </th>
                                                            <th class="w-px whitespace-nowrap">
                                                                <span class="kt-table-col flex items-center justify-between">
                                                                    <span class="kt-table-col-label">
                                                                        Description
                                                                    </span>
                                                                    <span class="kt-table-col-sort">
                                                                    </span>
                                                                </span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            <!-- </div> -->
                                        </div>

                                        <div class="kt-card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-secondary-foreground text-sm font-medium">
                                            <div class="flex items-center gap-2 order-2 md:order-1">
                                                <!-- Show <select class="kt-select w-16" data-kt-select="" name="perpage">
                                                        </select> entries -->

                                                <!-- custom select -->
                                                <div class="flex items-center gap-2 mb-4">
                                                    <label for="perpage" class="text-sm">Show</label>
                                                    <select id="perpage" class="kt-select w-16">
                                                        <option value="25" selected>25</option>
                                                        <option value="100">100</option>
                                                        <option value="250">250</option>
                                                        <option value="500">500</option>
                                                    </select>
                                                    <span class="text-sm">entries</span>
                                                </div>
                                            </div>

                                            <div class="kt-datatable-pagination" data-kt-datatable-pagination="true">

                                            </div>

                                            <!-- <div class="row dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="col-sm-12 col-md-5">
                                                    <div id="ex_table_info"></div>
                                                </div>
                                                <div class="col-sm-12 col-md-7">
                                                    <div id="ex_table_paginate"></div>
                                                </div>-->
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#serverTable').DataTable({

                "initComplete": function(settings, json) {
                    $('#serverTable_info').appendTo('#ex_table_info');
                    $('#serverTable_paginate').appendTo('#ex_table_paginate');
                    $('#dt-length-0').appendTo('#ex_table_length');
                    $('#serverTable_filter').appendTo('#ex_table_filter');
                },

                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.system.application.datatable.generals.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'description',
                        name: 'description',
                        'className': 'text-nowrap',
                    },
                ],
                pageLength: 25,
                lengthChange: false, // 🔒 hide bawaan select length
                dom: 'tip', // hide length dropdown asli
                responsive: true,

            });

            $('#perpage').on('change', function() {
                let perPage = $(this).val();
                table.page.len(perPage).draw();
            });


            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>

</body>

</html>