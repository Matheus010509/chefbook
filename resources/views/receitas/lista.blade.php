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

        <div class="row justify-content-between align-items-start">
            <div class="col-lg-5">
                <div class="section_tittle">
                    <p>Minhas</p>
                    <h2>Receitas</h2>
                    <a href="{{ route('receitas.create') }}" class="btn text-white" style="background: #ff7e5f; font-weight: bold;">
                        Adicionar Receita
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

                {{-- Minhas categorias --}}

                <div class="nav nav-tabs food_menu_nav" id="myTab" role="tablist">
                    <a class="active" id="Special-tab" data-toggle="tab" href="#Special" role="tab"
                        aria-controls="Special" aria-selected="true">Almoço <img src="img/icon/play.svg" alt="play"></a>

                    <a id="Breakfast-tab" data-toggle="tab" href="#Breakfast" role="tab" aria-controls="Breakfast"
                        aria-selected="false">Café da Manhã <img src="img/icon/play.svg" alt="play"></a>

                    <a id="Launch-tab" data-toggle="tab" href="#Launch" role="tab" aria-controls="Launch"
                        aria-selected="false">Lanche <img src="img/icon/play.svg" alt="play"></a>

                    <a id="Dinner-tab" data-toggle="tab" href="#Dinner" role="tab" aria-controls="Dinner"
                        aria-selected="false">Janta <img src="img/icon/play.svg" alt="play"></a>

                </div>
            </div>
        </div>

        <div class="tab-content" id="myTabContent">

          {{-- vou exibir apenas as receitas do usuário logado, filtrando por categoria --}}
          {{-- almoço --}}
            <div class="tab-pane fade show active" id="Special" role="tabpanel" aria-labelledby="Special-tab">
                <div class="row">
                    @forelse ($receitas->where('categorias', 'almoco') as $receita)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100" style="border-radius: 15px;">
                                @if ($receita->imagem)
                                    <img src="{{ asset('storage/' . $receita->imagem) }}" class="card-img-top"
                                         style="height: 180px; object-fit: cover; border-radius: 15px 15px 0 0;"
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
                                          onsubmit="return confirm('Tem certeza que deseja excluir esta receita?');">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><p class="text-muted">Nenhuma receita de almoço cadastrada.</p></div>
                    @endforelse
                </div>
            </div>

           {{-- cafe da manha --}}
            <div class="tab-pane fade" id="Breakfast" role="tabpanel" aria-labelledby="Breakfast-tab">
                <div class="row">
                    @forelse ($receitas->where('categorias', 'cafe_da_manha') as $receita)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100" style="border-radius: 15px;">
                                @if ($receita->imagem)
                                    <img src="{{ asset('storage/' . $receita->imagem) }}" class="card-img-top"
                                         style="height: 180px; object-fit: cover; border-radius: 15px 15px 0 0;"
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
                                          onsubmit="return confirm('Tem certeza que deseja excluir esta receita?');">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><p class="text-muted">Nenhuma receita de café da manhã cadastrada.</p></div>
                    @endforelse
                </div>
            </div>

           {{-- lanche --}}
            <div class="tab-pane fade" id="Launch" role="tabpanel" aria-labelledby="Launch-tab">
                <div class="row">
                    @forelse ($receitas->where('categorias', 'lanche') as $receita)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100" style="border-radius: 15px;">
                                @if ($receita->imagem)
                                    <img src="{{ asset('storage/' . $receita->imagem) }}" class="card-img-top"
                                         style="height: 180px; object-fit: cover; border-radius: 15px 15px 0 0;"
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
                                          onsubmit="return confirm('Tem certeza que deseja excluir esta receita?');">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><p class="text-muted">Nenhuma receita de lanche cadastrada.</p></div>
                    @endforelse
                </div>
            </div>

            {{-- janta --}}
            <div class="tab-pane fade" id="Dinner" role="tabpanel" aria-labelledby="Dinner-tab">
                <div class="row">
                    @forelse ($receitas->where('categorias', 'janta') as $receita)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100" style="border-radius: 15px;">
                                @if ($receita->imagem)
                                    <img src="{{ asset('storage/' . $receita->imagem) }}" class="card-img-top"
                                         style="height: 180px; object-fit: cover; border-radius: 15px 15px 0 0;"
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
                                          onsubmit="return confirm('Tem certeza que deseja excluir esta receita?');">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><p class="text-muted">Nenhuma receita de janta cadastrada.</p></div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
</section>

@endsection