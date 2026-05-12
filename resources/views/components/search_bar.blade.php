@props([
    'placeholder',
    'name',
    'value',
    'categories' => [],
    'techniques' => [],
    'materials' => []
])

@vite(['resources/css/app.css', 'resources/css/components/search_bar.css'])

<div class="search-input-wrapper">

    <i class="fa-solid fa-magnifying-glass search-input-icon"></i>
    <input 
        type="text"
        id="search-input"
        class="search-input-field"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        value="{{ $value ?? '' }}"
    >

    <select
        id="category-select"
        class="search-select"
    >
        <option value="">Selecione uma categoria</option>

        @foreach($categories as $category)
            <option value="{{ $category->name }}"
                {{ $value == $category->name ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <select
        id="technique-select"
        class="search-select"
    >
        <option value="">Selecione uma técnica</option>

        @foreach($techniques as $technique)
            <option value="{{ $technique->name }}" 
                {{ $value == $technique->name ? 'selected' : '' }}>
                {{ $technique->name }}
            </option>
        @endforeach
    </select>

    <select
        id="material-select"
        class="search-select"
    >
        <option value="">Selecione um material</option>

        @foreach($materials as $material)
            <option value="{{ $material->name }}"
                {{ $value == $material->name ? 'selected' : '' }}>
                {{ $material->name }}
            </option>
        @endforeach
    </select>

    <button
        type="button"
        id="clear-search-btn"
        class="clear-search-btn"
    >
        <i class="fa-solid fa-xmark"></i>
    </button>

    <i class="fa-solid fa-chevron-down select-arrow"></i>

</div>
@push('scripts')
<script>

    const chips =
        document.querySelectorAll('.filter-chip');

    const searchInput =
        document.getElementById('search-input');

    const categorySelect =
        document.getElementById('category-select');

    const techniqueSelect =
        document.getElementById('technique-select');

    const materialSelect =
        document.getElementById('material-select');

    const clearBtn =
        document.getElementById('clear-search-btn');
    
    const selectArrow = document.querySelector(".select-arrow");

    function hideAll() {

        clearBtn.style.display = 'none';

        searchInput.style.display = 'none';

        categorySelect.style.display = 'none';

        techniqueSelect.style.display = 'none';

        materialSelect.style.display = 'none';

        selectArrow.style.display = 'none';

    }

    function removeNames() {
        
        searchInput.removeAttribute('name');

        categorySelect.removeAttribute('name');

        techniqueSelect.removeAttribute('name');

        materialSelect.removeAttribute('name');
    }

    function updateUI(type) {

        hideAll();
        removeNames();

        if (type === 'category') {

            categorySelect.style.display = 'block';
            categorySelect.setAttribute('name', 'search');
            selectArrow.style.display = 'block';

        } else if (type === 'technique') {

            techniqueSelect.style.display = 'block';
            techniqueSelect.setAttribute('name', 'search');
            selectArrow.style.display = 'block';

        } else if (type === 'material') {

            materialSelect.style.display = 'block';
            materialSelect.setAttribute('name', 'search');
            selectArrow.style.display = 'block';

        } else {

            searchInput.style.display = 'block';
            searchInput.setAttribute('name', 'search');

        }

    }

    const currentType =
        document.getElementById('search_type').value;

    updateUI(currentType);

    chips.forEach(chip => {

        chip.addEventListener('click', () => {

            updateUI(chip.dataset.type);

        });

    });

    searchInput.addEventListener('input', () => {
        clearBtn.style.display = 'block';
    });

    clearBtn.addEventListener('click', () => {
        searchInput.value = '';
    });

    categorySelect.addEventListener('change', () => {
        categorySelect.closest('form').submit();
    });

    techniqueSelect.addEventListener('change', () => {
        techniqueSelect.closest('form').submit();
    });

    materialSelect.addEventListener('change', () => {materialSelect.closest('form').submit();
});

</script>
@endpush