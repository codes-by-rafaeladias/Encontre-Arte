@props(['produto','nota', 'texto', 'imagem', 'reviewId'])
@vite(['resources/css/components/card_rating_client.css', 'resources/css/customer/reviews.css'])

<div class="avaliacao-card cliente">
    <div class="avaliacao-imagem">
        <img src="{{ asset('storage/' . $imagem) }}" alt="{{ $produto }}">
    </div>

    <div class="avaliacao-conteudo">
        <h3 class="avaliacao-produto">{{ $produto }}</h3>

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
            <button type="button" class="btn btn-primary btn-pequeno openReviewPopup">
                Editar
            </button>
            <form action="{{ route('avaliacao.excluir', $reviewId) }}" 
            method="POST" 
            style="display:inline">
            @csrf
            @method('DELETE')
            <button type="button" class="btn-delete btn btn-secondary btn-pequeno">
            Excluir
            </button>
      </form>
        </div>
        <form id="reviewRealForm" method="POST" action="{{ route('avaliacao.atualizar', $reviewId) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="rating" id="ratingField">
            <input type="hidden" name="comment" id="commentField">
        </form>
    </div>
</div>
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {

    const deleteButtons = document.querySelectorAll(".btn-delete");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {

            const form = this.closest("form");;

            showDeleteConfirm(
                `<p>Você tem certeza que deseja excluir esta avaliação? A ação não poderá ser revertida!</p>`,
                () => form.submit()
            );

        });
    });

    const buttons = document.querySelectorAll(".openReviewPopup");

buttons.forEach(button => {
    button.addEventListener("click", function() {

        const previousRating = {{ $nota }};
        let previousComment = @json($texto);
        if (previousComment === null) {
            previousComment = "";
        }

        Swal.fire({
            title: 'Editar Avaliação',
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
            confirmButtonText: 'Salvar',
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