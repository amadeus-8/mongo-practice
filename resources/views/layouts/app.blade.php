<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="header">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <div class="navbar-nav">
                        <a class="nav-link" href="{{ route('study') }}">Онлайн обучение<span class="sr-only">(current)</span></a>
                        <a class="nav-link" href="{{ route('organization') }}">Организации</a>
                        <a class="nav-link" href="{{ route('school') }}">Школы</a>
                        <a class="nav-link" href="{{ route('budget') }}">Бюджет</a>
                    </div>
                </nav>
            </div>
        </header>

        <main class="mt-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
