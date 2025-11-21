@vite('resources/css/components/home_header.css')

<header class="header">
    <div class="header-content">
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