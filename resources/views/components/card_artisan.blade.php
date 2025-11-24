@vite('resources/css/components/card_artisan.css')
@props(['artisan'])

<a href="{{ route('login', $artisan->id) }}" class="artisan-card">

    <div class="artisan-card-left">
        @if($artisan->profile_image)
        <img 
            src="{{ asset('storage/' . $artisan->profile_image) }}"
            alt="Foto do Artesão"
            class="artisan-avatar"
        >
        @else
        @php
        $nome = $artisan->name;
        $iniciais = collect(explode(' ', $nome))
                    ->map(fn($p) => mb_substr($p, 0, 1))
                    ->take(2)
                    ->implode('');
        @endphp
        <div class="avatar-str">
            {{ strtoupper($iniciais) }}
        </div>
        @endif
    </div>

    <div class="artisan-card-center">
        <h3 class="artisan-name">{{ $artisan->name }}</h3>

        @if($artisan->business_name)
            <p class="artisan-business">{{ $artisan->business_name }}</p>
        @endif

    </div>

</a>
