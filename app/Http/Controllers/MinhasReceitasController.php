<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Receita;
use App\Models\Categoria;

class MinhasReceitasController extends Controller
{
    public function minhasReceitas()
    {
        return $this->index();
    }

    // Exibe a lista de receitas do usuário logado, organizadas por categoria
    public function index()
    {
        // Busca apenas as receitas do usuário autenticado, já trazendo a categoria junto
        $receitas = Receita::with('categoria')->where('users_id', Auth::id())->get();

        // Busca apenas as categorias do usuário autenticado, usadas para montar as abas na view
        $categorias = Categoria::where('user_id', Auth::id())->orderBy('nome')->get();

        // Retorna a view de listagem, com filtro vazio
        return view('receitas.lista', [
            'receitas' => $receitas,
            'categorias' => $categorias,
            'filtro' => '',
        ]);
    }

    // Exibe o formulario de cadastro de uma nova receita
    public function create()
    {
        // Categorias disponiveis para o select do formulario (só as do usuário logado)
        $categorias = Categoria::where('user_id', Auth::id())->orderBy('nome')->get();
        return view('receitas.criar', ['categorias' => $categorias]);
    }

    // Recebe os dados do formulario e salva no banco
    public function store(Request $request)
    {
        try {
            $receita = new Receita();

            // Preenche os dados a partir do que foi enviado pelo formulário
            $receita->titulo = $request->input('titulo');
            $receita->categoria_id = $request->input('categoria_id');
            $receita->ingredientes = $request->input('ingredientes');
            $receita->modo_preparo = $request->input('modo_preparo');
            $receita->favorito = $request->input('favorito', false);

            // Vincula a receita ao user logado
            $receita->users_id = Auth::id();

            // Se veio uma imagem, salva storage o caminho e no banco
            if ($request->hasFile('imagem')) {
                $path = $request->file('imagem')->store('receitas', 'public');
                $receita->imagem = $path;
            }

            $receita->save();

            session()->flash('msg', 'Receita cadastrada com sucesso!');
            return redirect()->route('receitas.index');
        } catch (\Exception $e) {
            // Em caso de erro, guarda a mensagem na session e devolve para o form
            session()->flash('erro', 'Erro ao cadastrar: ' . $e->getMessage());
            return redirect()->route('receitas.create');
        }
    }

    // Exibe os dados da receita para ver ou editar
    public function view($id)
    {
        try {
            // Busca a receita pelo id, garantindo que pertence ao usuário logado
            $receita = Receita::with('categoria')
                ->where('id', $id)
                ->where('users_id', Auth::id())
                ->firstOrFail();

            // Categorias disponiveis para o select do formulario de edição (só as do usuário)
            $categorias = Categoria::where('user_id', Auth::id())->orderBy('nome')->get();

            return view('receitas.visualizar', [
                'receita' => $receita,
                'categorias' => $categorias,
            ]);
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao carregar: ' . $e->getMessage());
            return redirect()->route('receitas.index');
        }
    }

    // Atualiza os dados de uma receita existente
    public function update(Request $request, $id)
    {
        try {
            // acha a receita que sera atualizada, garantindo que é do usuário logado
            $receita = Receita::where('id', $id)
                ->where('users_id', Auth::id())
                ->firstOrFail();

            // atualiza os campos com os dados do form
            $receita->titulo = $request->input('titulo');
            $receita->categoria_id = $request->input('categoria_id');
            $receita->ingredientes = $request->input('ingredientes');
            $receita->modo_preparo = $request->input('modo_preparo');

            // mantem o valor atual de favorito (false). Deixei apenas no movel para favoritar
            $receita->favorito = $request->input('favorito', $receita->favorito);

            // se veio uma nova imagem, substitui a atual
            if ($request->hasFile('imagem')) {
                $path = $request->file('imagem')->store('receitas', 'public');
                $receita->imagem = $path;
            }

            // salva as mudanças no banco
            $receita->save();

            session()->flash('msg', 'Receita atualizada com sucesso!');
            return redirect()->route('receitas.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            // em caso de erro, volta para a tela de edição da mesma receita
            return redirect()->route('receitas.view', ['id' => $id]);
        }
    }

    // Remove uma receita do bd
    public function destroy($id)
    {
        try {
            // Busca e exclui a receita, garantindo que pertence ao usuário logado
            $receita = Receita::where('id', $id)
                ->where('users_id', Auth::id())
                ->firstOrFail();

            $receita->delete();

            session()->flash('msg', 'Receita excluída com sucesso!');
            return redirect()->route('receitas.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
            return redirect()->route('receitas.index');
        }
    }

    // Busca as receitas do user logado pelo título
    public function search(Request $request)
    {
        // remove espaços em branco na busca
        // Se não vier nenhum filtro assume string vazia
        $filtro = trim((string) $request->input('filtro', ''));

        $receitas = Receita::with('categoria')
                       ->where('users_id', Auth::id())
                       ->where('titulo', 'like', "%{$filtro}%")
                       ->orderBy('id')
                       ->get();

        $categorias = Categoria::where('user_id', Auth::id())->orderBy('nome')->get();

        // Retorna a mesma view de listagem, agora com os resultados filtrados
        return view('receitas.lista', [
            'receitas' => $receitas,
            'categorias' => $categorias,
            'filtro' => $filtro,
        ]);
    }
}