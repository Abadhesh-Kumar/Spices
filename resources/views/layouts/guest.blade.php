<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TradiFoods') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-sand font-sans text-ink">
        <div class="min-h-screen flex flex-col items-center justify-center px-6 py-12">
            <a href="/" class="mb-8 text-2xl font-display">TradiFoods</a>
            <div class="w-full max-w-md card p-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
