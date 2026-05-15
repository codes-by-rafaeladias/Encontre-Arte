<?php

namespace App\Services;

use App\Models\User;
use App\Models\AIInsight;
use Illuminate\Support\Facades\Http;

class AIInsightService
{
    public function generateSuggestions(User $artisan)
    {

        $products = $artisan->products()
            ->with([
                'category',
                'technique',
                'materials',
                'reviews'
            ])
            ->get();
        
        $products->each(function ($product) {

            $product->setRelation(
                'reviews',
                $product->reviews->take(20)
            );
        });
        
        /* CSV COM DADOS DO ARTESÃOS */
        
        $artisanCsv = "nome,nome_comercial,seguidores,quantidade_produtos,biografia\n";

        $artisanCsv .=
        
        '"' . $artisan->name . '",' .

        '"' . ($artisan->business_name ?? '') . '",' .

        $artisan->followers()->count() . ',' .

        $products->count() . ',' .

        '"' . str_replace('"', '', $artisan->bio ?? '') . '"';

        /* CSV COM DADOS DOS PRODUTOS DO ARTESÃO */

        $productsCsv =
            "nome,descricao,categoria,tecnica,material,favoritos,avaliacoes\n";

        foreach ($products as $product) {

            $productsCsv .=

                '"' . $product->name . '",' .

                '"' . str_replace('"', '', $product->description) . '",' .

                '"' . ($product->category->name ?? '') . '",' .

                '"' . ($product->technique->name ?? '') . '",' .

                '"' . ($product->materials ->pluck('name')->implode(', ')) . '",' .

                $product->favoritedBy()->count() . ',' .

                $product->reviews->count()

                . "\n";
        }

        /* CSV DE AVALIAÇÕES DOS PRODUTOS */

        $reviewsCsv =
            "produto,nota,comentario\n";

        foreach ($products as $product) {

            foreach ($product->reviews as $review) {

                $reviewsCsv .=

                    '"' . $product->name . '",' .

                    $review->rating . ',' .

                    '"' . str_replace('"', '', $review->comment) . '"'

                    . "\n";
            }
        }

        /* PROMP */ 
        $prompt = "
        Você é um assistente inteligente para artesãos em um contexto de Economia Criativa.
        Considere os dados e os arquivos CSV abaixo.

        CSV DO ARTESÃO:
        {$artisanCsv}
 
        CSV DE PRODUTOS
        {$productsCsv}
        
        CSV DE AVALIAÇÕES
        {$reviewsCsv}
        
        Com base nessas informações, realize uma análise geral do desempenho do artesão na plataforma digital e gere: 

        1. Pontos positivos observados;
        2. Pontos negativos observados;
        3. Sugestões de melhoria;
        4. Tendências identificadas.
        
        A estrutura do texto deve seguir a ordem acima de tópicos.
        Utilize uma linguagem coloquial, motivacional e acolhedora, evitando excesso de termos técnicos.
        As sugestões devem ser objetivas, simples e voltadas ao crescimento do artesão dentro da plataforma.
        Evite repetir informações e priorize observações realmente relevantes.
        Evite inventar informações que não estejam presentes nos dados enviados.
        A resposta deve possuir no máximo 250 palavras.
        ";

        /* REQUISIÇÃO À API DO GROQ */

        $response = Http::withoutVerifying()

            ->withHeaders([

                'Authorization' =>
                    'Bearer ' . env('GROQ_API_KEY'),

                'Content-Type' => 'application/json',

            ])

            ->post(

                'https://api.groq.com/openai/v1/chat/completions',

                [

                    'model' => 'llama-3.3-70b-versatile',

                    'messages' => [
                        [
                            'role' => 'user',

                            'content' => $prompt
                        ]
                    ],

                    'temperature' => 0.7,
                    'max_tokens' => 500,
                ]
            );

        /* RESPOSTA */

        $content = data_get($response->json(), 'choices.0.message.content');
        
        AIInsight::create(['user_id' => $artisan->id, 'content' => $content]);
        
        return $content;
    }
}