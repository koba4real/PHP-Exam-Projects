<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transazione>
 */
class TransazioneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipo = $this->faker->randomElement(['Spesa', 'Entrata']);
        if($tipo === 'Spesa') {
            $importo = $this->faker->randomFloat(2, -1000, 0);
            $descrizione = $this->faker->randomElement([
                'Spesa market', 'Bolletta gas', 'Bolletta luce', 'Stipendio',
                'Carburante', 'Ristorante', 'Bonus', 'Affitto', 'Spesa farmacia'
            ]);
        } else {
            $descrizione = $this->faker->randomElement([
                'Stipendio', 'Bonus', 'Rimborso', 'Vendita usato', 'Regalo'
            ]);
            if($descrizione === 'Stipendio') {
                $importo = $this->faker->randomFloat(2, 1000, 2000);
            } else {
                $importo = $this->faker->randomFloat(2, 0, 1000);
            }
        }

        return [
            'importo' => $importo,
            'descrizione' => $descrizione,
            'data' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'tipo' => $tipo
        ];
    }
}
