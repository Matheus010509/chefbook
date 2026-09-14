<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function create()
    {
        return view('categorias.criar');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255|unique:categorias,nome',
            ]);

            Categoria::create([
                'nome' => $request->input('nome'),
            ]);

            session()->flash('msg', 'Categoria cadastrada com sucesso!');
            return redirect()->route('receitas.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao cadastrar: ' . $e->getMessage());
            return redirect()->route('categorias.create');
        }
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);

        return view('categorias.visualizar', [
            'categoria' => $categoria,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $categoria = Categoria::find($id);

            $request->validate([
                'nome' => 'required|string|max:255|unique:categorias,nome,' . $categoria->id,
            ]);

            $categoria->nome = $request->input('nome');
            $categoria->save();

            session()->flash('msg', 'Categoria atualizada com sucesso!');
            return redirect()->route('receitas.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            return redirect()->route('receitas.index');
        }
    }

    public function destroy($id)
{
    try {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            session()->flash('erro', 'Categoria não encontrada.');
            return redirect()->route('receitas.index');
        }

        if ($categoria->receitas()->exists()) {
            session()->flash('erro', 'Não é possível excluir uma categoria que possui receitas cadastradas.');
            return redirect()->route('receitas.index');
        }

        $categoria->delete();

        session()->flash('msg', 'Categoria excluída com sucesso!');
        return redirect()->route('receitas.index');
    } catch (\Exception $e) {
        session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
        return redirect()->route('receitas.index');
    }
}
}