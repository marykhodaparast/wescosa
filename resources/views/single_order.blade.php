<x-app-layout>
    {{-- Optional: Page title --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        body {
            background-color: #f4f7fc;
            font-family: Poppins;
        }

        .sidebar {
            height: 800px;
            background-color: #AEC3EA;
            color: white;
            padding: 20px;
            position: fixed;
            width: 230px;
            transition: all 0.3s ease;
        }

        .sidebar a {
            color: rgb(3, 36, 76);
            text-decoration: none;
            display: block;
            padding: 10px;
            padding-left: 10px;
            padding-top: 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #34495e;
            color: #efeaea;
        }

        .logout {
            padding: 10px;
            padding-left: 20px;
            border-radius: 5px;
            margin-top: auto;
            transition: all 0.3s ease;
        }

        .logout:hover {
            background-color: #e74c3c;
            transform: scale(1.1);
        }

        .content {
            margin-left: 220px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            min-height: 800px;
        }

        .card {
            margin-bottom: 20px;
        }

        .profile {
            display: flex;
            align-items: center;
            padding: 5px;
        }

        .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .profile-text h6 {
            margin: 0;
            font-weight: bold;
            text-align: center;
        }

        .profile-text p {
            margin: 0;
            font-size: 12px;
            color: gray;
        }



        .job-info {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .job-info div {
            margin: 0px 0px;
        }

        .grid-container {

            display: flex;
            flex-wrap: wrap;
            gap: 75px;
            padding: 20px;
            align-items: flex-start;
            justify-content: flex-start;
            font-family: sans-serif;
        }

        .product,
        .product-multi {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .headers,
        .header-col {
            text-align: center;
            margin-bottom: 5px;

        }

        .headers-multi {
            display: flex;
            gap: 10px;
            margin-bottom: 5px;
            justify-content: center;

        }

        .grid {
            display: grid;
            gap: 0;
        }

        .grid-a {
            grid-template-columns: 70px;
            grid-template-rows: repeat(2, 70px);
        }

        .grid-b {
            grid-template-columns: repeat(2, 70px);
            grid-template-rows: repeat(2, 70px);
        }

        .grid-d {
            grid-template-columns: repeat(4, 70px);
            grid-template-rows: repeat(2, 70px);
        }

        .grid div {
            width: 70px;
            height: 70px;
            box-sizing: border-box;

        }

        .red {
            background-color: #f8d7da;
            /* border: 1px solid #f5c6cb; */
            border: 1px solid rgb(186, 150, 150);
        }

        .green {
            background-color: #d4edda;
            border: 1px solid rgb(153, 201, 153);
        }


        .bold-text {
            font-weight: 600;
        }

        /* Sidebar Modal */
        .modal-right-one,
        .modal-right-two,
        .modal-right-three,
        .modal-right-four,
        .modal-right-five,
        .modal-right-six {
            position: fixed;
            top: 0;
            right: -300px;
            /* Initially hidden */
            width: 300px;
            height: 100%;
            background: #fff;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease-in-out;
            padding: 20px;
            z-index: 1000;
        }

        .modal-right-one.show,
        .modal-right-two.show,
        .modal-right-three.show,
        .modal-right-four.show,
        .modal-right-five.show,
        .modal-right-six.show {
            right: 0;
        }

        .overlay-one,
        .overlay-two,
        .overlay-three,
        .overlay-four,
        .overlay-five,
        .overlay-six {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 999;
        }

        .overlay-one.show,
        .overlay-two.show,
        .overlay-three.show,
        .overlay-four.show,
        .overlay-five.show,
        .overlay-six.show {
            display: block;
        }

        .close-one,
        .close-two,
        .close-three,
        .close-four,
        .close-five,
        .close-six {
            display: inline;
            margin-bottom: 20px;
            margin-left: 15px;
            padding: 5px 15px;
            background: rgb(29, 16, 80);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 20%;
        }

        .modal-inputs input[type="text"] {
            width: 250px;
            height: 25px;
            margin-top: 20px;
        }

        .headers div:first-child,
        .header-col div:first-child {
            font-size: 9px;
            /* smaller for 'Product Name' */
            color: #2a2727;
            /* optional: subtle color */
        }

        .headers div:last-child,
        .header-col div:last-child {
            font-size: 9px;
            /* bigger for A1, B1 etc. */
            /* font-weight: bold; */
        }

        .form-contrl {
            font-size: 0.7rem !important;
        }
    </style>


    <!-- Main Content -->
    <main class="col-md-10 content">
        <!-- Top Bar (User Info) -->
        <div class="row mb-4">
            <div class="col-10">
                <h4><b>Purchase Details</b></h4>
            </div>
            <div class="col-2">
                <div class="profile">
                    <img src="{{ asset('user1.jpg') }}" alt="Profile Image">
                    <div class="profile-text">
                        <h6>{{ auth()?->user()?->name }}</h6>
                        <p style="white-space: nowrap !important;">Production Manager</p>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Dashboard Content -->
        <div class="row">
            <div class="col-12 ps-5">
                <h2 class="text-left" id="ponum">
                    {{ $data->po_number ? $data->po_number : 'PO-' . (1000 + $data->id) }}</h2>


                <div class="job-info">
                    <div class="row">
                        <div class="col-md-1"><small>Job No.</small><br><span
                                class="bold-text">JOB-{{ $data->job_number }}</span></div>
                        <div class="col-md-2"><small>Product</small><br>
                            <span class="bold-text">
                                {{ $data?->product?->name }}
                            </span>
                        </div>
                        <div class="col-md-2"><small>Project Name</small><br><span
                                class="bold-text">{{ $data->project_name }}</span></div>
                        <div class="col-md-2"><small>Customer</small><br><span
                                class="bold-text">{{ $data->customer }}</span></div>
                        <div class="col-md-2"><small>No.of Structures</small><br><span
                                class="bold-text">{{ $data->no_of_structures }}</span></div>
                        <div class="col-md-2"><small>No.of Workers</small><br><span
                                class="bold-text">{{ $data->no_of_workers }}</span></div>
                        <div class="col-md-1"><small>Feeders</small><br><span
                                class="bold-text">{{ $data->feeders }}</span></div>
                        <div class="col-md-1"><small>Main</small><br><span class="bold-text">{{ $data->main }}</span>
                        </div>
                        <div class="col-md-1"><small>Tie</small><br><span class="bold-text">{{ $data->tie }}</span>
                        </div>
                        <div class="col-md-2"><small>Request Date</small><br><span
                                class="bold-text">{{ \Carbon\Carbon::parse($data->request_date)->format('M. j, Y') }}</span>
                        </div>
                        <div class="col-md-2"><small>Start Date</small><br><span
                                class="bold-text">{{ \Carbon\Carbon::parse($data->start_date)->format('M. j, Y') }}</span>
                        </div>
                        <div class="col-md-2"><small>End Date</small><br><span
                                class="bold-text">{{ \Carbon\Carbon::parse($data->end_date)->format('M. j, Y') }}</span>
                        </div>
                        <div class="col-md-2"><small>ETD</small><br><span
                                class="bold-text">{{ \Carbon\Carbon::parse($data->etd)->format('M. j, Y') }}</span>
                        </div>
                        <div class="col-md-2"><small>ATD</small><br><span
                                class="bold-text">{{ \Carbon\Carbon::parse($data->atd)->format('M. j, Y') }}</span>
                        </div>
                    </div>

                    <div class="grid-container" style="margin-top: 50px;">

                        <!-- A1 -->
                        <div class="product">
                            <div class="headers">
                                <div>Product Name</div>
                                <div><strong>A1</strong></div>
                            </div>
                            <div class="grid grid-a">
                                <div class="red one"></div>
                                <div class="green one"></div>
                            </div>
                        </div>

                        <!-- A3 + A4 -->
                        <div class="product-multi">
                            <div class="headers-multi">
                                <div class="header-col">
                                    <div>Product Name</div>
                                    <div><strong>A3</strong></div>
                                </div>
                                <div class="header-col">
                                    <div>Product Name</div>
                                    <div><strong>A4</strong></div>
                                </div>
                            </div>
                            <div class="grid grid-b">
                                <div class="green two"></div>
                                <div class="green two"></div>
                                <div class="red two"></div>
                                <div class="green two"></div>
                            </div>
                        </div>

                        <!-- A5 -->
                        <div class="product">
                            <div class="headers">
                                <div>Product Name</div>
                                <div><strong>A5</strong></div>
                            </div>
                            <div class="grid grid-a">
                                <div class="green three"></div>
                                <div class="green three"></div>
                            </div>
                        </div>

                        <!-- Main -->
                        <div class="product">
                            <div class="headers">
                                <div>Product Name</div>
                                <div><strong>Main</strong></div>
                            </div>
                            <div class="grid grid-a">
                                <div class="green four" style="background-color: #b2deb2;"></div>
                                <div class="green four" style="background-color: #b2deb2;"></div>
                            </div>
                        </div>

                        <!-- Tie -->
                        <div class="product">
                            <div class="headers">
                                <div>Product Name</div>
                                <div><strong>Tie</strong></div>
                            </div>
                            <div class="grid grid-a">
                                <div class="green five"></div>
                                <div class="green five"></div>
                            </div>
                        </div>

                        <!-- Main + B1 + B2 + B3 -->
                        <div class="product-multi">
                            <div class="headers-multi">
                                <div class="header-col">
                                    <div>Product Name</div>
                                    <div><strong>Main</strong></div>
                                </div>
                                <div class="header-col">
                                    <div>Product Name</div>
                                    <div><strong>B1</strong></div>
                                </div>
                                <div class="header-col">
                                    <div>Product Name</div>
                                    <div><strong>B2</strong></div>
                                </div>
                                <div class="header-col">
                                    <div>Product Name</div>
                                    <div><strong>B3</strong></div>
                                </div>
                            </div>
                            <div class="grid grid-d">
                                <div class="red six"></div>
                                <div class="green six"></div>
                                <div class="green six"></div>
                                <div class="green six"></div>
                                <div class="green six"></div>
                                <div class="green six"></div>
                                <div class="green six"></div>
                                <div class="green six"></div>
                            </div>
                        </div>


                    </div>




                </div>
            </div>

        </div>
        </div>

        </div>
        <div class="modal fade" id="qrModal-one" tabindex="-1">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <!-- Changed to modal-sm -->
                <div class="modal-content p-2">
                    <!-- Reduced padding -->
                    <div class="modal-header">
                        <h6 class="modal-title">QR Code</h6> <!-- Smaller title -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="qrImage-one" src="" class="img-fluid" style="max-width: 150px;"
                            alt="QR Code">
                        <div class="mt-2" style="font-size: 14px;">
                            <p><span class="fs-6" id="qrName-one"></span></p>

                            <p>PO No: <span id="qrPO-one"></span></p>
                            <p>Qty: <span id="qrQty-one"></span></p>
                        </div>
                        <br><br>
                        <button class="btn btn-sm btn-dark" onclick="printQR(1)">Print QR</button>
                        <!-- Smaller button -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="qrModal-two" tabindex="-1">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <!-- Changed to modal-sm -->
                <div class="modal-content p-2">
                    <!-- Reduced padding -->
                    <div class="modal-header">
                        <h6 class="modal-title">QR Code</h6> <!-- Smaller title -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="qrImage-two" src="" class="img-fluid" style="max-width: 150px;"
                            alt="QR Code">
                        <div class="mt-2" style="font-size: 14px;">
                            <p><span class="fs-6" id="qrName-two"></span></p>

                            <p>PO No: <span id="qrPO-two"></span></p>
                            <p>Qty: <span id="qrQty-two"></span></p>
                        </div>
                        <br><br>
                        <button class="btn btn-sm btn-dark" onclick="printQR(2)">Print QR</button>
                        <!-- Smaller button -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="qrModal-three" tabindex="-1">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <!-- Changed to modal-sm -->
                <div class="modal-content p-2">
                    <!-- Reduced padding -->
                    <div class="modal-header">
                        <h6 class="modal-title">QR Code</h6> <!-- Smaller title -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="qrImage-three" src="" class="img-fluid" style="max-width: 150px;"
                            alt="QR Code">
                        <div class="mt-2" style="font-size: 14px;">
                            <p><span class="fs-6" id="qrName-three"></span></p>

                            <p>PO No: <span id="qrPO-three"></span></p>
                            <p>Qty: <span id="qrQty-three"></span></p>
                        </div>
                        <br><br>
                        <button class="btn btn-sm btn-dark" onclick="printQR(3)">Print QR</button>
                        <!-- Smaller button -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="qrModal-four" tabindex="-1">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <!-- Changed to modal-sm -->
                <div class="modal-content p-2">
                    <!-- Reduced padding -->
                    <div class="modal-header">
                        <h6 class="modal-title">QR Code</h6> <!-- Smaller title -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="qrImage-four" src="" class="img-fluid" style="max-width: 150px;"
                            alt="QR Code">
                        <div class="mt-2" style="font-size: 14px;">
                            <p><span class="fs-6" id="qrName-four"></span></p>

                            <p>PO No: <span id="qrPO-four"></span></p>
                            <p>Qty: <span id="qrQty-four"></span></p>
                        </div>
                        <br><br>
                        <button class="btn btn-sm btn-dark" onclick="printQR(4)">Print QR</button>
                        <!-- Smaller button -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="qrModal-five" tabindex="-1">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <!-- Changed to modal-sm -->
                <div class="modal-content p-2">
                    <!-- Reduced padding -->
                    <div class="modal-header">
                        <h6 class="modal-title">QR Code</h6> <!-- Smaller title -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="qrImage-five" src="" class="img-fluid" style="max-width: 150px;"
                            alt="QR Code">
                        <div class="mt-2" style="font-size: 14px;">
                            <p><span class="fs-6" id="qrName-five"></span></p>

                            <p>PO No: <span id="qrPO-five"></span></p>
                            <p>Qty: <span id="qrQty-five"></span></p>
                        </div>
                        <br><br>
                        <button class="btn btn-sm btn-dark" onclick="printQR(5)">Print QR</button>
                        <!-- Smaller button -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="qrModal-six" tabindex="-1">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <!-- Changed to modal-sm -->
                <div class="modal-content p-2">
                    <!-- Reduced padding -->
                    <div class="modal-header">
                        <h6 class="modal-title">QR Code</h6> <!-- Smaller title -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="qrImage-six" src="" class="img-fluid" style="max-width: 150px;"
                            alt="QR Code">
                        <div class="mt-2" style="font-size: 14px;">
                            <p><span class="fs-6" id="qrName-six"></span></p>

                            <p>PO No: <span id="qrPO-six"></span></p>
                            <p>Qty: <span id="qrQty-six"></span></p>
                        </div>
                        <br><br>
                        <button class="btn btn-sm btn-dark" onclick="printQR(6)">Print QR</button>
                        <!-- Smaller button -->
                    </div>
                </div>
            </div>
        </div>



        <div class="overlay-one"></div>
        <div class="modal-right-one">
            @if ($errors->any())
                <div class="alert alert-danger" style="font-size:0.8rem !important;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.querySelector('.modal-right-one')?.classList.add('show');
                        document.querySelector('.overlay-one')?.classList.add('show');
                    });
                </script>
            @endif

            @php
                $product_child_element_id =
                    App\Models\ProductChildElement::where('product_id', $data->product_name_id)->first()?->id ?? 0;

                $production_request_child_element = App\Models\ProductionRequestChildElement::where('po_id', $data->id)
                    ->where('child_element_id', $product_child_element_id)
                    ->first();

            @endphp
            <!-- Form should not be inside .row unless you want grid columns inside -->
            <form method="POST" action="/orders/update_eta_ata/" style="margin-top: 15px;"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="order_id" value="{{ $data->id }}">
                <input type="hidden" name="product_id" value="{{ $data->product_name_id }}" />
                <input type="hidden" name="product_child_element_id" value="{{ $product_child_element_id }}" />
                <div class="row">
                    <div class="col-8"> <span class="fs-6"><input type="text" id="child-name-one"
                                name="child-name" placeholder="Child Name"
                                value="{{ $production_request_child_element?->name }}" class="form-control" /></span>
                    </div>

                    <div class="col-4">
                        <button type="button" class="close-one">X</button>
                    </div>

                </div>

                <div class="card">
                    <div class="card-image">
                        @if ($production_request_child_element && $production_request_child_element->image)
                            <img src="{{ asset('storage/' . $production_request_child_element->image) }}"
                                alt="Child Image" width="258px" height="120px">
                        @else
                            <input type="file" class="form-control" id="child-image-one" name="child-image"
                                style="font-size:0.7rem !important" />
                        @endif
                        {{-- <img id="child-image" src="" alt="Circuit diagram" height="120px"> --}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <span style="font-size: 10px;">QUANTITY</span><br>
                        <span style="font-size: 10px;font-weight: 700;"><input type="text" id="child-qty-one"
                                name="child-qty" value="{{ old('child-qty', $production_request_child_element?->quantity) }}"
                                class="form-control"
                                style="width:40px !important;font-size:0.7rem !important" /></span>
                        {{-- @error('child-qty')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                    <div class="col-md-4">
                        <span style="font-size: 10px;">UNIT PRICE</span><br>
                        <span id="child-unit-price-one" style="font-size: 10px;font-weight: 700;"><input
                                type="text" name="child-unit-price"
                                value="{{ $production_request_child_element?->unit_price }}" class="form-control"
                                style="width:60px !important;font-size:0.7rem !important" /></span>
                    </div>
                    <div class="col-md-4">
                        <span style="font-size: 10px;">TOTAL PRICE</span><br>
                        <span id="child-total-price-one" style="font-size: 10px;font-weight: 700;"><input
                                type="text" name="child-total-price"
                                value="{{ $production_request_child_element?->total_price }}" class="form-control"
                                style="width:60px !important;font-size:0.7rem !important" /></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <span style="font-size: 10px;">ORDERED DATE</span><br>
                        <span id="child-date-one" style="font-size: 10px !important;"><input type="date"
                                name="child-date" class="form-control"
                                value="{{ $production_request_child_element?->date_order }}"
                                style="font-size: 0.7rem !important;" />
                        </span>
                    </div>
                </div>

                <div class="form-group mt-2 mb-2">
                    <label style="font-size: 12px;">ETA</label>
                    <input type="date" class="form-control" id="eta-one" name="eta"
                        value="{{ $production_request_child_element?->eta_child }}" style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">ATA</label>
                    <input type="date" class="form-control" id="ata-one" name="ata"
                        value="{{ $production_request_child_element?->ata_child }}" style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">Inspection Remarks</label>
                    <input type="text" class="form-control" id="inspection-one" name="inspection"
                        value="{{ $production_request_child_element?->inspection_remarks }}"
                        style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-3">
                    <label style="font-size: 12px;">Production Manager Remarks</label>
                    <input type="text" class="form-control" id="pm-remarks-one" name="pm_remarks"
                        value="{{ $production_request_child_element?->production_manager_remarks }}"
                        style="font-size: 0.7rem;">
                </div>

                <button type="submit" class="btn btn-primary mt-2" id="saveBtn1" disabled>Save Changes</button>
                <button type="button" id="qr-btn1" class="btn btn-success mt-2"
                    onclick="handleQRClick(1)">Generate QR</button>
            </form>
        </div>


        <div class="overlay-two"></div>
        <div class="modal-right-two">
            @php

                $product_child_element_id =
                    App\Models\ProductChildElement::where('product_id', $data->product_name_id)->first()?->id + 1 ?? 0;

                $production_request_child_element = App\Models\ProductionRequestChildElement::where('po_id', $data->id)
                    ->where('child_element_id', $product_child_element_id)
                    ->first();

            @endphp
            <!-- Form should not be inside .row unless you want grid columns inside -->
            <form method="POST" action="/orders/update_eta_ata/" style="margin-top: 15px;"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="order_id" value="{{ $data->id }}">
                <input type="hidden" name="product_id" value="{{ $data->product_name_id }}" />
                <input type="hidden" name="product_child_element_id" value="{{ $product_child_element_id }}" />
                <div class="row">
                    <div class="col-8"> <span class="fs-6"><input type="text" id="child-name-two"
                                name="child-name" placeholder="Child Name"
                                value="{{ $production_request_child_element?->name }}" class="form-control" /></span>
                    </div>

                    <div class="col-4">
                        <button type="button" class="close-two">X</button>
                    </div>

                </div>

                <div class="card">
                    <div class="card-image">
                        @if ($production_request_child_element && $production_request_child_element->image)
                            <img src="{{ asset('storage/' . $production_request_child_element->image) }}"
                                alt="Child Image" width="258px" height="120px">
                        @elseif($production_request_child_element && $production_request_child_element->image === null)
                            <img id="child-image-two" src="" alt="Circuit diagram" height="120px">
                        @else
                            <input type="file" class="form-control" id="child-image-two" name="child-image"
                                style="font-size:0.7rem !important" />
                        @endif
                        {{-- <img id="child-image" src="" alt="Circuit diagram" height="120px"> --}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <span style="font-size: 10px;">QUANTITY</span><br>
                        <span style="font-size: 10px;font-weight: 700;"><input type="text" id="child-qty-two"
                                name="child-qty" value="{{ $production_request_child_element?->quantity }}"
                                class="form-control"
                                style="width:40px !important;font-size:0.7rem !important" /></span>
                    </div>
                    <div class="col-md-4">
                        <span style="font-size: 10px;">UNIT PRICE</span><br>
                        <span id="child-unit-price-two" style="font-size: 10px;font-weight: 700;"><input
                                type="text" name="child-unit-price"
                                value="{{ $production_request_child_element?->unit_price }}" class="form-control"
                                style="width:60px !important;font-size:0.7rem !important" /></span>
                    </div>
                    <div class="col-md-4">
                        <span style="font-size: 10px;">TOTAL PRICE</span><br>
                        <span id="child-total-price-two" style="font-size: 10px;font-weight: 700;"><input
                                type="text" name="child-total-price"
                                value="{{ $production_request_child_element?->total_price }}" class="form-control"
                                style="width:60px !important;font-size:0.7rem !important" /></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <span style="font-size: 10px;">ORDERED DATE</span><br>
                        <span id="child-date-two" style="font-size: 10px !important;"><input type="date"
                                name="child-date" class="form-control"
                                value="{{ $production_request_child_element?->date_order }}"
                                style="font-size: 0.7rem !important;" /></span>
                    </div>
                </div>



                <div class="form-group mt-2 mb-2">
                    <label style="font-size: 12px;">ETA</label>
                    <input type="date" class="form-control" id="eta-two" name="eta"
                        value="{{ $production_request_child_element?->eta_child }}" style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">ATA</label>
                    <input type="date" class="form-control" id="ata-two" name="ata"
                        value="{{ $production_request_child_element?->ata_child }}" style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">Inspection Remarks</label>
                    <input type="text" class="form-control" id="inspection-two" name="inspection"
                        value="{{ $production_request_child_element?->inspection_remarks }}"
                        style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-3">
                    <label style="font-size: 12px;">Production Manager Remarks</label>
                    <input type="text" class="form-control" id="pm-remarks-two" name="pm_remarks"
                        value="{{ $production_request_child_element?->production_manager_remarks }}"
                        style="font-size: 0.7rem;">
                </div>

                <button type="submit" class="btn btn-primary mt-2" id="saveBtn2" disabled>Save Changes</button>
                <button type="button" id="qr-btn2" class="btn btn-success mt-2"
                    onclick="handleQRClick(2)">Generate QR</button>
            </form>
        </div>

        <div class="overlay-three"></div>
        <div class="modal-right-three">
            @php

                $product_child_element_id =
                    App\Models\ProductChildElement::where('product_id', $data->product_name_id)->first()?->id + 2 ?? 0;

                $production_request_child_element = App\Models\ProductionRequestChildElement::where('po_id', $data->id)
                    ->where('child_element_id', $product_child_element_id)
                    ->first();

            @endphp
            <!-- Form should not be inside .row unless you want grid columns inside -->
            <form method="POST" action="/orders/update_eta_ata/" style="margin-top: 15px;"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="order_id" value="{{ $data->id }}">
                <input type="hidden" name="product_id" value="{{ $data->product_name_id }}" />
                <input type="hidden" name="product_child_element_id" value="{{ $product_child_element_id }}" />
                <div class="row">
                    <div class="col-8"> <span class="fs-6"><input type="text" id="child-name-three"
                                name="child-name" placeholder="Child Name"
                                value="{{ $production_request_child_element?->name }}" class="form-control" /></span>
                    </div>

                    <div class="col-4">
                        <button type="button" class="close-three">X</button>
                    </div>

                </div>

                <div class="card">
                    <div class="card-image">
                        @if ($production_request_child_element && $production_request_child_element->image)
                            <img src="{{ asset('storage/' . $production_request_child_element->image) }}"
                                alt="Child Image" width="258px" height="120px">
                        @elseif($production_request_child_element && $production_request_child_element->image === null)
                            <img id="child-image-three" src="" alt="Circuit diagram" height="120px">
                        @else
                            <input type="file" class="form-control" id="child-image-three" name="child-image"
                                style="font-size:0.7rem !important" />
                        @endif
                        {{-- <img id="child-image" src="" alt="Circuit diagram" height="120px"> --}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <span style="font-size: 10px;">QUANTITY</span><br>
                        <span style="font-size: 10px;font-weight: 700;"><input type="text" id="child-qty-three"
                                name="child-qty" value="{{ $production_request_child_element?->quantity }}"
                                class="form-control"
                                style="width:40px !important;font-size:0.7rem !important" /></span>
                    </div>
                    <div class="col-md-4">
                        <span style="font-size: 10px;">UNIT PRICE</span><br>
                        <span id="child-unit-price-three" style="font-size: 10px;font-weight: 700;"><input
                                type="text" name="child-unit-price"
                                value="{{ $production_request_child_element?->unit_price }}" class="form-control"
                                style="width:60px !important;font-size:0.7rem !important" /></span>
                    </div>
                    <div class="col-md-4">
                        <span style="font-size: 10px;">TOTAL PRICE</span><br>
                        <span id="child-total-price-three" style="font-size: 10px;font-weight: 700;"><input
                                type="text" name="child-total-price"
                                value="{{ $production_request_child_element?->total_price }}" class="form-control"
                                style="width:60px !important;font-size:0.7rem !important" /></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <span style="font-size: 10px;">ORDERED DATE</span><br>
                        <span id="child-date-three" style="font-size: 10px !important;"><input type="date"
                                name="child-date" class="form-control"
                                value="{{ $production_request_child_element?->date_order }}"
                                style="font-size: 0.7rem !important;" /></span>
                    </div>
                </div>



                <div class="form-group mt-2 mb-2">
                    <label style="font-size: 12px;">ETA</label>
                    <input type="date" class="form-control" id="eta-three" name="eta"
                        value="{{ $production_request_child_element?->eta_child }}" style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">ATA</label>
                    <input type="date" class="form-control" id="ata-three" name="ata"
                        value="{{ $production_request_child_element?->ata_child }}" style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">Inspection Remarks</label>
                    <input type="text" class="form-control" id="inspection-three" name="inspection"
                        value="{{ $production_request_child_element?->inspection_remarks }}"
                        style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-3">
                    <label style="font-size: 12px;">Production Manager Remarks</label>
                    <input type="text" class="form-control" id="pm-remarks-three" name="pm_remarks"
                        value="{{ $production_request_child_element?->production_manager_remarks }}"
                        style="font-size: 0.7rem;">
                </div>

                <button type="submit" class="btn btn-primary mt-2" id="saveBtn3" disabled>Save Changes</button>
                <button type="button" id="qr-btn3" class="btn btn-success mt-2"
                    onclick="handleQRClick(3)">Generate QR</button>
            </form>
        </div>

        <div class="overlay-four"></div>
        <div class="modal-right-four">
            @php

                $product_child_element_id =
                    App\Models\ProductChildElement::where('product_id', $data->product_name_id)->first()?->id + 3 ?? 0;

                $production_request_child_element = App\Models\ProductionRequestChildElement::where('po_id', $data->id)
                    ->where('child_element_id', $product_child_element_id)
                    ->first();

            @endphp
            <!-- Form should not be inside .row unless you want grid columns inside -->
            <form method="POST" action="/orders/update_eta_ata/" style="margin-top: 15px;"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="order_id" value="{{ $data->id }}">
                <input type="hidden" name="product_id" value="{{ $data->product_name_id }}" />
                <input type="hidden" name="product_child_element_id" value="{{ $product_child_element_id }}" />
                <div class="row">
                    <div class="col-8"> <span class="fs-6"><input type="text" id="child-name-four"
                                name="child-name" placeholder="Child Name"
                                value="{{ $production_request_child_element?->name }}" class="form-control" /></span>
                    </div>

                    <div class="col-4">
                        <button type="button" class="close-four">X</button>
                    </div>

                </div>

                <div class="card">
                    <div class="card-image">
                        @if ($production_request_child_element && $production_request_child_element->image)
                            <img src="{{ asset('storage/' . $production_request_child_element->image) }}"
                                alt="Child Image" width="258px" height="120px">
                        @elseif($production_request_child_element && $production_request_child_element->image === null)
                            <img id="child-image-four" src="" alt="Circuit diagram" height="120px">
                        @else
                            <input type="file" class="form-control" id="child-image-four" name="child-image"
                                style="font-size:0.7rem !important" />
                        @endif
                        {{-- <img id="child-image" src="" alt="Circuit diagram" height="120px"> --}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <span style="font-size: 10px;">QUANTITY</span><br>
                        <span style="font-size: 10px;font-weight: 700;"><input type="text" id="child-qty-four"
                                name="child-qty" value="{{ $production_request_child_element?->quantity }}"
                                class="form-control"
                                style="width:40px !important;font-size:0.7rem !important" /></span>
                    </div>
                    <div class="col-md-4">
                        <span style="font-size: 10px;">UNIT PRICE</span><br>
                        <span id="child-unit-price-four" style="font-size: 10px;font-weight: 700;"><input
                                type="text" name="child-unit-price"
                                value="{{ $production_request_child_element?->unit_price }}" class="form-control"
                                style="width:60px !important;font-size:0.7rem !important" /></span>
                    </div>
                    <div class="col-md-4">
                        <span style="font-size: 10px;">TOTAL PRICE</span><br>
                        <span id="child-total-price-four" style="font-size: 10px;font-weight: 700;"><input
                                type="text" name="child-total-price"
                                value="{{ $production_request_child_element?->total_price }}" class="form-control"
                                style="width:60px !important;font-size:0.7rem !important" /></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <span style="font-size: 10px;">ORDERED DATE</span><br>
                        <span id="child-date-four" style="font-size: 10px !important;"><input type="date"
                                name="child-date" class="form-control"
                                value="{{ $production_request_child_element?->date_order }}"
                                style="font-size: 0.7rem !important;" /></span>
                    </div>
                </div>

                <div class="form-group mt-2 mb-2">
                    <label style="font-size: 12px;">ETA</label>
                    <input type="date" class="form-control" id="eta-four" name="eta"
                        value="{{ $production_request_child_element?->eta_child }}" style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">ATA</label>
                    <input type="date" class="form-control" id="ata-four" name="ata"
                        value="{{ $production_request_child_element?->ata_child }}" style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">Inspection Remarks</label>
                    <input type="text" class="form-control" id="inspection-four" name="inspection"
                        value="{{ $production_request_child_element?->inspection_remarks }}"
                        style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-3">
                    <label style="font-size: 12px;">Production Manager Remarks</label>
                    <input type="text" class="form-control" id="pm-remarks-four" name="pm_remarks"
                        value="{{ $production_request_child_element?->production_manager_remarks }}"
                        style="font-size: 0.7rem;">
                </div>

                <button type="submit" class="btn btn-primary mt-2" id="saveBtn4" disabled>Save Changes</button>
                <button type="button" id="qr-btn4" class="btn btn-success mt-2"
                    onclick="handleQRClick(4)">Generate QR</button>
            </form>
        </div>

        <div class="overlay-five"></div>
        <div class="modal-right-five">
            @php

                $product_child_element_id =
                    App\Models\ProductChildElement::where('product_id', $data->product_name_id)->first()?->id + 4 ?? 0;

                $production_request_child_element = App\Models\ProductionRequestChildElement::where('po_id', $data->id)
                    ->where('child_element_id', $product_child_element_id)
                    ->first();

            @endphp
            <!-- Form should not be inside .row unless you want grid columns inside -->
            <form method="POST" action="/orders/update_eta_ata/" style="margin-top: 15px;"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="order_id" value="{{ $data->id }}">
                <input type="hidden" name="product_id" value="{{ $data->product_name_id }}" />
                <input type="hidden" name="product_child_element_id" value="{{ $product_child_element_id }}" />
                <div class="row">
                    <div class="col-8"> <span class="fs-6"><input type="text" id="child-name-five"
                                name="child-name" placeholder="Child Name"
                                value="{{ $production_request_child_element?->name }}" class="form-control" /></span>
                    </div>

                    <div class="col-4">
                        <button type="button" class="close-five">X</button>
                    </div>

                </div>

                <div class="card">
                    <div class="card-image">
                        @if ($production_request_child_element && $production_request_child_element->image)
                            <img src="{{ asset('storage/' . $production_request_child_element->image) }}"
                                alt="Child Image" width="258px" height="120px">
                        @elseif($production_request_child_element && $production_request_child_element->image === null)
                            <img id="child-image-five" src="" alt="Circuit diagram" height="120px">
                        @else
                            <input type="file" class="form-control" id="child-image-five" name="child-image"
                                style="font-size:0.7rem !important" />
                        @endif
                        {{-- <img id="child-image" src="" alt="Circuit diagram" height="120px"> --}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <span style="font-size: 10px;">QUANTITY</span><br>
                        <span style="font-size: 10px;font-weight: 700;"><input type="text" id="child-qty-five"
                                name="child-qty" value="{{ $production_request_child_element?->quantity }}"
                                class="form-control"
                                style="width:40px !important;font-size:0.7rem !important" /></span>
                    </div>
                    <div class="col-md-4">
                        <span style="font-size: 10px;">UNIT PRICE</span><br>
                        <span id="child-unit-price-five" style="font-size: 10px;font-weight: 700;"><input
                                type="text" name="child-unit-price"
                                value="{{ $production_request_child_element?->unit_price }}" class="form-control"
                                style="width:60px !important;font-size:0.7rem !important" /></span>
                    </div>
                    <div class="col-md-4">
                        <span style="font-size: 10px;">TOTAL PRICE</span><br>
                        <span id="child-total-price-five" style="font-size: 10px;font-weight: 700;"><input
                                type="text" name="child-total-price"
                                value="{{ $production_request_child_element?->total_price }}" class="form-control"
                                style="width:60px !important;font-size:0.7rem !important" /></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <span style="font-size: 10px;">ORDERED DATE</span><br>
                        <span id="child-date-five" style="font-size: 10px !important;"><input type="date"
                                name="child-date" class="form-control"
                                value="{{ $production_request_child_element?->date_order }}"
                                style="font-size: 0.7rem !important;" /></span>
                    </div>
                </div>



                <div class="form-group mt-2 mb-2">
                    <label style="font-size: 12px;">ETA</label>
                    <input type="date" class="form-control" id="eta-five" name="eta"
                        value="{{ $production_request_child_element?->eta_child }}" style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">ATA</label>
                    <input type="date" class="form-control" id="ata-five" name="ata"
                        value="{{ $production_request_child_element?->ata_child }}" style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">Inspection Remarks</label>
                    <input type="text" class="form-control" id="inspection-five" name="inspection"
                        value="{{ $production_request_child_element?->inspection_remarks }}"
                        style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-3">
                    <label style="font-size: 12px;">Production Manager Remarks</label>
                    <input type="text" class="form-control" id="pm-remarks-five" name="pm_remarks"
                        value="{{ $production_request_child_element?->production_manager_remarks }}"
                        style="font-size: 0.7rem;">
                </div>

                <button type="submit" class="btn btn-primary mt-2" id="saveBtn5" disabled>Save Changes</button>
                <button type="button" id="qr-btn5" class="btn btn-success mt-2"
                    onclick="handleQRClick(5)">Generate QR</button>
            </form>
        </div>

        <div class="overlay-six"></div>
        <div class="modal-right-six">
            @php

                $product_child_element_id =
                    App\Models\ProductChildElement::where('product_id', $data->product_name_id)->first()?->id + 5 ?? 0;

                $production_request_child_element = App\Models\ProductionRequestChildElement::where('po_id', $data->id)
                    ->where('child_element_id', $product_child_element_id)
                    ->first();

            @endphp
            <!-- Form should not be inside .row unless you want grid columns inside -->
            <form method="POST" action="/orders/update_eta_ata/" style="margin-top: 15px;"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="order_id" value="{{ $data->id }}">
                <input type="hidden" name="product_id" value="{{ $data->product_name_id }}" />
                <input type="hidden" name="product_child_element_id" value="{{ $product_child_element_id }}" />

                <div class="row">
                    <div class="col-8">
                        <span class="fs-6">
                            <input type="text" id="child-name-six" name="child-name" placeholder="Child Name"
                                value="{{ old('child-name', $production_request_child_element?->name) }}"
                                class="form-control" />
                        </span>
                        @error('child-name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-4">
                        <button type="button" class="close-six">X</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        @if ($production_request_child_element && $production_request_child_element->image)
                            <img src="{{ asset('storage/' . $production_request_child_element->image) }}"
                                alt="Child Image" width="258px" height="120px">
                        @elseif($production_request_child_element && $production_request_child_element->image === null)
                            <img id="child-image-six" src="" alt="Circuit diagram" height="120px">
                        @else
                            <input type="file" class="form-control" id="child-image-six" name="child-image"
                                style="font-size:0.7rem !important" />
                            @error('child-image')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <span style="font-size: 10px;">QUANTITY</span><br>
                        <span style="font-size: 10px;font-weight: 700;">
                            <input type="text" id="child-qty-six" name="child-qty"
                                value="{{ old('child-qty', $production_request_child_element?->quantity) }}"
                                class="form-control" style="width:40px !important;font-size:0.7rem !important" />
                        </span>
                        @error('child-qty')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <span style="font-size: 10px;">UNIT PRICE</span><br>
                        <span id="child-unit-price-six" style="font-size: 10px;font-weight: 700;">
                            <input type="text" name="child-unit-price"
                                value="{{ old('child-unit-price', $production_request_child_element?->unit_price) }}"
                                class="form-control" style="width:60px !important;font-size:0.7rem !important" />
                        </span>
                        @error('child-unit-price')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <span style="font-size: 10px;">TOTAL PRICE</span><br>
                        <span id="child-total-price-six" style="font-size: 10px;font-weight: 700;">
                            <input type="text" name="child-total-price"
                                value="{{ old('child-total-price', $production_request_child_element?->total_price) }}"
                                class="form-control" style="width:60px !important;font-size:0.7rem !important" />
                        </span>
                        @error('child-total-price')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <span style="font-size: 10px;">ORDERED DATE</span><br>
                        <span id="child-date-six" style="font-size: 10px !important;">
                            <input type="date" name="child-date" class="form-control"
                                value="{{ old('child-date', $production_request_child_element?->date_order) }}"
                                style="font-size: 0.7rem !important;" />
                        </span>
                        @error('child-date')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group mt-2 mb-2">
                    <label style="font-size: 12px;">ETA</label>
                    <input type="date" class="form-control" id="eta-six" name="eta"
                        value="{{ old('eta', $production_request_child_element?->eta_child) }}"
                        style="font-size: 0.7rem;">
                    @error('eta')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">ATA</label>
                    <input type="date" class="form-control" id="ata-six" name="ata"
                        value="{{ old('ata', $production_request_child_element?->ata_child) }}"
                        style="font-size: 0.7rem;">
                    @error('ata')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">Inspection Remarks</label>
                    <input type="text" class="form-control" id="inspection-six" name="inspection"
                        value="{{ old('inspection', $production_request_child_element?->inspection_remarks) }}"
                        style="font-size: 0.7rem;">
                    @error('inspection')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label style="font-size: 12px;">Production Manager Remarks</label>
                    <input type="text" class="form-control" id="pm-remarks-six" name="pm_remarks"
                        value="{{ old('pm_remarks', $production_request_child_element?->production_manager_remarks) }}"
                        style="font-size: 0.7rem;">
                    @error('pm_remarks')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-2" id="saveBtn6" disabled>Save Changes</button>
                <button type="button" id="qr-btn6" class="btn btn-success mt-2"
                    onclick="handleQRClick(6)">Generate QR</button>
            </form>


        </div>
    </main>
    <script id="childJson" type="application/json">
        [{
            "id": 157
            , "name": "Mounting Plate #2"
            , "quantity": 2
            , "unit_price": "245.03"
            , "total_price": "490.06"
            , "ordered_date": "08-08-2025"
            , "eta": ""
            , "ata": ""
            , "inspection": ""
            , "pm": ""
            , "image": "/5_710kykO.png"
            , "qr_url": ""
        }, {
            "id": 158
            , "name": "Fuse Holder #5"
            , "quantity": 10
            , "unit_price": "495.19"
            , "total_price": "4951.90"
            , "ordered_date": "08-08-2025"
            , "eta": ""
            , "ata": ""
            , "inspection": ""
            , "pm": ""
            , "image": "/7_gYXcNbt.png"
            , "qr_url": ""
        }, {
            "id": 159
            , "name": "Spare Circuit Breaker #6"
            , "quantity": 5
            , "unit_price": "445.64"
            , "total_price": "2228.20"
            , "ordered_date": "08-08-2025"
            , "eta": ""
            , "ata": ""
            , "inspection": ""
            , "pm": ""
            , "image": "/2_dMxAtFY.png"
            , "qr_url": ""
        }, {
            "id": 160
            , "name": "Cooling Fan #3"
            , "quantity": 8
            , "unit_price": "315.01"
            , "total_price": "2520.08"
            , "ordered_date": "08-08-2025"
            , "eta": ""
            , "ata": ""
            , "inspection": ""
            , "pm": ""
            , "image": "/4_lYeDMYY.png"
            , "qr_url": ""
        }, {
            "id": 161
            , "name": "Protective Cover #1"
            , "quantity": 4
            , "unit_price": "157.29"
            , "total_price": "629.16"
            , "ordered_date": "08-08-2025"
            , "eta": ""
            , "ata": ""
            , "inspection": ""
            , "pm": ""
            , "image": "/11_qZLVMe9.png"
            , "qr_url": ""
        }, {
            "id": 162
            , "name": "Wiring Kit #4"
            , "quantity": 6
            , "unit_price": "395.63"
            , "total_price": "2373.78"
            , "ordered_date": "08-08-2025"
            , "eta": ""
            , "ata": ""
            , "inspection": ""
            , "pm": ""
            , "image": "/6_UMmSbAS.png"
            , "qr_url": ""
        }]

    </script>

    <script>
        const csrftoken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let selectedChildId = 1; // set this dynamically
        let id = `{{ $id }}`;
        let qrAlreadyExists1 = false;
        let qrAlreadyExists2 = false;
        let qrAlreadyExists3 = false;
        let qrAlreadyExists4 = false;
        let qrAlreadyExists5 = false;
        let qrAlreadyExists6 = false;

        function handleQRClick(number) {
            if (number == 1) {
                const name = document.getElementById('child-name-one')?.value || '';
                const qty = document.getElementById('child-qty-one')?.value || '';
                const poNumber = document.getElementById('ponum')?.textContent.trim() || '';

                document.getElementById('qrName-one').textContent = name;
                document.getElementById('qrQty-one').textContent = qty;
                document.getElementById('qrPO-one').textContent = poNumber;

                const qrBtn = document.getElementById("qr-btn1");

                if (qrAlreadyExists1) {
                    viewQR(qrBtn.dataset.qrUrl, 1);
                } else {
                    fetch(`/orders/generate-qr/${id}/${selectedChildId}`, {
                            method: "GET"
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                qrAlreadyExists1 = true;
                                qrBtn.innerText = "View QR";
                                qrBtn.dataset.qrUrl = data.qr_url;
                                viewQR(data.qr_url, 1);
                            } else {
                                alert("QR Generation failed");
                            }
                        });
                }
            } else if (number == 2) {
                const name = document.getElementById('child-name-two')?.value || '';
                const qty = document.getElementById('child-qty-two')?.value || '';
                const poNumber = document.getElementById('ponum')?.textContent.trim() || '';

                document.getElementById('qrName-two').textContent = name;
                document.getElementById('qrQty-two').textContent = qty;
                document.getElementById('qrPO-two').textContent = poNumber;

                const qrBtn = document.getElementById("qr-btn2");

                if (qrAlreadyExists2) {
                    viewQR(qrBtn.dataset.qrUrl, 2);
                } else {
                    fetch(`/orders/generate-qr/${id}/${selectedChildId}`, {
                            method: "GET"
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                qrAlreadyExists2 = true;
                                qrBtn.innerText = "View QR";
                                qrBtn.dataset.qrUrl = data.qr_url;
                                viewQR(data.qr_url, 2);
                            } else {
                                alert("QR Generation failed");
                            }
                        });
                }
            } else if (number == 3) {
                const name = document.getElementById('child-name-three')?.value || '';
                const qty = document.getElementById('child-qty-three')?.value || '';
                const poNumber = document.getElementById('ponum')?.textContent.trim() || '';

                document.getElementById('qrName-three').textContent = name;
                document.getElementById('qrQty-three').textContent = qty;
                document.getElementById('qrPO-three').textContent = poNumber;

                const qrBtn = document.getElementById("qr-btn3");

                if (qrAlreadyExists3) {
                    viewQR(qrBtn.dataset.qrUrl, 3);
                } else {
                    fetch(`/orders/generate-qr/${id}/${selectedChildId}`, {
                            method: "GET"
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                qrAlreadyExists3 = true;
                                qrBtn.innerText = "View QR";
                                qrBtn.dataset.qrUrl = data.qr_url;
                                viewQR(data.qr_url, 3);
                            } else {
                                alert("QR Generation failed");
                            }
                        });
                }
            } else if (number == 4) {
                const name = document.getElementById('child-name-four')?.value || '';
                const qty = document.getElementById('child-qty-four')?.value || '';
                const poNumber = document.getElementById('ponum')?.textContent.trim() || '';

                document.getElementById('qrName-four').textContent = name;
                document.getElementById('qrQty-four').textContent = qty;
                document.getElementById('qrPO-four').textContent = poNumber;

                const qrBtn = document.getElementById("qr-btn4");

                if (qrAlreadyExists4) {
                    viewQR(qrBtn.dataset.qrUrl, 4);
                } else {
                    fetch(`/orders/generate-qr/${id}/${selectedChildId}`, {
                            method: "GET"
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                qrAlreadyExists4 = true;
                                qrBtn.innerText = "View QR";
                                qrBtn.dataset.qrUrl = data.qr_url;
                                viewQR(data.qr_url, 4);
                            } else {
                                alert("QR Generation failed");
                            }
                        });
                }
            } else if (number == 5) {
                const name = document.getElementById('child-name-five')?.value || '';
                const qty = document.getElementById('child-qty-five')?.value || '';
                const poNumber = document.getElementById('ponum')?.textContent.trim() || '';

                document.getElementById('qrName-five').textContent = name;
                document.getElementById('qrQty-five').textContent = qty;
                document.getElementById('qrPO-five').textContent = poNumber;

                const qrBtn = document.getElementById("qr-btn5");

                if (qrAlreadyExists5) {
                    viewQR(qrBtn.dataset.qrUrl, 5);
                } else {
                    fetch(`/orders/generate-qr/${id}/${selectedChildId}`, {
                            method: "GET"
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                qrAlreadyExists5 = true;
                                qrBtn.innerText = "View QR";
                                qrBtn.dataset.qrUrl = data.qr_url;
                                viewQR(data.qr_url, 5);
                            } else {
                                alert("QR Generation failed");
                            }
                        });
                }
            } else if (number == 6) {
                const name = document.getElementById('child-name-six')?.value || '';
                const qty = document.getElementById('child-qty-six')?.value || '';
                const poNumber = document.getElementById('ponum')?.textContent.trim() || '';

                document.getElementById('qrName-six').textContent = name;
                document.getElementById('qrQty-six').textContent = qty;
                document.getElementById('qrPO-six').textContent = poNumber;

                const qrBtn = document.getElementById("qr-btn6");

                if (qrAlreadyExists6) {
                    viewQR(qrBtn.dataset.qrUrl, 6);
                } else {
                    fetch(`/orders/generate-qr/${id}/${selectedChildId}`, {
                            method: "GET"
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                qrAlreadyExists6 = true;
                                qrBtn.innerText = "View QR";
                                qrBtn.dataset.qrUrl = data.qr_url;
                                viewQR(data.qr_url, 6);
                            } else {
                                alert("QR Generation failed");
                            }
                        });
                }
            }

        }

        function viewQR(qrUrl, number) {
            if (number == 1) {
                document.getElementById('qrImage-one').src = qrUrl;
                new bootstrap.Modal(document.getElementById('qrModal-one')).show();
            } else if (number == 2) {
                document.getElementById('qrImage-two').src = qrUrl;
                new bootstrap.Modal(document.getElementById('qrModal-two')).show();
            } else if (number == 3) {
                document.getElementById('qrImage-three').src = qrUrl;
                new bootstrap.Modal(document.getElementById('qrModal-three')).show();
            } else if (number == 4) {
                document.getElementById('qrImage-four').src = qrUrl;
                new bootstrap.Modal(document.getElementById('qrModal-four')).show();
            } else if (number == 5) {
                document.getElementById('qrImage-five').src = qrUrl;
                new bootstrap.Modal(document.getElementById('qrModal-five')).show();
            } else if (number == 6) {
                document.getElementById('qrImage-six').src = qrUrl;
                new bootstrap.Modal(document.getElementById('qrModal-six')).show();
            }

        }

        function printSVGImageFromURL(imgSelector, number) {
            const img = document.querySelector(imgSelector);
            if (!img) {
                alert("QR Image not found");
                return;
            }

            const imgURL = img.src;

            fetch(imgURL)
                .then(res => res.text())
                .then(svgText => {
                    const svgBlob = new Blob([svgText], {
                        type: "image/svg+xml"
                    });
                    const url = URL.createObjectURL(svgBlob);

                    let modalContent = document.querySelector('#qrModal-one .modal-content');

                    if (number == 1) {
                        modalContent = document.querySelector('#qrModal-one .modal-content');
                    } else if (number == 2) {
                        modalContent = document.querySelector('#qrModal-two .modal-content');
                    } else if (number == 3) {
                        modalContent = document.querySelector('#qrModal-three .modal-content');
                    } else if (number == 4) {
                        modalContent = document.querySelector('#qrModal-four .modal-content');
                    } else if (number == 5) {
                        modalContent = document.querySelector('#qrModal-five .modal-content');
                    } else if (number == 6) {
                        modalContent = document.querySelector('#qrModal-six .modal-content');
                    }


                    if (!modalContent) {
                        console.error("Modal content not found");
                        return;
                    }

                    const contentToPrint = modalContent.innerHTML;

                    const image = new Image();
                    image.onload = async function() {
                        await new Promise(resolve => {
                            if (image.complete) resolve();
                            else image.onload = resolve;
                        });
                        if (!image.complete) {
                            console.log("Image not fully loaded yet");
                            return;
                        }

                        const canvas = document.createElement("canvas");
                        canvas.width = image.width;
                        canvas.height = image.height;

                        const ctx = canvas.getContext("2d");
                        ctx.drawImage(image, 0, 0);
                        URL.revokeObjectURL(url);

                        const pngUrl = canvas.toDataURL("image/png");

                        const printWindow = window.open('', '', 'width=800,height=600');
                        printWindow.document.write('<html><head><title>Print QR</title>');
                        printWindow.document.write(`
                            <style>
                            @media print {
                                @page { size: 80mm 100mm; margin: 5mm; }
                                body { font-family: Arial; text-align: center; }
                                img { max-width: 150px; }
                            }
                            </style>
                        `);
                        printWindow.document.write('</head><body>');
                        // printWindow.document.write(`<img src="${pngUrl}" />`);
                        printWindow.document.write(contentToPrint);
                        printWindow.document.write('</body></html>');
                        printWindow.document.close();

                        setTimeout(() => {
                            printWindow.focus();
                            printWindow.print();
                            printWindow.close();
                        }, 500);
                    };

                    image.onerror = function() {
                        alert("Image failed to load.");
                    };

                    image.src = url;
                })
                .catch(error => {
                    console.error("Failed to load SVG:", error);
                    alert("Failed to load QR image.");
                });
        }



        function printQR(number) {
            if (number == 1) {
                printSVGImageFromURL('#qrImage-one', 1);
            } else if (number == 2) {
                printSVGImageFromURL('#qrImage-two', 2);
            } else if (number == 3) {
                printSVGImageFromURL('#qrImage-three', 3);
            } else if (number == 4) {
                printSVGImageFromURL('#qrImage-four', 4);
            } else if (number == 5) {
                printSVGImageFromURL('#qrImage-five', 5);
            } else if (number == 6) {
                printSVGImageFromURL('#qrImage-six', 6);
            }

        }
    </script>

    <script>
        // ✅ Main Logic to Load Sidebar Data
        document.addEventListener("DOMContentLoaded", function() {
            let sidebar = document.querySelector(".modal-right-one");
            let overlay = document.querySelector(".overlay-one");
            let closeBtn = document.querySelector(".close-one");
            let sidebar2 = document.querySelector(".modal-right-two");
            let overlay2 = document.querySelector(".overlay-two");
            let closeBtn2 = document.querySelector(".close-two");
            let sidebar3 = document.querySelector(".modal-right-three");
            let overlay3 = document.querySelector(".overlay-three");
            let closeBtn3 = document.querySelector(".close-three");
            let sidebar4 = document.querySelector(".modal-right-four");
            let overlay4 = document.querySelector(".overlay-four");
            let closeBtn4 = document.querySelector(".close-four");
            let sidebar5 = document.querySelector(".modal-right-five");
            let overlay5 = document.querySelector(".overlay-five");
            let closeBtn5 = document.querySelector(".close-five");
            let sidebar6 = document.querySelector(".modal-right-six");
            let overlay6 = document.querySelector(".overlay-six");
            let closeBtn6 = document.querySelector(".close-six");

            const childData = JSON.parse(document.getElementById("childJson").textContent);

            const classMap = {
                one: 0,
                two: 1,
                three: 2,
                four: 3,
                five: 4,
                six: 5
            };

            document.querySelectorAll(".one").forEach(item => {
                item.addEventListener("click", function() {
                    sidebar.classList.add("show");
                    overlay.classList.add("show");

                    const selectedClass = Object.keys(classMap).find(cls => this.classList.contains(
                        cls));
                    const index = classMap[selectedClass];
                    const child = childData[index];

                    if (!child) {
                        alert("Child not found");
                        return;
                    }

                    // Store ID globally
                    selectedChildId = child.id;
                    qrAlreadyExists1 = !!child.qr_url;

                    // Set QR button state
                    const qrBtn = document.getElementById("qr-btn1");
                    if (qrAlreadyExists1) {
                        qrBtn.innerText = "View QR";
                        qrBtn.dataset.qrUrl = child.qr_url;
                    } else {
                        qrBtn.innerText = "Generate QR";
                        qrBtn.removeAttribute("data-qr-url");
                    }

                    // Fill modal fields
                    document.getElementById("child-image").src = child.image ||
                        "/static/images/no_image.png";
                });
            });

            // Close Sidebar
            closeBtn.addEventListener("click", () => {
                sidebar.classList.remove("show");
                overlay.classList.remove("show");
            });

            overlay.addEventListener("click", () => {
                sidebar.classList.remove("show");
                overlay.classList.remove("show");
            });


            document.querySelectorAll(".two").forEach(item => {
                item.addEventListener("click", function() {
                    sidebar2.classList.add("show");
                    overlay2.classList.add("show");

                    const selectedClass = Object.keys(classMap).find(cls => this.classList.contains(
                        cls));
                    const index = classMap[selectedClass];
                    const child = childData[index];

                    if (!child) {
                        alert("Child not found");
                        return;
                    }

                    // Store ID globally
                    selectedChildId = child.id;
                    qrAlreadyExists2 = !!child.qr_url;

                    // Set QR button state
                    const qrBtn = document.getElementById("qr-btn2");
                    if (qrAlreadyExists2) {
                        qrBtn.innerText = "View QR";
                        qrBtn.dataset.qrUrl = child.qr_url;
                    } else {
                        qrBtn.innerText = "Generate QR";
                        qrBtn.removeAttribute("data-qr-url");
                    }

                    // Fill modal fields
                    document.getElementById("child-image-two").src = child.image ||
                        "/static/images/no_image.png";
                });
            });

            // Close Sidebar
            closeBtn2.addEventListener("click", () => {
                sidebar2.classList.remove("show");
                overlay2.classList.remove("show");
            });

            overlay2.addEventListener("click", () => {
                sidebar2.classList.remove("show");
                overlay2.classList.remove("show");
            });


            document.querySelectorAll(".three").forEach(item => {
                item.addEventListener("click", function() {
                    sidebar3.classList.add("show");
                    overlay3.classList.add("show");

                    const selectedClass = Object.keys(classMap).find(cls => this.classList.contains(
                        cls));
                    const index = classMap[selectedClass];
                    const child = childData[index];

                    if (!child) {
                        alert("Child not found");
                        return;
                    }

                    // Store ID globally
                    selectedChildId = child.id;
                    qrAlreadyExists3 = !!child.qr_url;

                    // Set QR button state
                    const qrBtn = document.getElementById("qr-btn3");
                    if (qrAlreadyExists3) {
                        qrBtn.innerText = "View QR";
                        qrBtn.dataset.qrUrl = child.qr_url;
                    } else {
                        qrBtn.innerText = "Generate QR";
                        qrBtn.removeAttribute("data-qr-url");
                    }

                    // Fill modal fields
                    /* document.getElementById("child-name").innerText = child.name;
                    document.getElementById("child-qty").innerText = child.quantity;
                    document.getElementById("child-unit-price").innerText = child.unit_price;
                    document.getElementById("child-total-price").innerText = child.total_price;
                    document.getElementById("child-date").innerText = child.ordered_date;
                    document.getElementById("eta").value = child.eta;
                    document.getElementById("ata").value = child.ata;
                    document.getElementById("inspection").value = child.inspection;
                    document.getElementById("pm-remarks").value = child.pm;
                    document.getElementById("child-item-id").value = child.id;
                    */
                    document.getElementById("child-image-three").src = child.image ||
                        "/static/images/no_image.png";
                });
            });

            // Close Sidebar
            closeBtn3.addEventListener("click", () => {
                sidebar3.classList.remove("show");
                overlay3.classList.remove("show");
            });

            overlay3.addEventListener("click", () => {
                sidebar3.classList.remove("show");
                overlay3.classList.remove("show");
            });

            document.querySelectorAll(".four").forEach(item => {
                item.addEventListener("click", function() {
                    sidebar4.classList.add("show");
                    overlay4.classList.add("show");

                    const selectedClass = Object.keys(classMap).find(cls => this.classList.contains(
                        cls));
                    const index = classMap[selectedClass];
                    const child = childData[index];

                    if (!child) {
                        alert("Child not found");
                        return;
                    }

                    // Store ID globally
                    selectedChildId = child.id;
                    qrAlreadyExists4 = !!child.qr_url;

                    // Set QR button state
                    const qrBtn = document.getElementById("qr-btn4");
                    if (qrAlreadyExists4) {
                        qrBtn.innerText = "View QR";
                        qrBtn.dataset.qrUrl = child.qr_url;
                    } else {
                        qrBtn.innerText = "Generate QR";
                        qrBtn.removeAttribute("data-qr-url");
                    }

                    // Fill modal fields

                    document.getElementById("child-image-four").src = child.image ||
                        "/static/images/no_image.png";
                });
            });

            // Close Sidebar
            closeBtn4.addEventListener("click", () => {
                sidebar4.classList.remove("show");
                overlay4.classList.remove("show");
            });

            overlay4.addEventListener("click", () => {
                sidebar4.classList.remove("show");
                overlay4.classList.remove("show");
            });

            document.querySelectorAll(".five").forEach(item => {
                item.addEventListener("click", function() {
                    sidebar5.classList.add("show");
                    overlay5.classList.add("show");

                    const selectedClass = Object.keys(classMap).find(cls => this.classList.contains(
                        cls));
                    const index = classMap[selectedClass];
                    const child = childData[index];

                    if (!child) {
                        alert("Child not found");
                        return;
                    }

                    // Store ID globally
                    selectedChildId = child.id;
                    qrAlreadyExists5 = !!child.qr_url;

                    // Set QR button state
                    const qrBtn = document.getElementById("qr-btn5");
                    if (qrAlreadyExists5) {
                        qrBtn.innerText = "View QR";
                        qrBtn.dataset.qrUrl = child.qr_url;
                    } else {
                        qrBtn.innerText = "Generate QR";
                        qrBtn.removeAttribute("data-qr-url");
                    }

                    // Fill modal fields
                    document.getElementById("child-image-five").src = child.image ||
                        "/static/images/no_image.png";
                });
            });

            // Close Sidebar
            closeBtn5.addEventListener("click", () => {
                sidebar5.classList.remove("show");
                overlay5.classList.remove("show");
            });

            overlay5.addEventListener("click", () => {
                sidebar5.classList.remove("show");
                overlay5.classList.remove("show");
            });


            document.querySelectorAll(".six").forEach(item => {
                item.addEventListener("click", function() {
                    sidebar6.classList.add("show");
                    overlay6.classList.add("show");

                    const selectedClass = Object.keys(classMap).find(cls => this.classList.contains(
                        cls));
                    const index = classMap[selectedClass];
                    const child = childData[index];

                    if (!child) {
                        alert("Child not found");
                        return;
                    }

                    // Store ID globally
                    selectedChildId = child.id;
                    qrAlreadyExists6 = !!child.qr_url;

                    // Set QR button state
                    const qrBtn = document.getElementById("qr-btn6");
                    if (qrAlreadyExists6) {
                        qrBtn.innerText = "View QR";
                        qrBtn.dataset.qrUrl = child.qr_url;
                    } else {
                        qrBtn.innerText = "Generate QR";
                        qrBtn.removeAttribute("data-qr-url");
                    }

                    // Fill modal fields
                    document.getElementById("child-image-six").src = child.image ||
                        "/static/images/no_image.png";
                });
            });

            // Close Sidebar
            closeBtn6.addEventListener("click", () => {
                sidebar6.classList.remove("show");
                overlay6.classList.remove("show");
            });

            overlay6.addEventListener("click", () => {
                sidebar6.classList.remove("show");
                overlay6.classList.remove("show");
            });

        });
    </script>

    <script>
        // ✅ Enable Save button only if form changes
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("#saveBtn1").closest("form");
            const saveBtn = document.getElementById("saveBtn1");

            const initialValues = {};
            Array.from(form.elements).forEach(el => {
                if (el.name) {
                    initialValues[el.name] = el.value;
                }
            });

            form.addEventListener("input", () => {
                let changed = false;
                Array.from(form.elements).forEach(el => {
                    if (el.name && initialValues[el.name] !== el.value) {
                        changed = true;
                    }
                });
                saveBtn.disabled = !changed;
            });

            // ✅ Prevent default submit & allow showing validation errors
            form.addEventListener("submit", function(e) {
                e.preventDefault();

                // You can now run your custom validation logic here:
                let hasError = false;

                Array.from(form.elements).forEach(el => {
                    if (el.required && !el.value.trim()) {
                        hasError = true;
                        el.classList.add("border-red-500"); // example styling
                    } else {
                        el.classList.remove("border-red-500");
                    }
                });

                if (!hasError) {
                    // If no validation errors -> submit form manually
                    form.submit();
                }
            });
        });




        // ✅ Enable Save button only if form changes
        document.addEventListener("DOMContentLoaded", function() {
            const form2 = document.querySelector("#saveBtn2").closest("form");
            const saveBtn2 = document.getElementById("saveBtn2");


            const initialValues = {};
            Array.from(form2.elements).forEach(el => {
                if (el.name) {
                    initialValues[el.name] = el.value;
                }
            });

            form2.addEventListener("input", () => {
                let changed = false;
                Array.from(form2.elements).forEach(el => {
                    if (el.name && initialValues[el.name] !== el.value) {
                        changed = true;
                    }
                });
                saveBtn2.disabled = !changed;
            });
        });



        // ✅ Enable Save button only if form changes
        document.addEventListener("DOMContentLoaded", function() {
            const form3 = document.querySelector("#saveBtn3").closest("form");
            const saveBtn3 = document.getElementById("saveBtn3");


            const initialValues = {};
            Array.from(form3.elements).forEach(el => {
                if (el.name) {
                    initialValues[el.name] = el.value;
                }
            });

            form3.addEventListener("input", () => {
                let changed = false;
                Array.from(form3.elements).forEach(el => {
                    if (el.name && initialValues[el.name] !== el.value) {
                        changed = true;
                    }
                });
                saveBtn3.disabled = !changed;
            });
        });

        // ✅ Enable Save button only if form changes
        document.addEventListener("DOMContentLoaded", function() {
            const form4 = document.querySelector("#saveBtn4").closest("form");
            const saveBtn4 = document.getElementById("saveBtn4");


            const initialValues = {};
            Array.from(form4.elements).forEach(el => {
                if (el.name) {
                    initialValues[el.name] = el.value;
                }
            });

            form4.addEventListener("input", () => {
                let changed = false;
                Array.from(form4.elements).forEach(el => {
                    if (el.name && initialValues[el.name] !== el.value) {
                        changed = true;
                    }
                });
                saveBtn4.disabled = !changed;
            });
        });


        // ✅ Enable Save button only if form changes
        document.addEventListener("DOMContentLoaded", function() {
            const form5 = document.querySelector("#saveBtn5").closest("form");
            const saveBtn5 = document.getElementById("saveBtn5");


            const initialValues = {};
            Array.from(form5.elements).forEach(el => {
                if (el.name) {
                    initialValues[el.name] = el.value;
                }
            });

            form5.addEventListener("input", () => {
                let changed = false;
                Array.from(form5.elements).forEach(el => {
                    if (el.name && initialValues[el.name] !== el.value) {
                        changed = true;
                    }
                });
                saveBtn5.disabled = !changed;
            });
        });

        // ✅ Enable Save button only if form changes
        document.addEventListener("DOMContentLoaded", function() {
            const form6 = document.querySelector("#saveBtn6").closest("form");
            const saveBtn6 = document.getElementById("saveBtn6");


            const initialValues = {};
            Array.from(form6.elements).forEach(el => {
                if (el.name) {
                    initialValues[el.name] = el.value;
                }
            });

            form6.addEventListener("input", () => {
                let changed = false;
                Array.from(form6.elements).forEach(el => {
                    if (el.name && initialValues[el.name] !== el.value) {
                        changed = true;
                    }
                });
                saveBtn6.disabled = !changed;
            });
        });
    </script>

</x-app-layout>
