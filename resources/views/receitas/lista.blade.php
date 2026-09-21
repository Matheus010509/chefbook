@extends('layout/layout_base')

@section('titulo')

<section class="breadcrumb breadcrumb_bg" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Minhas Receitas</h2>
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

        @if (session('msg'))
            <div class="alert alert-success">{{ session('msg') }}</div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger">{{ session('erro') }}</div>
        @endif

        // Qual aba abre: a primeira com resultado da busca, ou a primeira da lista 
               @php
            $categoriaAtivaId = (!empty($filtro)
                ? $categorias->first(fn ($c) => $receitas->where('categoria_id', $c->id)->isNotEmpty())
                : null
            )?->id ?? $categorias->first()?->id;
        @endphp

        <div class="row justify-content-between align-items-start">
            <div class="col-lg-5">
                <div class="section_tittle">
                    <p>Minhas</p>
                    <h2>Receitas</h2>
                    <a href="{{ route('receitas.create') }}" class="btn text-white" style="background: #ff7e5f; font-weight: bold;">
                        Adicionar Receita
                    </a>

                    <a href="{{ route('categorias.create') }}" class="btn text-white" style="background: #ff7e5f; font-weight: bold;">
                        Adicionar Categoria
                    </a>
                </div>
            </div>
            <div class="col-lg-6">

                <form action="{{ route('receitas.search') }}" method="GET" class="d-flex mb-3" style="gap: 10px;">
                    <input type="text" name="filtro" value="{{ $filtro ?? '' }}" class="form-control" placeholder="Buscar receita...">
                    <button type="submit" class="btn text-white" style="background: #ff7e5f; font-weight: bold; white-space: nowrap;">
                        Buscar
                    </button>
                    @if (!empty($filtro))
                        <a href="{{ route('receitas.index') }}" class="btn btn-outline-secondary" style="white-space: nowrap;">
                            Limpar
                        </a>
                    @endif
                </form>

                {{-- Abas de categoria --}}
                @if ($categorias->isEmpty())
                    <p class="text-muted">Você ainda não criou nenhuma categoria.</p>
                @else
                    <div class="nav nav-tabs food_menu_nav" id="myTab" role="tablist"> 
                        @foreach ($categorias as $categoria)
                            <a class="{{ $categoria->id === $categoriaAtivaId ? 'active' : '' }}" #para eu fazer um controle das abas de categoria
                               id="categoria-{{ $categoria->id }}-tab"
                               data-toggle="tab"
                               href="#categoria-{{ $categoria->id }}"
                               role="tab"
                               aria-controls="categoria-{{ $categoria->id }}"
                               aria-selected="{{ $categoria->id === $categoriaAtivaId ? 'true' : 'false' }}">
                                {{ $categoria->nome }} <img src="img/icon/play.svg" alt="play">
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="tab-content" id="myTabContent">

            @foreach ($categorias as $categoria)
                <div class="tab-pane fade {{ $categoria->id === $categoriaAtivaId ? 'show active' : '' }}" # funcionamento das abas
                     id="categoria-{{ $categoria->id }}"
                     role="tabpanel"
                     aria-labelledby="categoria-{{ $categoria->id }}-tab">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">{{ $categoria->nome }}</h5>
                        <div class="d-flex" style="gap: 8px;">
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-outline-secondary">
                                Editar categoria
                            </a>

             
                            @if (!$categoria->receitas()->exists())
                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="GET"   # Só deixa excluir se a categoria não tiver nenhuma receita 
                                      onsubmit="return confirm('Tem certeza que deseja excluir a categoria \'{{ $categoria->nome }}\'?');">
                                    <button type="submit" class="btn btn-sm text-white" style="background: #dc3545;">
                                        Excluir
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        @forelse ($receitas->where('categoria_id', $categoria->id) as $receita)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card shadow-sm h-100" style="border-radius: 15px;">

                                   @if ($receita->imagem)  //para exibir a imagem da receita, se houver
                                     <img src="{{ asset('storage/' . $receita->imagem) }}" class="card-img-top"
                                        style="height: 180px; width: 100%; object-fit: contain; background-color: #f8f9fa; border-radius: 15px 15px 0 0;"
                                          alt="{{ $receita->titulo }}">
                                    @endif

                                    <div class="card-body">
                                        <h5 class="card-title">{{ $receita->titulo }}</h5>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-white border-0 pb-3">
                                        <a href="{{ route('receitas.view', $receita->id) }}" class="btn btn-sm btn-outline-secondary">
                                            Ver / Editar
                                        </a>
                                        <form action="{{ route('receitas.destroy', $receita->id) }}" method="GET"
                                              onsubmit="return confirm('Tem certeza que deseja excluir esta receita?');"> //mensagem de confirmação antes de excluir a receita
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button> //botao de excluir receita
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">Nenhuma receita cadastrada em "{{ $categoria->nome }}".</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</section>

@endsection