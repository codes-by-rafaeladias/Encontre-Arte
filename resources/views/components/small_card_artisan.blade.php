@vite(['resources/css/app.css', 'resources/css/components/small_card_artisan.css'])

@props(['artisan'])

<a href="{{ route('customer.artisan.profile', $artisan->slug) }}" class="artisan-card">
    <div class="artisan-cover">

        @if($artisan->profile_image)

            <img
                src="{{ asset('storage/' . $artisan->profile_image) }}"
                alt="{{ $artisan->name }}"
                class="artisan-avatar">

        @else

            <div class="artisan-avatar artisan-fallback">
                {{ strtoupper(mb_substr($artisan->name, 0, 1)) }}
            </div>

        @endif

    </div>

    <div class="artisan-content">

        <h3 class="artisan-name">
            {{ $artisan->business_name ?? $artisan->name }}
        </h3>

        <p class="artisan-location">
            {{ $artisan->city }} • {{ $artisan->state }}
        </p>

    </div>

</a>