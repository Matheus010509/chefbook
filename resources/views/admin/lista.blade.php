@extends('layout/layout_base')

@section('titulo')

<section class="breadcrumb breadcrumb_bg" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Painel do Administrador</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('conteudo')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/receitas.css') }}">
@endpush

<section class="food_menu gray_bg">
    <div class="container">

        @if (session('msg'))
            <div class="alert alert-success">{{ session('msg') }}</div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger">{{ session('erro') }}</div>
        @endif

        <div class="row justify-content-between align-items-start mb-4">
            <div class="col-lg-5">
                <div class="section_tittle">
                    <p>Gerenciar</p>
                    <h2>Usuários</h2>
                    <a href="{{ route('admin.create') }}" class="btn_1">
                        Adicionar Usuário
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <form action="{{ route('admin.search') }}" method="GET" class="d-flex mb-3" style="gap: 10px;">
                    <input type="text" name="filtro" value="{{ $filtro ?? '' }}" class="form-control" placeholder="Buscar por nome ou email...">
                    <button type="submit" class="btn_1" style="white-space: nowrap;">
                        Buscar
                    </button>
                    @if (!empty($filtro))
                        <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary" style="white-space: nowrap;">
                            Limpar
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table bg-white shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <thead style="background: #ff7e5f; color: #fff;">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.edit', $usuario->id) }}" class="btn_2">
                                    Editar
                                </a>
                                <form action="{{ route('admin.destroy', $usuario->id) }}" method="GET"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                    <button type="submit" class="btn_3">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Nenhum usuário encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</section>

@endsection