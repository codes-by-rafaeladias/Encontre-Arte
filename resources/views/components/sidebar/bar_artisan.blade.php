@vite(['resources/css/app.css', 'resources/css/components/sidebar.css'])
<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('images/logo-icon.png') }}" class="logo-img">
            <span class="logo-text">Encontre Arte</span>
        </div>
    </div>

    <nav class="sidebar-menu">

        <a href="{{ route('artisan.home') }}"
           class="menu-item {{ request()->routeIs('artisan.home') ? 'active' : '' }}">
            <i class="fa-solid fa-house icon"></i>
            <span>Início</span>
        </a>

        <a href="{{ route('artisan.products.index') }}"
           class="menu-item {{ request()->routeIs('artisan.products.index', 
           'artisan.products.update.index', 'artisan.products.update.update',
           'artisan.products.destroy') ? 'active' : '' }}">
            <i class="fa-solid fa-bag-shopping icon"></i>
            <span>Produtos</span>
        </a>

        <a href="{{ route('artisan.products.create') }}"
           class="menu-item {{ request()->routeIs('artisan.products.create', 
           'artisan.products.store') ? 'active' : '' }}">
            <span class="icon">
                <i class="fa-solid fa-plus"></i>
            </span>
            <span>Adicionar Produto</span>
        </a>

        <a href="{{ route('artisan.reviews.index') }}"
           class="menu-item {{ request()->routeIs('artisan.reviews.index') ? 'active' : '' }}">
            <i class="fa-solid fa-star icon"></i>
            <span>Avaliações dos Clientes</span>
        </a>

        <a href="{{ route('artisan.smart-suggestions.index') }}"
           class="menu-item {{ request()->routeIs('artisan.smart-suggestions.index') ? 'active' : '' }}">
            <i class="fa-solid fa-lightbulb icon"></i>
            <span>Sugestões Inteligentes</span>
        </a>

        <a href="{{ route('artisan.profile.data') }}"
           class="menu-item {{ request()->routeIs('artisan.profile.data', 
           'artisan.profile.update') ? 'active' : '' }}">
            <i class="fa-solid fa-user icon"></i>
            <span>Perfil</span>
        </a>

        <a href="{{ route('auth.logout') }}"
           class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket"></i> 
            <span>Sair</span>
        </a>
        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" hidden>
            @csrf
        </form>

    </nav>
</aside>