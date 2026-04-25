<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Receita; // IMPORTANTE

class ReceitaSeeder extends Seeder
{
    public function run(): void
    {
        Receita::create([
            'titulo' => 'Bolo de Chocolate',
            'ingredientes' => 'farinha, ovos, acucar, leite, fermento',
            'modo_preparo' => 'Misture os ingredientes e leve ao forno por 30 minutos',
            'imagem' => 'bolo.jpg',
            'favorito' => false,
            'categorias' => 'sobremesa',
            'users_id' => 1,
        ]);
    }
}