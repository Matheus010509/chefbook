@extends('layout/layout_base')

@section('conteudo')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

```
<div class="card shadow-lg" style="width: 100%; max-width: 700px; border-radius: 15px;">
    
    <div class="card-header text-center text-white" style="background: linear-gradient(5deg, #ff7e5f, #feb47b); border-radius: 15px 15px 0 0;">
        <h3>Cadastrar Receita </h3>
    </div>

    <div class="card-body p-4">

        <form>
            
            <div class="mb-3">
                <label class="form-label">Nome da Receita</label>
                <input type="text" class="form-control" placeholder="Ex: Bolo de Chocolate">
            </div>

            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select class="form-select">
                    <option selected disabled>Selecione uma categoria</option>
                    <option value="almoco">Almoço</option>
                    <option value="janta">Janta</option>
                    <option value="lanche">Lanche</option>
                    <option value="sobremesa">Sobremesa</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ingredientes</label>
                <textarea class="form-control" rows="3" placeholder="Digite os ingredientes"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Modo de Preparo</label>
                <textarea class="form-control" rows="4" placeholder="Descreva o preparo"></textarea>
            </div>

<a href="/minhas-receitas" class="btn w-100 text-white" style="background: #ff7e5f; font-weight: bold;">
    Salvar Receita
</a>

        </form>

    </div>
</div>
```

</div>
@endsection
