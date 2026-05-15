<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AIInsightService;
use App\Models\User;
use App\Models\AIInsight;

class GenerateAIInsights extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-ai-insights';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description =
        'Gera sugestões inteligentes para artesãos';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $service = new AIInsightService();

        $artisans = User::where('type', 'artisan')
        ->where('ai_consent', true)
        ->get();

        foreach ($artisans as $artisan) {

            $alreadyGenerated = AIInsight::where(
                'user_id',
                $artisan->id
            )
            ->whereDate(
                'created_at',
                now()
            )
            ->exists();

            if ($alreadyGenerated) {

                $this->info(
                    "Insight já gerado hoje para {$artisan->id}"
                );

                continue;
            }

            $hasEnoughData = $artisan->products()

                ->get()

                ->contains(function ($product) {

                    return

                        $product->favoritedBy()
                            ->count() >= 10

                        &&

                        $product->reviews()
                            ->count() >= 10;
                });

            if (!$hasEnoughData) {

                $this->info(
                    "Dados insuficientes para {$artisan->id}"
                );

                continue;
            }

            $service->generateSuggestions(
                $artisan
            );

            $this->info(
                "Insight gerado para {$artisan->id}"
            );
        }

        $this->info(
            'Processamento finalizado.'
        );
    }
}