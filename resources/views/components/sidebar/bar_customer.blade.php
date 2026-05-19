@vite(['resources/css/app.css', 'resources/css/components/sidebar.css'])
<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('images/logo-icon.png') }}" class="logo-img">
            <span class="logo-text">Encontre Arte</span>
        </div>
    </div>

    <nav class="sidebar-menu">

        <a href="{{ route('customer.home') }}"
           class="menu-item {{ request()->routeIs('customer.home') ? 'active' : '' }}">
            <i class="fa-solid fa-house icon"></i>
            <span>Início</span>
        </a>

        <a href="{{ route('customer.products.index') }}"
           class="menu-item {{ request()->routeIs('customer.products.index', 
           'customer.product.data') ? 'active' : '' }}">
            <i class="fa-solid fa-bag-shopping icon"></i>
            <span>Produtos</span>
        </a>

        <a href="{{ route('customer.artisans.index') }}"
           class="menu-item {{ request()->routeIs('customer.artisans.index',
           'customer.artisan.profile') ? 'active' : '' }}">
            <i class="fa-solid fa-palette"></i>
            <span>Artesãos</span>
        </a>

        <a href="{{ route('customer.favorites.index') }}"
           class="menu-item {{ request()->routeIs('customer.favorites.index') ? 'active' : '' }}">
            <i class="fa-solid fa-heart icon"></i>
            <span>Favoritos</span>
        </a>

        <a href="{{ route('customer.reviews.index') }}"
           class="menu-item {{ request()->routeIs('customer.reviews.index',
           'customer.review.destroy') ? 'active' : '' }}">
            <i class="fa-solid fa-star icon"></i>
            <span>Avaliações</span>
        </a>

        <a href="{{ route('customer.following.artisans') }}"
           class="menu-item {{ request()->routeIs('customer.following.artisans') ? 'active' : '' }}">
            <i class="fa-solid fa-users icon"></i>
            <span>Seguindo</span>
        </a>

        <a href="{{ route('customer.profile.data') }}"
           class="menu-item {{ request()->routeIs('customer.profile.*') ? 'active' : '' }}">
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
