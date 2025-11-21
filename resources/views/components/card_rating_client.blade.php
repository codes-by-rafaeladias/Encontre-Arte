@props(['produto', 'usuario', 'nota', 'texto', 'imagem', 'rotaEditar'])
@vite('resources/css/components/card_rating_client.css')

<div class="avaliacao-card cliente">
    <div class="avaliacao-imagem">
        <img src="{{ asset('storage/' . $imagem) }}" alt="{{ $produto }}">
    </div>

    <div class="avaliacao-conteudo">
        <h3 class="avaliacao-produto">{{ $produto }}</h3>
        <p class="avaliacao-usuario">por <strong>{{ $usuario }}</strong></p>

        <div class="avaliacao-estrelas">
            @php
                $estrelasCheias = floor($nota);
                $meiaEstrela = ($nota - $estrelasCheias) >= 0.5;
                $estrelasVazias = 5 - $estrelasCheias - ($meiaEstrela ? 1 : 0);
            @endphp

            @for ($i = 0; $i < $estrelasCheias; $i++)
                <i class="fa-solid fa-star"></i>
            @endfor

            @if ($meiaEstrela)
                <i class="fa-solid fa-star-half-stroke"></i>
            @endif

            @for ($i = 0; $i < $estrelasVazias; $i++)
                <i class="fa-regular fa-star"></i>
            @endfor
        </div>

        <p class="avaliacao-texto">{{ $texto }}</p>

        <div class="avaliacao-botoes">
            <a href="{{ route($rotaEditar) }}" class="btn btn-primary btn-pequeno">Editar</a>
        </div>
    </div>
</div>
