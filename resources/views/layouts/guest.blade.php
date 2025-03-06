<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gestion des Tâches') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .alert {
                transition: opacity 0.5s ease-out;
            }

            .alert.fade {
                opacity: 0;
            }

            .alert-danger {
                background-color: #ffdddd;
                color: #d8000c;
                border-left: 5px solid #d8000c;
                padding: 10px;
                margin-bottom: 15px;
                font-size: 14px;
                border-radius: 5px;
            }

            .alert-success {
                background-color: #ddffdd;
                color: #0c8a0c;
                border-left: 5px solid #0c8a0c;
                padding: 10px;
                margin-bottom: 15px;
                font-size: 14px;
                border-radius: 5px;
            }

        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
