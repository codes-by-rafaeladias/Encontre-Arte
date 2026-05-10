@props(['placeholder', 'name', 'value'])
@vite(['resources/css/app.css', 'resources/css/components/search_bar.css'])
<div class="search-input-wrapper">
    <i class="fa-solid fa-magnifying-glass search-input-icon"></i> 
    <input 
        type="text"
        name="{{ $name }}"
        class="search-input-field"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        value="{{ $value ?? '' }}"
    >
    <button
        type="button"
        id="clear-search-btn"
        class="clear-search-btn">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>
@push('scripts')
<script>

    const searchInput = document.querySelector('.search-input-field');
    const clearBtn = document.querySelector('#clear-search-btn');

    function toggleClearButton() {

        clearBtn.style.display =
            searchInput.value.length > 0
                ? 'flex'
                : 'none';

    }

    toggleClearButton();

    searchInput.addEventListener('input', toggleClearButton);

    clearBtn.addEventListener('click', () => {
        searchInput.value = '';
    });
</script>
@endpush