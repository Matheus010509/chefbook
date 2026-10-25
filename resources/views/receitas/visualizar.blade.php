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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        Corrija os campos destacados abaixo e tente novamente.
                    </div>
                @endif

                @if ($receita->imagem)
                    <div class="text-center mb-4">
                         <img src="{{ $receita->imagem }}" alt="{{ $receita->titulo }}"
                             style="max-width: 100%; max-height: 250px; border-radius: 10px;">
                    </div>
                @endif

                <form action="{{ route('receitas.update', $receita->id) }}" method="POST" enctype="multipart/form-data" class="receita_form">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome da Receita</label>
                        <input type="text" name="titulo"
                               class="form-control @error('titulo') is-invalid @enderror"
                               value="{{ old('titulo', $receita->titulo) }}">
                        @error('titulo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoria</label>
                        <select name="categoria_id" required
                                class="form-select select-categoria @error('categoria_id') is-invalid @enderror">
                            <option value="" disabled @selected((string) old('categoria_id', $receita->categoria_id) === '')>
                                Selecione uma categoria
                            </option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    @selected((string) old('categoria_id', $receita->categoria_id) === (string) $categoria->id)>
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
                            </small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ingredientes</label>
                        <textarea name="ingredientes"
                                  class="form-control @error('ingredientes') is-invalid @enderror"
                                  rows="3">{{ old('ingredientes', $receita->ingredientes) }}</textarea>
                        @error('ingredientes')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Modo de Preparo</label>
                        <textarea name="modo_preparo"
                                  class="form-control @error('modo_preparo') is-invalid @enderror"
                                  rows="4">{{ old('modo_preparo', $receita->modo_preparo) }}</textarea>
                        @error('modo_preparo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Imagem da Receita</label>
                        <input type="file" name="imagem" accept="image/jpeg,image/png,image/webp"
                               class="form-control input-imagem @error('imagem') is-invalid @enderror">
                        <small class="text-muted">
                            Opcional. Se não escolher um arquivo, a imagem atual é mantida. Formatos: JPG, PNG ou WEBP, até 5 MB.
                        </small>
                        @error('imagem')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
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