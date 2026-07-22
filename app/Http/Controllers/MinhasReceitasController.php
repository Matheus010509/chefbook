<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Receita;

class MinhasReceitasController extends Controller
{
    public function minhasReceitas()
    {
        return $this->index();
    }

    public function index()
    {
        $receitas = Receita::where('users_id', Auth::id())->get();
        return view('receitas.lista', ['receitas' => $receitas, 'filtro' => '']);
    }

    public function create()
    {
        return view('receitas.criar');
    }

    public function store(Request $request)
    {
        try {
            $receita = new Receita();
            $receita->titulo = $request->input('titulo');
            $receita->categorias = $request->input('categorias');
            $receita->ingredientes = $request->input('ingredientes');
            $receita->modo_preparo = $request->input('modo_preparo');
            $receita->favorito = $request->input('favorito', false);
            $receita->users_id = Auth::id();

            if ($request->hasFile('imagem')) {
                $path = $request->file('imagem')->store('receitas', 'public');
                $receita->imagem = $path;
            }

            $receita->save();

            session()->flash('msg', 'Receita cadastrada com sucesso!');
            return redirect()->route('receitas.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao cadastrar: ' . $e->getMessage());
            return redirect()->route('receitas.create');
        }
    }

    public function view($id)
    {
        try {
            $receita = Receita::find($id);
            return view('receitas.visualizar', ['receita' => $receita]);
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao carregar: ' . $e->getMessage());
            return redirect()->route('receitas.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $receita = Receita::find($id);
            $receita->titulo = $request->input('titulo');
            $receita->categorias = $request->input('categorias');
            $receita->ingredientes = $request->input('ingredientes');
            $receita->modo_preparo = $request->input('modo_preparo');
            $receita->favorito = $request->input('favorito', $receita->favorito);

            if ($request->hasFile('imagem')) {
                $path = $request->file('imagem')->store('receitas', 'public');
                $receita->imagem = $path;
            }

            $receita->save();

            session()->flash('msg', 'Receita atualizada com sucesso!');
            return redirect()->route('receitas.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            return redirect()->route('receitas.view', ['id' => $id]);
        }
    }

    public function destroy($id)
    {
        try {
            $receita = Receita::find($id);
            $receita->delete();
            session()->flash('msg', 'Receita excluída com sucesso!');
            return redirect()->route('receitas.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
            return redirect()->route('receitas.index');
        }
    }

    public function search(Request $request)
    {
        $filtro = trim((string) $request->input('filtro', ''));
        $receitas = Receita::where('users_id', Auth::id())
                       ->where('titulo', 'like', "%{$filtro}%")
                       ->orderBy('id')
                       ->get();
        return view('receitas.lista', ['receitas' => $receitas, 'filtro' => $filtro]);
    }
}