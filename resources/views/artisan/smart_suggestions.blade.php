@extends('layouts.app')
@php
    use Illuminate\Support\Str;
@endphp

@push('styles')
    @vite('resources/css/artisan/smart_suggestions.css')
@endpush

@section('title', 'Sugestões Inteligentes')

@section('content')

<div class="page-header">

    <h2 class="title">
        Sugestões Inteligentes para o seu negócio
    </h2>

    <p class="subtitle">
        Recomendações automáticas para ajudar
        no crescimento da sua loja artesanal.
    </p>

</div>

<div class="ai-notice">

    <h3>
        Sobre as Sugestões Inteligentes
    </h3>

    <p>
        As análises desta página são geradas
        automaticamente por Inteligência Artificial.
    </p>

    <p>
        Os dados utilizados incluem:
    </p>

    <ul>

        <li>Nome e nome comercial;</li>

        <li>Descrição/história do artesão;</li>

        <li>Produtos cadastrados;</li>

        <li>Categorias, técnicas e materiais;</li>

        <li>Favoritos recebidos;</li>

        <li>Avaliações, notas e comentários.</li>

    </ul>

    <p>
        Os dados são utilizados apenas internamente para geração de recomendações ao próprio artesão. Nenhuma informação será compartilhada.
    </p>

</div>

<div class="insights-container">

    @if (!auth()->user()->ai_consent) 
    <div class="empty-state">
        <h3>Sugestões desativadas</h3>

        <p>Você desativou o uso de Inteligência Artificial. Por isso, não podemos gerar sugestões personalizadas para o seu negócio.</p>
        
    </div>

    @else

    @forelse ($insights as $insight)

        <div class="insight-card">

            <div class="insight-header">

                <span class="insight-date">

                   Última análise feita em {{ $insight->created_at->format('d/m/Y') }}.
                   As análises são atualizadas mensalmente.

                </span>

            </div>

            <div class="insight-content">

                {!! Str::markdown($insight->content) !!}

            </div>

        </div>

    @empty

    <div class="empty-state">

        <h3>Nenhuma sugestão encontrada</h3>

        <p>
            As sugestões inteligentes
            serão geradas automaticamente
            conforme sua atividade na plataforma.
        </p>

        </div>

    @endif
    @endforelse

</div>

@endsection