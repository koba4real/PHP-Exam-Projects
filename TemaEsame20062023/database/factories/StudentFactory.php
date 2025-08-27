<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{

    protected $model = \App\Models\Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $votipossibili=array_merge([-1],range(18,30),['33']);
        return [
            'data_esame' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'matricola' => $this->faker->unique()->randomNumber(5,true),
            'cognome' => $this->faker->lastName(),
            'nome' => $this->faker->firstName(),
            'voto' => $this->faker->randomElement($votipossibili),
        ];
    }
}
