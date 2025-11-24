@props(['placeholder', 'name'])
@vite(['resources/css/app.css', 'resources/css/components/search_bar.css'])
<div class="search-input-wrapper">
    <i class="fa-solid fa-magnifying-glass search-input-icon"></i> 
    <input 
        type="text"
        name="{{ $name }}"
        class="search-input-field"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
    >
</div>