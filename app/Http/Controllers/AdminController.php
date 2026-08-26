<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Exibe a lista de todos os usuários cadastrados menos o adm, id1.
     
    public function index()
    {
        // Busca todos os usuários com id diferente de 1
        $usuarios = User::where('id', '!=', 1)->get();

        // Retorna a view de listagem, passando os usuários e um filtro vazio (usado na busca)
        return view('admin.lista', ['usuarios' => $usuarios, 'filtro' => '']);
    }

    // Exibe o formulário de cadastro de um novo usuário.
    
    public function create()
    {
        return view('admin.criar');
    }

    //  Recebe os dados do formulário e cadastra no banco.
    public function store(Request $request)
    {
        try {
        
            $usuario = new User();

            // Preenche os dados a partir do que foi enviado pelo formulário
            $usuario->name = $request->input('name');
            $usuario->email = $request->input('email');

            // Faz o hash da senha antes de salvar
            $usuario->password = Hash::make($request->input('password'));

            // salva o novo user no bd
            $usuario->save();

            // Mensagem de sucesso
            session()->flash('msg', 'Usuário cadastrado com sucesso!');
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            // Em caso de erro,
            // guarda a mensagem de erro na sessão e volta para o formulário de cadastro
            session()->flash('erro', 'Erro ao cadastrar: ' . $e->getMessage());
            return redirect()->route('admin.create');
        }
    }

    
      //Exibe os dados de um usuário específico para ver/editar.
     
    public function edit($id)
    {
        try {
            // Busca o usuário pelo id recebido na rota
            $usuario = User::find($id);

            return view('admin.visualizar', ['usuario' => $usuario]);
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao carregar: ' . $e->getMessage());
            return redirect()->route('admin.index');
        }
    }

    
      //Atualiza os dados de um usuário existente.
     
    public function update(Request $request, $id)
    {
        try {
            // achar oq sera atualizado
            $usuario = User::find($id);

            // atualiza nome e email com os dados do form
            $usuario->name = $request->input('name');
            $usuario->email = $request->input('email');

            // so atualiza a senha se o campo foi preenchido
            if ($request->filled('password')) {
                $usuario->password = Hash::make($request->input('password'));
            }

            // salva as mudancas no banco
            $usuario->save();

            session()->flash('msg', 'Usuário atualizado com sucesso!');
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            // em caso de erro, volta para a tela de edição do mesmo usuário
            return redirect()->route('admin.edit', ['id' => $id]);
        }
    }

    
     // Remove um user do bd
     
    public function destroy($id)
    {
        try {
            // bloqueia a exclusão do id = 1
            if ($id == 1) {
                session()->flash('erro', 'Não é possível excluir o administrador principal.');
                return redirect()->route('admin.index');
            }

            // Busca e exclui o usuário
            $usuario = User::find($id);
            $usuario->delete();

            session()->flash('msg', 'Usuário excluído com sucesso!');
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
            return redirect()->route('admin.index');
        }
    }

    
    //  Busca/filtra users pelo nome ou email no campo de busca
     
    public function search(Request $request)
    {
        // remove espaços em branco na busca
        // Se não vier nenhum filtro assume string vazia
        $filtro = trim((string) $request->input('filtro', ''));
        $usuarios = User::where('id', '!=', 1)
                       ->where('name', 'like', "%{$filtro}%")
                       ->orWhere('email', 'like', "%{$filtro}%")
                       ->orderBy('id')
                       ->get();

        // Retorna a mesma view de listagem, agora com os resultados filtrados
        return view('admin.lista', ['usuarios' => $usuarios, 'filtro' => $filtro]);
    }
} 