<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([ // Cria o usuário admin com id = 1
            'name' => 'admin',
            'email' => 'matheus@gmail.com',
            'password' => Hash::make('01052009'), //nao pd salvar a senha direto, como os outros dados, ai usa o hash
        ]);

    }
}