@vite('resources/css/components/app_header.css')
@props(['icone'])

@php
    $link = auth()->user()->type === 'artisan'
        ? route('painel.artesao')
        : route('painel.cliente');
@endphp
<header class="header">

    <div class="header-left">
        <a href="{{ $link }}">
            <i class="{{ $icone }} home-icon"></i>
        </a>
    </div>

    <div class="header-right">

        <a class="avatar-wrapper">
             @if(auth()->user()->profile_image)
            <img 
                src="{{ asset('storage/' . auth()->user()->profile_image) }}"
            class="avatar-img"
            alt="Avatar"
            >
            @else
            @php
            $nome = auth()->user()->name;
            $iniciais = collect(explode(' ', $nome))
                        ->map(fn($p) => mb_substr($p, 0, 1))
                        ->take(2)
                        ->implode('');
            @endphp
            <div class="avatar-fallback">
                {{ strtoupper($iniciais) }}
            </div>
            @endif
        </a>
        <a href="{{ route('logout') }}">
            <img src="{{ asset('images/logout.png') }}" alt="Sair" class="logout-icon">
        </a>

    </div>

</header>
