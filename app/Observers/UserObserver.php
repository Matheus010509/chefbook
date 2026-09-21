<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Categoria;

class UserObserver
{
    /**
     * Executa logo depois que um novo usuário é criado.
     * Cria automaticamente as categorias padrão pra esse usuario.
     * Crie o observer para meio que povoar para todos os novos usuários as categorias padrao.
     */
    public function created(User $user): void
    {
        $categoriasPadrao = ['Almoço', 'Sobremesa', 'Lanche', 'Janta'];

        foreach ($categoriasPadrao as $nome) {
            Categoria::create([
                'nome' => $nome,
                'user_id' => $user->id,
            ]);
        }
    }
}