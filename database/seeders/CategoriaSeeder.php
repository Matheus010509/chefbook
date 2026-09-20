<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // pega o primeiro usuário já criado pelo UserSeeder

        $categorias = ['almoco', 'janta', 'lanche', 'sobremesa']; //deixando as categorias pre prontas ja

        foreach ($categorias as $nome) { //distrinchando o array de categorias e salvando no banco
            Categoria::firstOrCreate(
                ['nome' => $nome, 'user_id' => $user->id],
            );
        }
    }
}