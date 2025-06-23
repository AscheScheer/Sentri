<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Tambahkan ini di bagian <head> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bs-primary: #4ade80 !important;
            /* Tailwind green-400 */
        }

        .btn-primary {
            background-color: #379146 !important;
            border-color: #000 !important;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #4ade80 !important;
            /* Lighten on hover (Tailwind green-400) */
            border-color: #000 !important;
        }
    </style>
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-green-50"> <!-- Changed from bg-gray-100 to bg-green-50 -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-green-100 shadow"> <!-- Changed from bg-white to bg-green-100 -->
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

</html>
