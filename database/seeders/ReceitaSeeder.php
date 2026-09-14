<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Receita;
use App\Models\Categoria; // IMPORTANTE: importar o model Categoria

class ReceitaSeeder extends Seeder
{
    public function run(): void
    {
        // Busca a categoria "Sobremesa"; se não existir, cria na hora, para evitar erro
        $categoria = Categoria::firstOrCreate(['nome' => 'Sobremesa']);

        Receita::create([ // Cria uma receita de exemplo
            'titulo' => 'Bolo de Chocolate',
            'ingredientes' => 'farinha, ovos, acucar, leite, fermento',
            'modo_preparo' => 'Misture os ingredientes e leve ao forno por 30 minutos',
            'imagem' => 'bolo.jpg',
            'favorito' => false,
            'categoria_id' => $categoria->id,
            'users_id' => 1,
        ]);
    }
}