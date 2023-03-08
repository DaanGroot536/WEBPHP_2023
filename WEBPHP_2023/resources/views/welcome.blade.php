<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/welcome.css" rel="stylesheet" type="text/css">
    </head>
    <body class="antialiased">
        <div
            class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="trackrLogo">TrackR</a>
                @else
                    <a href="{{ route('login') }}" class="trackrLogo">TrackR
                    </a>
                @endauth
            @endif

        </div>
        <p class="trackrLogo">TrackR</p>
    </body>
</html>
