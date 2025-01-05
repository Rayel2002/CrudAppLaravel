<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Application')</title>
        @vite('resources/css/app.css') <!-- Tailwind CSS -->
    </head>
    <body class="bg-gray-100 text-gray-800">
        <!-- Navbar -->
        @include('partials.navbar')
    
        <!-- Content -->
        <div class="container mx-auto mt-8">
            @yield('content')
        </div>
    
        <!-- Footer -->
        @include('partials.footer')
    </body>
    </html>