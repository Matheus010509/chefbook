<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Receita;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    // GET /api/receitas - lista tudo, com opção de filtrar por categoria, dependendo de qual funcao escolho
    public function index(Request $request)
    {
        $query = Receita::query();

        // permite filtrar, exemplo, /api/receitas?categoria_id=2
        if ($request->has('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        return $query->with('categoria')->get();
    }

    // GET /api/receitas/{id} - detalhe de uma receita
    public function show(Receita $receita)
    {
        return $receita->load('categoria');
    }

    // GET /api/receitas-por-categoria - tudo agrupado, pro Flutter salvar no SharedPreferences
   public function porCategoria(Request $request)
{
    $categorias = Categoria::where('user_id', $request->user()->id)
        ->with(['receitas' => function ($query) use ($request) {
            $query->where('users_id', $request->user()->id);
        }])
        ->get();

    return response()->json($categorias);
}
}