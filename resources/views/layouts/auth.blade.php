<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Entrar | Encontre Arte')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    />
</head>

<body class="auth-body">
    <main>
        @yield('content')
    </main>
    @include('components.alerts')
    @stack('scripts')
</body>
</html>
