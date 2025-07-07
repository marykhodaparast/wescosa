{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Production Dashboard</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

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

        .analytics {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .analytics .card {
            flex: 1;
            margin: 10px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .charts {
            margin-top: 30px;
        }


        .circular-progress {
            /* position: relative; */
            width: 380px;
            height: 300px;
        }

        svg {
            transform: rotate(-90deg);
        }

        input.is-invalid {
            border: 1px solid red;
        }


        circle {
            fill: none;
            stroke-width: 10;
            stroke-linecap: round;
        }

        .bg {
            stroke: #e6e6e6;
        }

        .progress {
            /* stroke: #3498db; */
            /* stroke: #2121e5; */
            stroke: #3030b7;
            stroke-dasharray: 565.48;
            stroke-dashoffset: 565.48;
            transition: stroke-dashoffset 0.5s ease-in-out;
        }

        .progress-text {
            position: absolute;
            top: 63%;
            left: 44%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            font-family: Arial, sans-serif;
            color: #333;
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

        /* Spacing between form groups */
        .form-group {
            margin-bottom: 1.2rem;
        }

        /* Button area spacing */
        .buttons {
            padding-top: 1rem;
            padding-bottom: 2rem;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        /* Optional: make buttons consistent size */
        .buttons .btn {
            min-width: 120px;
        }

        /* Responsive spacing on smaller screens */
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
        }

        .upload-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
        }

        .upload-button {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .upload-label {
            font-weight: 500;
            margin-right: 15px;
        }

        .divider {
            height: 1px;
            background-color: black;
            flex: 1;
        }

        .or-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 30px 0;
        }

        .error-msg {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
            margin-left: 3px;
        }

        .logout-button-style {
            border: none !important;
            color: rgb(3, 36, 76) !important;
            background-color: #AEC3EA !important;
        }

    </style>

</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <nav class="col-md-2 sidebar d-flex flex-column" height="100vh">
                <img class="ms-4" src="{{asset('logo.png')}}" alt="Logo" width="150" height="90">
                <a href="/dashboard">Dashboard</a>
                <a href="/orders/po_list/">Purchase Orders</a>
                <a href="#">Users</a>
                <a href="#">Reports</a>
                <a href="#">Analytics</a>
                <a href="#">Settings</a>
                <form method="POST" action="/logout" style="margin-top:260px !important;">
                    @csrf
                    <button type="submit" class="logout logout-button-style">Logout</button>
                </form>

            </nav>
        </div>

        {{-- Main content --}}
        <main class="flex-1 p-6">
            {{ $header ?? '' }}

            <div class="">
                {{ $slot }}
            </div>
        </main>
    </div>
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


    @stack('scripts')

</body>
</html>
