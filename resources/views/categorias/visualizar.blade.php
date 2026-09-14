@extends('layout/layout_base')

@section('titulo')

<section class="breadcrumb breadcrumb_bg" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>{{ $categoria->nome }}</h2>
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
                    <h2>Categoria</h2>
                </div>

                @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif

                @if (session('erro'))
                    <div class="alert alert-danger">{{ session('erro') }}</div>
                @endif

                <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" class="receita_form">
    @csrf

    <div class="mb-4">
        <label class="form-label">Nome da Categoria</label>
        <input type="text" name="nome" class="form-control" value="{{ $categoria->nome }}">
    </div>

   <div class="text-center">
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