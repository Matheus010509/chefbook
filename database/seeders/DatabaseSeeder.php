<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Receita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {
     $this->call(UserSeeder::class);
    User::factory(2)->create();  //criar 2 usuarios de teste usando a factory

        $this->call(ReceitaSeeder::class);
   Receita::factory(2)->create();  //criar 2 receitas de teste usando a factory. OBRIGATORIO ter o factory criado para a receita
   //E tambem é necessario ter um model 
    }
}
