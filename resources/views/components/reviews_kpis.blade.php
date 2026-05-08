@props(['media', 'quantidade', 'melhor_produto'])
@vite('resources/css/components/reviews_kpis.css')

<div class="reviews-kpis">

    <div class="kpi-card">
        <i class="fa-solid fa-star"></i>

        <div>
            <h3>
                {{ $media ? number_format($media, 1) : '—' }}
            </h3>

            <p>Média das avaliações</p>
        </div>
    </div>

    <div class="kpi-card">
        <i class="fa-solid fa-comments"></i>

        <div>
            <h3>{{ $quantidade }}</h3>

            <p>Avaliações recebidas</p>
        </div>
    </div>

    <div class="kpi-card">
        <i class="fa-solid fa-trophy"></i>

        <div>
            <h3>
                {{ $melhor_produto?->name ?? '—' }}
            </h3>

            <p>Produto melhor avaliado</p>
        </div>
    </div>

</div>