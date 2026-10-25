<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Receita;
use App\Models\Categoria;
use App\Services\ImageService;

class MinhasReceitasController extends Controller
{
    // Regras de validação compartilhadas entre store e update (espelham a migration de receitas)
    private function regras(): array
    {
        return [
            'titulo'       => 'required|string|max:255',
            'ingredientes' => 'required|string',
            'modo_preparo' => 'required|string',
            // categoria_id é nullable no banco, mas se vier precisa ser uma categoria DO USUÁRIO logado
                'categoria_id' => [
                'required',
                'integer',
                Rule::exists('categorias', 'id')->where(
                    fn ($query) => $query->where('user_id', Auth::id())
                ),
],
            'favorito'     => 'nullable|boolean',
            'imagem'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ];
    }

    public function minhasReceitas()
    {
        return $this->index();
    }

    // Exibe a lista de receitas do usuário logado, organizadas por categoria
    public function index()
    {
        $receitas = Receita::with('categoria')->where('users_id', Auth::id())->get();

        $categorias = Categoria::where('user_id', Auth::id())->orderBy('nome')->get();

        return view('receitas.lista', [
            'receitas' => $receitas,
            'categorias' => $categorias,
            'filtro' => '',
        ]);
    }

    // Exibe o formulario de cadastro de uma nova receita
    public function create()
    {
        $categorias = Categoria::where('user_id', Auth::id())->orderBy('nome')->get();
        return view('receitas.criar', ['categorias' => $categorias]);
    }

    // Recebe os dados do formulario e salva no banco
    public function store(Request $request, ImageService $images)
    {
        // Fora do try: se falhar, o Laravel volta ao form com $errors e old()
        $dados = $request->validate($this->regras());

        try {
            $receita = new Receita();

            $receita->titulo = $dados['titulo'];
            $receita->categoria_id = $dados['categoria_id'];
            $receita->ingredientes = $dados['ingredientes'];
            $receita->modo_preparo = $dados['modo_preparo'];
            $receita->favorito = $request->boolean('favorito');

            // Vincula a receita ao user logado
            $receita->users_id = Auth::id();

            // Se veio uma imagem, envia para o Cloudinary e guarda a URL e o public_id
            if ($request->hasFile('imagem')) {
                $img = $images->upload($request->file('imagem'));
                $receita->imagem = $img['url'];
                $receita->imagem_public_id = $img['public_id'];
            }

            $receita->save();

            session()->flash('msg', 'Receita cadastrada com sucesso!');
            return redirect()->route('receitas.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao cadastrar: ' . $e->getMessage());
            return redirect()->route('receitas.create')->withInput();
        }
    }

    // Exibe os dados da receita para ver ou editar
    public function view($id)
    {
        try {
            $receita = Receita::with('categoria')
                ->where('id', $id)
                ->where('users_id', Auth::id())
                ->firstOrFail();

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
    public function update(Request $request, $id, ImageService $images)
    {
        // Fora do try, pelo mesmo motivo do store
        $dados = $request->validate($this->regras());

        try {
            // garante que a receita é do usuário logado
            $receita = Receita::where('id', $id)
                ->where('users_id', Auth::id())
                ->firstOrFail();

            $receita->titulo = $dados['titulo'];
            $receita->categoria_id = $dados['categoria_id'];
            $receita->ingredientes = $dados['ingredientes'];
            $receita->modo_preparo = $dados['modo_preparo'];

            // favorito é controlado pelo móvel: só altera se o form enviar o campo
            if ($request->has('favorito')) {
                $receita->favorito = $request->boolean('favorito');
            }

            // nova imagem: sobe a nova primeiro, e só apaga a antiga depois de salvar
            $publicIdAntigo = null;
            if ($request->hasFile('imagem')) {
                $publicIdAntigo = $receita->imagem_public_id;

                $img = $images->upload($request->file('imagem'));
                $receita->imagem = $img['url'];
                $receita->imagem_public_id = $img['public_id'];
            }

            $receita->save();

            if ($publicIdAntigo) {
                $images->delete($publicIdAntigo);
            }

            session()->flash('msg', 'Receita atualizada com sucesso!');
            return redirect()->route('receitas.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            return redirect()->route('receitas.view', ['id' => $id])->withInput();
        }
    }

    // Remove uma receita do bd
    public function destroy($id, ImageService $images)
    {
        try {
            $receita = Receita::where('id', $id)
                ->where('users_id', Auth::id())
                ->firstOrFail();

            // apaga a imagem do Cloudinary (se existir) antes de remover a receita
            if ($receita->imagem_public_id) {
                $images->delete($receita->imagem_public_id);
            }

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
        $request->validate([
            'filtro' => 'nullable|string|max:255',
        ]);

        $filtro = trim((string) $request->input('filtro', ''));

        $receitas = Receita::with('categoria')
                       ->where('users_id', Auth::id())
                       ->where('titulo', 'like', "%{$filtro}%")
                       ->orderBy('id')
                       ->get();

        $categorias = Categoria::where('user_id', Auth::id())->orderBy('nome')->get();

        return view('receitas.lista', [
            'receitas' => $receitas,
            'categorias' => $categorias,
            'filtro' => $filtro,
        ]);
    }
}