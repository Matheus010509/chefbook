<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = User::where('id', '!=', 1)->get();
        return view('admin.lista', ['usuarios' => $usuarios, 'filtro' => '']);
    }

    public function create()
    {
        return view('admin.criar');
    }

    public function store(Request $request)
    {
        try {
            $usuario = new User();
            $usuario->name = $request->input('name');
            $usuario->email = $request->input('email');
            $usuario->password = Hash::make($request->input('password'));
            $usuario->save();

            session()->flash('msg', 'Usuário cadastrado com sucesso!');
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao cadastrar: ' . $e->getMessage());
            return redirect()->route('admin.create');
        }
    }

  public function edit($id)
{
    try {
        $usuario = User::find($id);
        return view('admin.visualizar', ['usuario' => $usuario]);
    } catch (\Exception $e) {
        session()->flash('erro', 'Erro ao carregar: ' . $e->getMessage());
        return redirect()->route('admin.index');
    }
}

    public function update(Request $request, $id)
    {
        try {
            $usuario = User::find($id);
            $usuario->name = $request->input('name');
            $usuario->email = $request->input('email');

            if ($request->filled('password')) {
                $usuario->password = Hash::make($request->input('password'));
            }

            $usuario->save();

            session()->flash('msg', 'Usuário atualizado com sucesso!');
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            return redirect()->route('admin.edit', ['id' => $id]);
        }
    }

    public function destroy($id)
    {
        try {
            if ($id == 1) {
                session()->flash('erro', 'Não é possível excluir o administrador principal.');
                return redirect()->route('admin.index');
            }

            $usuario = User::find($id);
            $usuario->delete();
            session()->flash('msg', 'Usuário excluído com sucesso!');
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
            return redirect()->route('admin.index');
        }
    }

    public function search(Request $request)
    {
        $filtro = trim((string) $request->input('filtro', ''));
        $usuarios = User::where('id', '!=', 1)
                       ->where('name', 'like', "%{$filtro}%")
                       ->orWhere('email', 'like', "%{$filtro}%")
                       ->orderBy('id')
                       ->get();
        return view('admin.lista', ['usuarios' => $usuarios, 'filtro' => $filtro]);
    }
}