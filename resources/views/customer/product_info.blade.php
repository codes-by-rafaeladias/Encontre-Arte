@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/product_info.css'])
@endpush

@section('title', $product->name)

@section('content')

<div class="product-page">

    <div class="product-card">

        <div class="product-image-box">
            <img src="{{ asset('storage/' . $product->image_url) }}" 
                 alt="{{ $product->name }}" 
                 class="product-image">
        </div>

        <div class="product-info">

            <h1 class="product-title">{{ $product->name }}</h1>

            <p class="product-price">
                R$ {{ number_format($product->price, 2, ',', '.') }}
            </p>

            <p class="product-description">{{ $product->description }}</p>

            <p class="seller-label">Vendido por</p>
            <a href="{{ route('artesao.perfil', $product->artisan_id) }}" class="seller-name">
                {{ $product->artisan->business_name ?? $product->artisan->name }}
            </a>

            @php
                $average = $product->average_rating ?? 0;
                $full = floor($average);
                $half = ($average - $full) >= 0.5;
                $empty = 5 - $full - ($half ? 1 : 0);
            @endphp

            <div class="rating-box">
                @for($i = 0; $i < $full; $i++)
                    <i class="fa-solid fa-star rating-star"></i>
                @endfor

                @if($half)
                    <i class="fa-regular fa-star-half-stroke rating-star"></i>
                @endif

                @for($i = 0; $i < $empty; $i++)
                    <i class="fa-regular fa-star rating-star"></i>
                @endfor

                <span class="rating-number">({{ number_format($average, 1, ',', '.') }})</span>
            </div>

            <div class="product-buttons">

                <form action="{{ route('produto.favoritar', $product->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-secondary btn-medio">
                        {{ $isFavorited ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos' }}
                    </button>
                </form>

                <button type="button" class="btn btn-primary btn-medio" id="openReviewPopup">
                    {{ $userReview ? 'Editar Avaliação' : 'Avaliar Produto' }}
                </button>

            </div>
            <form id="reviewRealForm" method="POST" action="{{ $userReview ? route('avaliacao.atualizar', $userReview->id) : route('avaliacao.cadastrar', $product->id) }}">
    @csrf
    @if($userReview)
        @method('PUT')
    @endif

    <input type="hidden" name="rating" id="ratingField">
    <input type="hidden" name="comment" id="commentField">
</form>

        </div>

    </div>

</div>

@endsection
@push('scripts')
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function(){

    const button = document.getElementById("openReviewPopup");

    button.addEventListener("click", function() {

        const previousRating = {{ $userReview->rating ?? 0 }};
        const previousComment = @json($userReview->comment ?? '');

        Swal.fire({
            title: "{{ $userReview ? 'Editar Avaliação' : 'Avaliar Produto' }}",
            html: `
                <div class="popup-rating-box" style="margin-bottom: 10px;">
                    ${renderStars(previousRating)}
                </div>

                <div style="display:flex; justify-content:center; width:100%;">
                    <textarea id="popupComment" class="swal2-textarea textarea-centered" 
                    placeholder="Escreva seu comentário...">${previousComment}</textarea>
                </div>
            `,
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: '{{ $userReview ? "Salvar" : "Enviar" }}',
            cancelButtonText: 'Cancelar',
            background: "#FFFFFF",
            width: "480px",
            customClass: {
                confirmButton: 'swal-confirm-delete',
                cancelButton: 'swal-cancel',
                htmlContainer: 'swal-html',
                title: 'swal-title',
            },

            didOpen: () => {
                setupStarClickEvents();
            },
            
            preConfirm: () => {
                const rating = document.getElementById("ratingField").value;
                
                if (!rating || rating < 1 || rating > 5) {
                    Swal.showValidationMessage("Você precisa selecionar uma quantidade de estrelas.");
                    return false;
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                submitReviewForm();
            }
        });

    });

    function renderStars(active) {
        let html = "";
        for (let i = 1; i <= 5; i++) {
            html += `
                <i class="fa-star ${i <= active ? 'fa-solid star-active' : 'fa-regular'} star-popup" 
                   data-value="${i}" 
                   style="font-size: 28px; cursor:pointer; margin: 0 4px; color:#FFD43B;"></i>`;
        }
        return html;
    }

    function setupStarClickEvents() {
        const stars = document.querySelectorAll(".star-popup");
        stars.forEach(star => {
            star.addEventListener("click", function(){
                const value = this.dataset.value;

                stars.forEach(s => {
                    s.classList.remove("fa-solid");
                    s.classList.add("fa-regular");
                });

                for (let i = 0; i < value; i++) {
                    stars[i].classList.remove("fa-regular");
                    stars[i].classList.add("fa-solid");
                }

                document.getElementById("ratingField").value = value;
            });
        });
    }

    function submitReviewForm() {
        const comment = document.getElementById("popupComment").value;
        document.getElementById("commentField").value = comment;

        document.getElementById("reviewRealForm").submit();
    }

});
</script>
@endpush