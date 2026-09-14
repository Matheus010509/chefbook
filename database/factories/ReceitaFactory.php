<?php

namespace Database\Factories;

use App\Models\Receita;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Receita>
 */
class ReceitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(3),
            'ingredientes' => fake()->paragraph(),
            'modo_preparo' => fake()->paragraph(),
            'imagem' => 'default.jpg',
            'favorito' => fake()->boolean(),
            'categoria_id' => Categoria::inRandomOrder()->first()->id,
            'users_id' => 1,
        ];
    }
}