<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // Exibe a lista de todos os usuários cadastrados menos o adm, id1.
    public function index()
    {
        $usuarios = User::where('id', '!=', 1)->get();

        return view('admin.lista', ['usuarios' => $usuarios, 'filtro' => '']);
    }

    // Exibe o formulário de cadastro de um novo usuário.
    public function create()
    {
        return view('admin.criar');
    }

    // Recebe os dados do formulário e cadastra no banco.
    public function store(Request $request)
    {
        // Espelha a migration de users: name, email (único) e password são NOT NULL
        $dados = $request->validate([
    'name'     => 'required|string|max:255',
    'email' => 'required|string|lowercase|email|max:255|unique:users,email',
    'password' => 'required|string|min:8|confirmed',
]);

        try {
            $usuario = new User();
            $usuario->name = $dados['name'];
            $usuario->email = $dados['email'];
            $usuario->password = Hash::make($dados['password']);
            $usuario->save();

            session()->flash('msg', 'Usuário cadastrado com sucesso!');
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao cadastrar: ' . $e->getMessage());
            return redirect()->route('admin.create')->withInput();
        }
    }

    // Exibe os dados de um usuário específico para ver/editar.
    public function edit($id)
    {
        // findOrFail: id inexistente retorna 404 em vez de mandar null para a view
        $usuario = User::findOrFail($id);

        return view('admin.visualizar', ['usuario' => $usuario]);
    }

    // Atualiza os dados de um usuário existente.
    public function update(Request $request, $id)
    {
        $dados = $request->validate([
            'name'     => 'required|string|max:255',
            // o e-mail precisa ser único, ignorando o próprio usuário
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id)],
            // senha opcional na edição: só é trocada se for preenchida
            'password' => 'nullable|string|min:8',
        ]);

        $usuario = User::findOrFail($id);

        try {
            $usuario->name = $dados['name'];
            $usuario->email = $dados['email'];

            if (!empty($dados['password'])) {
                $usuario->password = Hash::make($dados['password']);
            }

            $usuario->save();

            session()->flash('msg', 'Usuário atualizado com sucesso!');
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            return redirect()->route('admin.edit', ['id' => $id])->withInput();
        }
    }

    // Remove um user do bd
    public function destroy($id)
    {
        // bloqueia a exclusão do id = 1
        if ((int) $id === 1) {
            session()->flash('erro', 'Não é possível excluir o administrador principal.');
            return redirect()->route('admin.index');
        }

        $usuario = User::findOrFail($id);

        try {
            $usuario->delete();

            session()->flash('msg', 'Usuário excluído com sucesso!');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
        }

        return redirect()->route('admin.index');
    }

    // Busca/filtra users pelo nome ou email no campo de busca
    public function search(Request $request)
    {
        $request->validate([
            'filtro' => 'nullable|string|max:255',
        ]);

        $filtro = trim((string) $request->input('filtro', ''));

        // O where/orWhere vai agrupado numa closure, para o "id != 1" valer para os dois
        $usuarios = User::where('id', '!=', 1)
            ->where(function ($query) use ($filtro) {
                $query->where('name', 'like', "%{$filtro}%")
                      ->orWhere('email', 'like', "%{$filtro}%");
            })
            ->orderBy('id')
            ->get();

        return view('admin.lista', ['usuarios' => $usuarios, 'filtro' => $filtro]);
    }
}