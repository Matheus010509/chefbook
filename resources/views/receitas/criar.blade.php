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

               <form action="{{ route('receitas.store') }}" method="POST" enctype="multipart/form-data" class="receita_form">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome da Receita</label>
                        <input type="text" name="titulo" class="form-control" placeholder="Ex: Bolo de Chocolate">
                    </div>

                    <div class="mb-3">
    <label class="form-label">Categoria</label>

    <select name="categorias" class="form-select select-categoria">
        <option selected disabled>Selecione uma categoria</option>
        <option value="almoco">Almoço</option>
        <option value="sobremesa">Sobremesa</option>
        <option value="janta">Janta</option>
        <option value="lanche">Lanche</option>
    </select>
</div>

                    <div class="mb-3">
                        <label class="form-label">Ingredientes</label>
                        <textarea name="ingredientes" class="form-control" rows="3" placeholder="Digite os ingredientes"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Modo de Preparo</label>
                        <textarea name="modo_preparo" class="form-control" rows="4" placeholder="Descreva o preparo"></textarea>
                    </div>

                  <div class="mb-5">
    <label class="form-label">Imagem da Receita</label>
    <input type="file" name="imagem" class="form-control input-imagem">
</div>

                    <div class="text-center">
                        <button type="submit" class="btn_1">
                            Salvar Receita
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</section>


@endsection