@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title">
                    Main
                </h3>

                <select
                    class="kt-select max-w-px"
                    data-kt-select="true"
                    data-kt-select-placeholder="Select Active">
                    <option value="react"> Yes </option>
                    <option value="react"> No </option>

                </select>

                <select
                    class="kt-select max-w-px"
                    data-kt-select="true"
                    data-kt-select-placeholder="Select Status">
                    <option value="react"> Pending </option>
                    <option value="react"> Success </option>
                    <option value="react"> Failed </option>

                </select>
                <div class="kt-input max-w-48">
                    <i class="ki-filled ki-magnifier">
                    </i>
                    <input id="searchInput" data-kt-datatable-search="#kt_datatable_1" placeholder="Search Teams" type="text">
                    </input>
                </div>
            </div>

            <!-- <div class="kt-card-table"> -->
            <div class="kt-scrollable-x-auto">
                <table id="serverTable" class="kt-table" width="100%">
                    <!-- <table class="" data-kt-datatable-table="true" id="kt_datatable_1"> -->
                    <thead>
                        <tr>
                            <th class="w-px whitespace-nowrap">
                                <span class="kt-table-col flex items-center justify-between">
                                    <span class="kt-table-col-label">
                                        ID
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
                            <th class="w-full">
                                <span class="kt-table-col flex items-center justify-between">
                                    <span class="kt-table-col-label">
                                        Description
                                    </span>
                                    <span class="kt-table-col-sort">
                                    </span>
                                </span>
                            </th>
                            <th class="w-full whitespace-nowrap">
                                <span class="kt-table-col flex items-center justify-between">
                                    <span class="kt-table-col-label">
                                        Active
                                    </span>
                                    <span class="kt-table-col-sort">
                                    </span>
                                </span>
                            </th>
                            <th class="w-full whitespace-nowrap">
                                <span class="kt-table-col flex items-center justify-between">
                                    <span class="kt-table-col-label">
                                        Status
                                    </span>
                                    <span class="kt-table-col-sort">
                                    </span>
                                </span>
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="kt-card-footer flex flex-col md:flex-row justify-center md:justify-between gap-5 text-secondary-foreground text-sm font-medium">
                <!-- Kiri: Show entries -->
                <div class="flex items-center gap-2 order-2 md:order-1">
                    <label for="perpage" class="text-sm">Show</label>
                    <select id="perpage" class="kt-select w-16 border rounded px-2 py-1">
                        <option value="25" selected>25</option>
                        <option value="100">100</option>
                        <option value="250">250</option>
                        <option value="500">500</option>
                    </select>
                    <span class="text-sm">entries</span>
                </div>

                <!-- Kanan: Pagination -->
                <div class="flex items-center gap-2 order-1 md:order-2">
                    <div id="kt-pagination" class="kt-datatable-pagination" data-kt-datatable-pagination="true"></div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script>
        function renderPaginationWindow(dt, container, windowSize = 2) {
            const pageInfo = dt.page.info();
            const totalPages = pageInfo.pages;
            const currentPage = pageInfo.page; // 0-indexed
            container.innerHTML = "";

            // Prev
            const prevBtn = document.createElement("button");
            prevBtn.className = "kt-datatable-pagination-button kt-datatable-pagination-prev";
            prevBtn.disabled = currentPage === 0;
            prevBtn.innerHTML = `<svg class="rtl:transform rtl:rotate-180 size-3.5 shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8.86501 16.7882V12.8481H21.1459C21.3724 12.8481 21.5897 12.7581 21.7498 12.5979C21.91 12.4378 22 12.2205 22 11.994C22 11.7675 21.91 11.5503 21.7498 11.3901C21.5897 11.2299 21.3724 11.1399 21.1459 11.1399H8.86501V7.2112C8.86628 7.10375 8.83517 6.9984 8.77573 6.90887C8.7163 6.81934 8.63129 6.74978 8.53177 6.70923C8.43225 6.66869 8.32283 6.65904 8.21775 6.68155C8.11267 6.70405 8.0168 6.75766 7.94262 6.83541L2.15981 11.6182C2.1092 11.668 2.06901 11.7274 2.04157 11.7929C2.01413 11.8584 2 11.9287 2 11.9997C2 12.0707 2.01413 12.141 2.04157 12.2065C2.06901 12.272 2.1092 12.3314 2.15981 12.3812L7.94262 17.164C8.0168 17.2417 8.11267 17.2953 8.21775 17.3178C8.32283 17.3403 8.43225 17.3307 8.53177 17.2902C8.63129 17.2496 8.7163 17.18 8.77573 17.0905C8.83517 17.001 8.86628 16.8956 8.86501 16.7882Z" fill="currentColor"></path>
</svg>`;
            prevBtn.addEventListener("click", () => dt.page("previous").draw(false))
            container.appendChild(prevBtn);

            // Halaman 1
            const firstBtn = document.createElement("button");
            firstBtn.className = "kt-datatable-pagination-button";
            firstBtn.textContent = "1";
            if (currentPage === 0) firstBtn.classList.add("active", "disabled");
            firstBtn.addEventListener("click", () => dt.page(0).draw(false));
            container.appendChild(firstBtn);

            // ... sebelum window
            if (currentPage - windowSize > 1) {
                const dots = document.createElement("span");
                dots.textContent = "...";
                dots.className = "px-1";
                container.appendChild(dots);
            }

            // Window sekitar current page
            const start = Math.max(1, currentPage - windowSize);
            const end = Math.min(totalPages - 2, currentPage + windowSize);
            for (let i = start; i <= end; i++) {
                const btn = document.createElement("button");
                btn.className = "kt-datatable-pagination-button";
                btn.textContent = i + 1;
                if (i === currentPage) btn.classList.add("active", "disabled");
                btn.addEventListener("click", () => dt.page(i).draw(false));
                container.appendChild(btn);
            }

            // ... setelah window
            if (currentPage + windowSize < totalPages - 2) {
                const dots = document.createElement("span");
                dots.textContent = "...";
                dots.className = "px-1";
                container.appendChild(dots);
            }

            // Halaman terakhir
            if (totalPages > 1) {
                const lastBtn = document.createElement("button");
                lastBtn.className = "kt-datatable-pagination-button";
                lastBtn.textContent = totalPages;
                if (currentPage === totalPages - 1) lastBtn.classList.add("active", "disabled");
                lastBtn.addEventListener("click", () => dt.page(totalPages - 1).draw(false));
                container.appendChild(lastBtn);
            }

            // Next
            const nextBtn = document.createElement("button");
            nextBtn.className = "kt-datatable-pagination-button kt-datatable-pagination-next";
            nextBtn.disabled = currentPage === totalPages - 1;
            nextBtn.innerHTML = `<svg class="rtl:transform rtl:rotate-180 size-3.5 shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15.135 7.21144V11.1516H2.85407C2.62756 11.1516 2.41032 11.2415 2.25015 11.4017C2.08998 11.5619 2 11.7791 2 12.0056C2 12.2321 2.08998 12.4494 2.25015 12.6096C2.41032 12.7697 2.62756 12.8597 2.85407 12.8597H15.135V16.7884C15.1337 16.8959 15.1648 17.0012 15.2243 17.0908C15.2837 17.1803 15.3687 17.2499 15.4682 17.2904C15.5677 17.3309 15.6772 17.3406 15.7822 17.3181C15.8873 17.2956 15.9832 17.242 16.0574 17.1642L21.8402 12.3814C21.8908 12.3316 21.931 12.2722 21.9584 12.2067C21.9859 12.1412 22 12.0709 22 11.9999C22 11.9289 21.9859 11.8586 21.9584 11.7931C21.931 11.7276 21.8908 11.6683 21.8402 11.6185L16.0574 6.83565C15.9832 6.75791 15.8873 6.70429 15.7822 6.68179C15.6772 6.65929 15.5677 6.66893 15.4682 6.70948C15.3687 6.75002 15.2837 6.81959 15.2243 6.90911C15.1648 6.99864 15.1337 7.10399 15.135 7.21144Z" fill="currentColor"></path>
						</svg>`;
            nextBtn.addEventListener("click", () => dt.page("next").draw(false));
            container.appendChild(nextBtn);
        }

        $(document).ready(function() {
            var table = $('#serverTable').DataTable({

                "initComplete": function(settings, json) {
                    $('#serverTable_info').appendTo('#kt-pagination');
                    $('.dt-paging').appendTo('#kt-pagination');
                    $('#dt-length-0').appendTo('#ex_table_length');
                    $('#serverTable_filter').appendTo('#ex_table_filter');
                },

                processing: true,
                serverSide: true,
                "pagingType": "simple_numbers",
                ajax: "{{ route('dashboard.system.application.datatable.generals.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        'className': 'text-center text-nowrap',
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
                    {
                        data: 'active',
                        name: 'active',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<span class="kt-badge kt-badge-outline kt-badge-success">Success</span>';
                        },
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<span class="kt-badge kt-badge-outline kt-badge-warning"> Pending </span>';
                        },
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `<td>
              <div class="kt-menu" data-kt-menu="true">
               <div class="kt-menu-item" data-kt-menu-item-offset="0, 10px" data-kt-menu-item-placement="bottom-end" data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="click">
                <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                 <i class="ki-filled ki-dots-vertical text-lg">
                 </i>
                </button>
                <div class="kt-menu-dropdown kt-menu-default w-full max-w-[175px]" data-kt-menu-dismiss="true" style="">
                 <div class="kt-menu-item">
                  <a class="kt-menu-link" href="#">
                   <span class="kt-menu-icon">
                    <i class="ki-filled ki-search-list">
                    </i>
                   </span>
                   <span class="kt-menu-title">
                    View
                   </span>
                  </a>
                 </div>
                 <div class="kt-menu-item">
                  <a class="kt-menu-link" href="#">
                   <span class="kt-menu-icon">
                    <i class="ki-filled ki-pencil">
                    </i>
                   </span>
                   <span class="kt-menu-title">
                    Edit
                   </span>
                  </a>
                 </div>
                 <div class="kt-menu-item">
                  <a class="kt-menu-link" href="#">
                   <span class="kt-menu-icon">
                    <i class="ki-filled ki-trash">
                    </i>
                   </span>
                   <span class="kt-menu-title">
                    Delete
                   </span>
                  </a>
                 </div>
                </div>
               </div>
              </div>
             </td>`;
                        }
                    },
                ],
                pageLength: 25,
                lengthChange: false, // 🔒 hide bawaan select length
                info: false,
                dom: 't', // hide length dropdown asli
                responsive: true,
                drawCallback: function() {
                    renderPaginationWindow(this.api(), document.getElementById("kt-pagination"), 1);
                }

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
    @endpush