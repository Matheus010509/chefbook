@extends('layout/layout_base')

@section('titulo')

<section class="breadcrumb breadcrumb_bg" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Cadastrar Categoria</h2>
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
                <h2>Categoria</h2>
            </div>

            {{-- Mensagem de erro --}}
            @if (session('erro'))
                <div class="alert alert-danger">
                    {{ session('erro') }}
                </div>
            @endif

            {{-- Erros de validação --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categorias.store') }}"
                  method="POST"
                  class="receita_form">

                @csrf

                <div class="mb-5">
                    <label class="form-label">
                        Nome da Categoria
                    </label>

                    <input
                        type="text"
                        name="nome"
                        class="form-control"
                        placeholder="Ex: Massas"
                        value="{{ old('nome') }}"
                    >
                </div>

                <div class="text-center">

                    <button type="submit" class="btn_1">
                        Salvar Categoria
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
