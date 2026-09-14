@extends('layout/layout_base')

@section('titulo')

<section class="breadcrumb breadcrumb_bg" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>{{ $receita->titulo }}</h2>
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

        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="section_tittle text-center mb-4">
                    <p>Editar</p>
                    <h2>Receita</h2>
                </div>

                @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif

                @if (session('erro'))
                    <div class="alert alert-danger">{{ session('erro') }}</div>
                @endif

                @if ($receita->imagem)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $receita->imagem) }}" alt="{{ $receita->titulo }}"
                             style="max-width: 100%; max-height: 250px; border-radius: 10px;">
                    </div>
                @endif

                <form action="{{ route('receitas.update', $receita->id) }}" method="POST" enctype="multipart/form-data" class="receita_form">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome da Receita</label>
                        <input type="text" name="titulo" class="form-control" value="{{ $receita->titulo }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoria</label>
                        <select name="categoria_id" class="form-select select-categoria">
                            <option value="" disabled>Selecione uma categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $receita->categoria_id == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        @if ($categorias->isEmpty())
                            <small class="text-muted">
                                Nenhuma categoria cadastrada ainda.
                            </small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ingredientes</label>
                        <textarea name="ingredientes" class="form-control" rows="3">{{ $receita->ingredientes }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Modo de Preparo</label>
                        <textarea name="modo_preparo" class="form-control" rows="4">{{ $receita->modo_preparo }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Imagem da Receita</label>
                        <input type="file" name="imagem" class="form-control input-imagem">
                    </div>

                    <div class="d-flex gap-2 justify-content-center">
                        <button type="submit" class="btn_1">
                            Salvar Alterações
                        </button>
                        <a href="{{ route('receitas.index') }}" class="btn_2">
                            Voltar
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</section>

@endsection