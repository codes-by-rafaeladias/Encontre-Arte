@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/product_info.css'])
@endpush

@section('title', $product->name)

@section('content')

<div class="product-page">

    <div class="product-card">

        <div class="product-row">

        <div class="product-image-box">
            <img src="{{ asset('storage/' . $product->image_url) }}" 
                 alt="{{ $product->name }}" 
                 class="product-image">
        </div>
            
         <div class="product-info flex">

            <div class="product-header">

            <h1 class="product-title">{{ $product->name }}</h1>

            <div class="favorite-icon">
            <form action="{{ route('customer.favorites.create', $product->slug) }}" method="POST">
                @csrf
                <button type="submit" class="btn-favorite">
                    <i class="{{ $isFavorited ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                </button>
            </form>
            </div>
            </div>

            <p class="product-price">
                R$ {{ number_format($product->price, 2, ',', '.') }}
            </p>

            <span class="status-badge {{ $product->status }}">
                {{ strtoupper(str_replace('_', ' ', $product->status)) }}
            </span>

            @php
                $average = $product->averageRating();
                $full = floor($average);
                $half = ($average - $full) >= 0.5;
                $empty = 5 - $full - ($half ? 1 : 0);
            @endphp

            <div class="rating-box">
                @for($i = 0; $i < $full; $i++)
                    <i class="fa-solid fa-star rating-star"></i>
                @endfor

                @if($half)
                    <i class="fa-solid fa-star-half-stroke rating-star"></i>
                @endif

                @for($i = 0; $i < $empty; $i++)
                    <i class="fa-regular fa-star rating-star"></i>
                @endfor

                <span class="rating-number">({{ number_format($average, 1, ',', '.') }})</span>

                <a href="{{ route('customer.product.reviews', $product->slug) }}">Ver avaliações</a>
            </div>

            <div class="product-buttons">
                @if($product->artisan->whatsapp || $product->artisan->instagram)
                <div class="contact-dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle">
                        Contatar artesão
                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <div class="dropdown-menu-contact">
                    @if($product->artisan->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $product->artisan->whatsapp) }}" target="_blank">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>
                    @endif

                    @if($product->artisan->instagram)
                    <a href="https://instagram.com/{{ $product->artisan->instagram }}" target="_blank">
                        <i class="fa-brands fa-instagram"></i> Instagram
                    </a>
                    @endif
                </div>
                </div>
                @else
                <button class="btn btn-primary btn-disabled" disabled>
                    Contato indisponível
                </button>
                @endif
                <button type="button" class="btn btn-secondary" id="openReviewPopup">
                    {{ $userReview ? 'Editar Avaliação' : 'Avaliar Produto' }}
                 </button>
            </div>
            </div>
            </div>
            <div class="product-info">
            <hr class="profile-divider">
            @if($product->description)
            <p class="product-description">{{ $product->description }}</p>
            @endif
            <p class="product-technique"><strong>Técnica:</strong> {{ $product->technique->name }}</p>
            @if($product->materials->isNotEmpty())
            <p class="product-technique"><strong>Materiais:</strong> {{ $product->materials->pluck('name')->join(', ') }}</p>
            @endif
            <p class="seller-label">Vendido por
            <a href="{{ route('customer.artisan.profile', $product->artisan->slug) }}" class="seller-name">
                {{ $product->artisan->business_name ?? $product->artisan->name }}
            </a>
            </p>
            </div>
            <form id="reviewRealForm" method="POST" action="{{ $userReview ? route('customer.review.update', $userReview->id) : route('customer.review.create', $product->id) }}">
    @csrf
    @if($userReview)
        @method('PUT')
    @endif

    <input type="hidden" name="rating" id="ratingField">
    <input type="hidden" name="comment" id="commentField">
</form>

    </div>

</div>

@endsection
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

    const dropdown = document.querySelector(".contact-dropdown");
    const toggle = document.querySelector(".dropdown-toggle");

    if (dropdown && toggle) {
        toggle.addEventListener("click", function() {
        dropdown.classList.toggle("active");
    });

        document.addEventListener("click", function(e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove("active");
            }
        });
    } 
});
</script>
@endpush