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
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
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

    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-blue-200 text-black p-4 flex flex-col justify-between" style="background-color:#AEC3EA !important;">
            <div>
                <img src="{{ asset('logo.png') }}" alt="Logo" class="ms-4" width="150" height="90" style="height:90px !important" />
                <nav class="space-y-4 sidebar">
                    <a href="#" class="block font-semibold">Dashboard</a>
                    <a href="#" class="block font-semibold">Purchase Orders</a>
                    <a href="#" class="block font-semibold">Users</a>
                    <a href="#" class="block font-semibold">Reports</a>
                    <a href="#" class="block font-semibold">Analytics</a>
                    <a href="#" class="block font-semibold">Settings</a>
                </nav>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-6 font-semibold">Logout</button>
            </form>
        </aside>

        {{-- Main content --}}
        <main class="flex-1 p-6">
            {{ $header ?? '' }}

            <div class="mt-6">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
