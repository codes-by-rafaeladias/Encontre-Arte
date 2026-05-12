@vite(['resources/css/app.css', 'resources/css/components/search_filters.css'])
<div class="search-filters">
    <p class="description">Filtrar por:</p>
    <input
        type="hidden"
        name="search_type"
        id="search_type"
        value="{{ request('search_type', 'artisan') }}">
    <button type="button" 
    class="filter-chip {{ request('search_type', 'artisan') === 'artisan' ? 'active' : '' }}" 
    data-type="artisan">
        <img src="{{ asset('images/artist-hover-selected.png') }}" alt="Artesão" class="icon-img d-block">
        <img src="{{ asset('images/artist.png') }}" alt="Artesão" class="icon-img d-none">
        <p>Artesão</p>
    </button>
    <button type="button" 
    class="filter-chip {{ request('search_type') === 'location' ? 'active' : '' }}"
    data-type="location">
        <i class="fa-solid fa-location-dot"></i>
        <p>Localização</p>
        </button>
</div>
@push('scripts')
<script>
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