<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Encontre Arte')</title>

    @vite(['resources/css/app.css','resources/css/layout_app.css','resources/js/app.js'])
    @stack('styles')

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    />
</head>
<body class="app-body">

    <div class="app-container">

        @auth
            @if(auth()->user()->type === 'customer')
                @include('components.sidebar.bar_customer')
            @elseif(auth()->user()->type === 'artisan')
                @include('components.sidebar.bar_artisan')
            @endif
        @endauth

        <div id="overlay" class="overlay"></div>

        <div class="main-content">

            @include('components.topbar')

            <main class="content">
                @yield('content')
            </main>

        </div>

    </div>

    @include('components.alerts')
    @stack('scripts')
</body>
</html>
