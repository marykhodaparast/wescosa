<x-app-layout>
    {{-- Optional: Page title --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="col-md-10 p-4 content">
        <!-- Top Bar (User Info) -->
        <div class="row mb-4">
            <div class="col-10">
                <h4><b>Purchase Orders</b></h4>
            </div>
            <div class="col-2">
                <div class="profile">
                    <img src="{{ asset('user1.jpg') }}" alt="Profile Image">
                    <div class="profile-text">
                        <h6>{{ auth()->user()->name }}</h6>
                        <p>Production Manager</p>
                    </div>
                </div>
            </div>
        </div>

        <!--  Content -->
        <div class="row">
            <div class="col-12">
                <div class="card pt-3 bg-light">
                    <form method="GET" class="d-flex justify-content-between mb-3 pb-3 ps-3 pe-3 w-100">
                        <div class="input-group w-25">
                            <input type="text" name="q" class="form-control" placeholder="Search by PO " value="">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>

                        <a href="/orders/add_purchase/" class="btn btn-primary ms-2">
                            <i class="bi bi-plus"></i> Add PO
                        </a>
                    </form>


                    <!-- Table -->
                    <div class="table-responsive table-wrapper " style="overflow-x: auto; white-space: nowrap; max-width: 100%;">
                        <table class="table table-hover table-borderless sticky-table">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>PO NUMBER</th>
                                    <th>PRODUCT NAME</th>
                                    <th>CUSTOMER</th>
                                    <th>REQUEST DATE</th>
                                    <th>ETD</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp

                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><a href="/orders/single_order/29/" class="" style="text-decoration: none;color: black;">PO-{{ 1000 + $i }}</a></td>
                                    <td>
                                        @switch($item->product_name)
                                        @case('1')
                                        MS100 Main Switch
                                        @break
                                        @case('2')
                                        MS250 Main Switch
                                        @break
                                        @case('3')
                                        TB125 Tie Breaker
                                        @break
                                        @case('4')
                                        TB160 Tie Breaker
                                        @break
                                        @case('5')
                                        DB Single Phase
                                        @break
                                        @case('6')
                                        DB Three Phase
                                        @break
                                        @case('7')
                                        Starter Panel
                                        @break
                                        @case('8')
                                        PLC Control Panel
                                        @break
                                        @case('9')
                                        Copper Busbar 100A
                                        @break
                                        @case('10')
                                        Aluminum Busbar 200A
                                        @break
                                        @case('11')
                                        Relay 230V
                                        @break
                                        @case('12')
                                        Contactor 40A
                                        @break
                                        @case('13')
                                        Cable Lug
                                        @break
                                        @case('14')
                                        PVC Trunking
                                        @break
                                        @case('15')
                                        1kVA Transformer
                                        @break
                                        @case('16')
                                        5kVA Transformer
                                        @break
                                        @case('17')
                                        MCB 10A
                                        @break
                                        @case('18')
                                        RCCB 63A
                                        @break
                                        @case('19')
                                        Digital Voltmeter
                                        @break
                                        @case('20')
                                        Energy Meter
                                        @break
                                        @endswitch
                                    </td>
                                    <td>{{ $item->customer }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->request_date)->format('M. j, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->etd)->format('M. j, Y') }}</td>
                                </tr>
                                @php
                                $i++;
                                @endphp

                                @endforeach




                            </tbody>
                        </table>
                        <!-- Pagination -->

                        <!-- <div class="row">
                       <div class="col-12 ps-4 pe-3">
               <div class="d-flex justify-content-between align-items-center mt-2">
                   <span>  -  of </span>
                   <nav>
<div>
<ul class="pagination mb-0">
<li>
   <label for="rowsPerPage">Rows per page:</label>
   <select id="rowsPerPage" class="form-select" style="width: auto; display: inline-block;">
       <option value="5" >5</option>
       <option value="10" >10</option>
<option value="50" >50</option>
</select>
                           </li>

                           <li class="page-item disabled">
                               <a class="page-link" href="#" aria-label="Previous">
                                   <i class="bi bi-chevron-left"></i>
                               </a>
                           </li>


                           <li class="page-item disabled">
                               <span class="page-link"> / </span>
                           </li>


                           <li class="page-item disabled">
                               <a class="page-link" href="#" aria-label="Next">
                                   <i class="bi bi-chevron-right"></i>
                               </a>
                           </li>
                       </ul>


                   </nav>
               </div>
                       </div>
                   </div> -->
                    </div>


                </div>
            </div>
        </div>






    </main>

    <script>
        const ctx1 = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(ctx1, {
            type: 'bar'
            , data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June']
                , datasets: [{
                    label: 'New Users'
                    , data: [120, 190, 300, 500, 200, 300]
                    , backgroundColor: '#3030b7'
                    , borderColor: '#2c3e50',
                    //rgba(54, 162, 235, 1)
                    borderWidth: 1
                }]
            }
            , options: {
                responsive: true
                , scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('productionGrowthChart').getContext('2d');
        const productionGrowthChart = new Chart(ctx2, {
            type: 'line'
            , data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June']
                , datasets: [{
                    label: 'Production Growth'
                    , data: [100, 150, 250, 400, 450, 600]
                    , backgroundColor: '#6767f6',
                    // borderColor: 'rgba(0, 123, 255, 1)',
                    borderColor: '#2c3e50'
                    , borderWidth: 2
                    , fill: true
                }]
            }
            , options: {
                responsive: true
                , scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const progressCircle = document.querySelector('.progress');
        const progressText = document.querySelector('.progress-text');

        let progress = 0;
        const targetProgress = 75; // Set your target progress here
        const duration = 2000; // Animation duration in milliseconds
        const increment = targetProgress / (duration / 16); // 16ms per frame for 60fps

        function updateProgress() {
            if (progress < targetProgress) {
                progress += increment;
                const offset = 565.48 - (565.48 * progress) / 100;
                progressCircle.style.strokeDashoffset = offset;
                progressText.textContent = `${Math.round(progress)}%`;
                requestAnimationFrame(updateProgress);
            } else {
                progressText.textContent = `${targetProgress}%`;
            }
        }

        updateProgress();

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        //   document.addEventListener('DOMContentLoaded', function () {
        //     const toastElList = [].slice.call(document.querySelectorAll('.toast'));
        //     toastElList.forEach(function (toastEl) {
        //       const toast = new bootstrap.Toast(toastEl);
        //       toast.show(); // This line triggers the toast
        //     });
        //   });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toast').forEach(function(toastEl) {
                // Create toast instance
                const toast = new bootstrap.Toast(toastEl, {
                    autohide: true
                    , delay: 4000
                });

                // Show the toast
                toast.show();
            });
        });

    </script>


    <script>
        document.getElementById("rowsPerPage").addEventListener("change", function() {
            let selectedRows = this.value;
            let currentPage = new URLSearchParams(window.location.search).get('page') || 1;
            window.location.href = `?page=1&rows=${selectedRows}`;
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll(".row-checkbox");
            const selectAll = document.getElementById("selectAll");

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    if (this.checked) {
                        this.closest("tr").classList.add("table-primary"); // Add blue background
                    } else {
                        this.closest("tr").classList.remove("table-primary"); // Remove blue background
                    }
                });
            });

            // Select/Deselect all checkboxes
            selectAll.addEventListener("change", function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                    if (this.checked) {
                        checkbox.closest("tr").classList.add("table-primary");
                    } else {
                        checkbox.closest("tr").classList.remove("table-primary");
                    }
                });
            });
        });

    </script>


</x-app-layout>
