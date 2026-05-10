@vite(['resources/css/app.css', 'resources/css/components/search_filters.css'])
<div class="search-filters">
    <p class="description">Filtrar por:</p>
    <input
        type="hidden"
        name="search_type"
        id="search_type"
        value="{{ request('search_type', 'product') }}">
    <button type="button" 
    class="filter-chip {{ request('search_type', 'product') === 'product' ? 'active' : '' }}"
    data-type="product">
        <i class="fa-solid fa-bag-shopping"></i>
        <p>Produto</p>
    </button>
    <button type="button" 
    class="filter-chip {{ request('search_type') === 'artisan' ? 'active' : '' }}" 
    data-type="artisan">
        <img src="{{ asset('images/artist-hover-selected.png') }}" alt="Artesão" class="icon-img d-block">
        <img src="{{ asset('images/artist.png') }}" alt="Artesão" class="icon-img d-none">
        <p>Artesão</p>
    </button>
    <button  type="button" 
    class="filter-chip {{ request('search_type') === 'category' ? 'active' : '' }}"
    data-type="category">
        <i class="fa-solid fa-layer-group"></i>
        <p>Categoria</p>
    </button>
    <button type="button" 
    class="filter-chip {{ request('search_type') === 'technique' ? 'active' : '' }}"
    data-type="technique">
        <i class="fa-solid fa-paintbrush"></i>
        <p>Técnica</p>
    </button>
    <button type="button" 
    class="filter-chip {{ request('search_type') === 'material' ? 'active' : '' }}" 
    data-type="material">
        <i class="fa-solid fa-palette"></i>
        <p>Material</p>
    </button>
    <button type="button" 
    class="filter-chip {{ request('search_type') === 'location' ? 'active' : '' }}"
    data-type="location">
        <i class="fa-solid fa-location-dot"></i>
        <p>Local</p>
        </button>
</div>
@push('scripts')
<script>
    const chips = document.querySelectorAll('.filter-chip');
    const searchType = document.getElementById('search_type');

    chips.forEach(chip => {

        chip.addEventListener('click', () => {

            chips.forEach(c =>
                c.classList.remove('active')
            );

            chip.classList.add('active');

            searchType.value =
                chip.dataset.type;
        });

    });
</script>
@endpush