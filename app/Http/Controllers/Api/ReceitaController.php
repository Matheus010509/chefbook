<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Receita;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    // GET /api/receitas - lista as receitas do usuário autenticado,
    // com filtro opcional por categoria: /api/receitas?categoria_id=2
    public function index(Request $request)
    {
        $request->validate([
            'categoria_id' => 'nullable|integer',
        ]);

        $query = Receita::doUsuario($request->user()->id);

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        return $query->with('categoria')->get();
    }

    // GET /api/receitas/{receita} - detalhe de uma receita do usuário autenticado
    // Se a receita não existir OU for de outro usuário, retorna 404
    // (não revela que o id existe para quem não é o dono).
    public function show(Request $request, $receita)
    {
        $receita = Receita::doUsuario($request->user()->id)
            ->with('categoria')
            ->findOrFail($receita);

        return $receita;
    }

    // GET /api/receitas-por-categoria - tudo agrupado, pro Flutter salvar no SharedPreferences
    public function porCategoria(Request $request)
    {
        $userId = $request->user()->id;

        $categorias = Categoria::where('user_id', $userId)
            ->with(['receitas' => function ($query) use ($userId) {
                $query->where('users_id', $userId);
            }])
            ->get();

        return response()->json($categorias);
    }
}