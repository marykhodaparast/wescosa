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
        .modal-right {
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

        .modal-right.show {
            right: 0;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 999;
        }

        .overlay.show {
            display: block;
        }

        .close {
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
                        <h6></h6>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="row">
            <div class="col-12 ps-5">
                <h2 class="text-left" id="ponum">PO-{{ 1000 + $data->id }}</h2>


                <div class="job-info">
                    <div class="row">
                        <div class="col-md-1"><small>Job No.</small><br><span
                                class="bold-text">JOB-{{ $data->job_number }}</span></div>
                        <div class="col-md-2"><small>Product</small><br><span class="bold-text">
                                @switch($data->product_name)
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
        <div class="modal fade" id="qrModal" tabindex="-1">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <!-- Changed to modal-sm -->
                <div class="modal-content p-2">
                    <!-- Reduced padding -->
                    <div class="modal-header">
                        <h6 class="modal-title">QR Code</h6> <!-- Smaller title -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="qrImage" src="" class="img-fluid" style="max-width: 150px;"
                            alt="QR Code">
                        <div class="mt-2" style="font-size: 14px;">
                            <p><span class="fs-6" id="qrName"></span></p>

                            <p>PO No: <span id="qrPO"></span></p>
                            <p>Qty: <span id="qrQty"></span></p>
                        </div>
                        <br><br>
                        <button class="btn btn-sm btn-dark" onclick="printQR()">Print QR</button>
                        <!-- Smaller button -->
                    </div>
                </div>
            </div>
        </div>



        <div class="overlay"></div>
        <div class="modal-right">
            <div>
                <span class="fs-6" id="child-name">Child Name</span>
                <button type="button" class="close">X</button>
            </div>

            <div class="card">
                <div class="card-image">
                    <img id="child-image" src="" alt="Circuit diagram" height="120px">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <span style="font-size: 10px;">QUANTITY</span><br>
                    <span id="child-qty" style="font-size: 10px;font-weight: 700;"></span>
                </div>
                <div class="col-md-4">
                    <span style="font-size: 10px;">UNIT PRICE</span><br>
                    <span id="child-unit-price" style="font-size: 10px;font-weight: 700;"></span>
                </div>
                <div class="col-md-4">
                    <span style="font-size: 10px;">TOTAL PRICE</span><br>
                    <span id="child-total-price" style="font-size: 10px;font-weight: 700;"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <span style="font-size: 10px;">ORDERED DATE</span><br>
                    <span id="child-date" style="font-size: 10px;font-weight: 700;"></span>
                </div>
            </div>

            <!-- Form should not be inside .row unless you want grid columns inside -->
            <form method="POST" action="/orders/update_eta_ata/" style="margin-top: 15px;">
                <input type="hidden" name="csrfmiddlewaretoken"
                    value="598BMLui4JhTAF2jrtAZ0L5NCuNLeVX8b0yJdslPQCzknnqhZIXDqvcUczt5NohF">
                <input type="hidden" class="form-control" name="item_id" id="child-item-id">

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">ETA</label>
                    <input type="date" class="form-control" id="eta" name="eta"
                        style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">ATA</label>
                    <input type="date" class="form-control" id="ata" name="ata"
                        style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-2">
                    <label style="font-size: 12px;">Inspection Remarks</label>
                    <input type="text" class="form-control" id="inspection" name="inspection"
                        style="font-size: 0.7rem;">
                </div>

                <div class="form-group mb-3">
                    <label style="font-size: 12px;">Production Manager Remarks</label>
                    <input type="text" class="form-control" id="pm-remarks" name="pm_remarks"
                        style="font-size: 0.7rem;">
                </div>

                <button type="submit" class="btn btn-primary mt-2" id="saveBtn" disabled>Save Changes</button>
                <button type="button" id="qr-btn" class="btn btn-success mt-2"
                    onclick="handleQRClick()">Generate QR</button>
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
        let qrAlreadyExists = false;

        function handleQRClick() {
            const name = document.getElementById('child-name')?.textContent || '';
            const qty = document.getElementById('child-qty')?.textContent || '';
            const poNumber = document.getElementById('ponum')?.textContent.trim() || '';

            document.getElementById('qrName').textContent = name;
            document.getElementById('qrQty').textContent = qty;
            document.getElementById('qrPO').textContent = poNumber;

            const qrBtn = document.getElementById("qr-btn");

            if (qrAlreadyExists) {
                viewQR(qrBtn.dataset.qrUrl);
            } else {
                fetch(`/orders/generate-qr/${selectedChildId}`, {
                        method: "GET"
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            qrAlreadyExists = true;
                            qrBtn.innerText = "View QR";
                            qrBtn.dataset.qrUrl = data.qr_url;
                            viewQR(data.qr_url);
                        } else {
                            alert("QR Generation failed");
                        }
                    });
            }

        }

        function viewQR(qrUrl) {
            document.getElementById('qrImage').src = qrUrl;
            new bootstrap.Modal(document.getElementById('qrModal')).show();
        }

        function printSVGImageFromURL(imgSelector) {
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

                    const modalContent = document.querySelector('#qrModal .modal-content');

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



        function printQR() {
            printSVGImageFromURL('#qrImage');
        }
    </script>



    <script>
        // ✅ Main Logic to Load Sidebar Data
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.querySelector(".modal-right");
            const overlay = document.querySelector(".overlay");
            const closeBtn = document.querySelector(".close");

            const childData = JSON.parse(document.getElementById("childJson").textContent);

            const classMap = {
                one: 0,
                two: 1,
                three: 2,
                four: 3,
                five: 4,
                six: 5
            };

            document.querySelectorAll(".one, .two, .three, .four, .five, .six").forEach(item => {
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
                    qrAlreadyExists = !!child.qr_url;

                    // Set QR button state
                    const qrBtn = document.getElementById("qr-btn");
                    if (qrAlreadyExists) {
                        qrBtn.innerText = "View QR";
                        qrBtn.dataset.qrUrl = child.qr_url;
                    } else {
                        qrBtn.innerText = "Generate QR";
                        qrBtn.removeAttribute("data-qr-url");
                    }

                    // Fill modal fields
                    document.getElementById("child-name").innerText = child.name;
                    document.getElementById("child-qty").innerText = child.quantity;
                    document.getElementById("child-unit-price").innerText = child.unit_price;
                    document.getElementById("child-total-price").innerText = child.total_price;
                    document.getElementById("child-date").innerText = child.ordered_date;
                    document.getElementById("eta").value = child.eta;
                    document.getElementById("ata").value = child.ata;
                    document.getElementById("inspection").value = child.inspection;
                    document.getElementById("pm-remarks").value = child.pm;
                    document.getElementById("child-item-id").value = child.id;
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
        });
    </script>

    <script>
        // ✅ Enable Save button only if form changes
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("#saveBtn").closest("form");
            const saveBtn = document.getElementById("saveBtn");


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
        });
    </script>

</x-app-layout>
