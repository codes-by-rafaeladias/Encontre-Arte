@vite(['resources/css/app.css', 'resources/css/components/topbar.css'])
<header class="topbar">
    <div class="topbar-content">

        <button id="toggleSidebar" class="menu-toggle">
             <i class="fa-solid fa-bars"></i>
            </button>

        <div class="user-info" id="userMenu">

    <div class="avatar-wrapper">
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
    </div>

    <span class="user-name">
        {{ preg_split('/\s+/', trim(auth()->user()->name))[0] }}
    </span>
    </div>
    </div>
</header>