@vite(['resources/css/app.css','resources/css/components/card_button.css'])
@props(['icone', 'titulo', 'rota'])

<a href="{{ route($rota) }}" class="card-botao">
    <i class="{{ $icone }} card-botao__icon"></i>
    <span class="card-botao__text">{{ $titulo }}</span>
</a>
