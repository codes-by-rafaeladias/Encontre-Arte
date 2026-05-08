@props(['produtos', 'seguidores', 'media_avaliacao'])
@vite('resources/css/components/reviews_kpis.css')

<div class="reviews-kpis">

    <div class="kpi-card">
        <i class="fa-solid fa-paintbrush"></i>

        <div>
            <h3>
                {{ $produtos }}
            </h3>

            <p>Produtos cadastrados</p>
        </div>
    </div>

    <div class="kpi-card">
        <i class="fa-solid fa-users"></i>

        <div>
            <h3>{{ $seguidores }}</h3>

            <p>Seguidores</p>
        </div>
    </div>

    <div class="kpi-card">
        <i class="fa-solid fa-star"></i>

        <div>
            <h3>
                {{ $media_avaliacao ? number_format($media_avaliacao, 1) : '—' }}
            </h3>

            <p>Média das avaliações</p>
        </div>
    </div>

</div>