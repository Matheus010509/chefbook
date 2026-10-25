@extends('layout/layout_base')

@section('titulo')

<section class="breadcrumb breadcrumb_bg" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Cadastrar Receita</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('conteudo')

<section class="food_menu gray_bg">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="section_tittle text-center mb-4">
                    <p>Nova</p>
                    <h2>Receita</h2>
                </div>

                @if (session('erro'))
                    <div class="alert alert-danger">{{ session('erro') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        Corrija os campos destacados abaixo e tente novamente.
                    </div>
                @endif

                <form action="{{ route('receitas.store') }}" method="POST" enctype="multipart/form-data" class="receita_form">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome da Receita</label>
                        <input type="text" name="titulo"
                               class="form-control @error('titulo') is-invalid @enderror"
                               value="{{ old('titulo') }}"
                               placeholder="Ex: Bolo de Chocolate">
                        @error('titulo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoria</label>
                        <select name="categoria_id" required
                                class="form-select select-categoria @error('categoria_id') is-invalid @enderror">
                            <option value="" disabled @selected(old('categoria_id') === null || old('categoria_id') === '')>
                                Selecione uma categoria
                            </option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" @selected(old('categoria_id') == $categoria->id)>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @if ($categorias->isEmpty())
                            <small class="text-muted">
                                Nenhuma categoria cadastrada ainda.
                                <a href="{{ route('categorias.create') }}">Criar categoria</a>
                            </small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ingredientes</label>
                        <textarea name="ingredientes"
                                  class="form-control @error('ingredientes') is-invalid @enderror"
                                  rows="3"
                                  placeholder="Ex: 2 xícaras de açúcar, 100g de manteiga,...">{{ old('ingredientes') }}</textarea>
                        @error('ingredientes')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Modo de Preparo</label>
                        <textarea name="modo_preparo"
                                  class="form-control @error('modo_preparo') is-invalid @enderror"
                                  rows="4"
                                  placeholder="Ex: Bata os ingredientes, leve ao forno,...">{{ old('modo_preparo') }}</textarea>
                        @error('modo_preparo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Imagem da Receita</label>
                        <input type="file" name="imagem" accept="image/jpeg,image/png,image/webp"
                               class="form-control input-imagem @error('imagem') is-invalid @enderror">
                        <small class="text-muted">Formatos: JPG, PNG ou WEBP, até 5 MB.</small>
                        @error('imagem')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn_1">
                            Salvar Receita
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