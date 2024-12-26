<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Inventory Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const spinner = document.getElementById('loading-spinner');
            window.addEventListener('beforeunload', function () {
                spinner.style.display = 'flex';
            });
            window.addEventListener('load', function () {
                setTimeout(function() {
                    spinner.style.display = 'none';
                }, 1000);
            });
        });
    </script>
</head>
<body> 
    <div>
        {{-- Sidebar --}}
        @include('components/Sidebar')

        <div id="loading-spinner" class="flex justify-center items-center bg-gray-950 fixed top-0 left-0 w-full h-full z-50 bg-opacity-50" style="display: none;">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem; role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        {{-- Header --}}
        @include('components/header')
        
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 dark:bg-gray-800">
            <div class="px-4 py-8 mx-auto">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>