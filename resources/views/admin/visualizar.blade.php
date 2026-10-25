@extends('layout/layout_base')

@section('titulo')

<section class="breadcrumb breadcrumb_bg" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>{{ $usuario->name }}</h2>
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
                    <h2>Usuário</h2>
                </div>

                @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif

                @if (session('erro'))
                    <div class="alert alert-danger">{{ session('erro') }}</div>
                @endif

                <form action="{{ route('admin.update', $usuario->id) }}" method="POST" class="receita_form">
                    @csrf

                    <div class="mb-3 form-group">
                        <label class="form-label">Nome</label>
                        <input type="text" name="name"
                               class="form-control {{ $errors->has('name') ? 'input-error' : '' }}"
                               value="{{ old('name', $usuario->name) }}"
                               autocomplete="name"
                               required>
                        @error('name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control {{ $errors->has('email') ? 'input-error' : '' }}"
                               value="{{ old('email', $usuario->email) }}"
                               autocomplete="username"
                               required>
                        @error('email')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 form-group">
                        <label class="form-label">Nova Senha</label>
                        <input type="password" name="password"
                               class="form-control {{ $errors->has('password') ? 'input-error' : '' }}"
                               placeholder="Deixe em branco para manter a atual"
                               autocomplete="new-password">
                        @error('password')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-center">
                        <button type="submit" class="btn_1">
                            Salvar Alterações
                        </button>
                        <a href="{{ route('admin.index') }}" class="btn_2">
                            Voltar
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</section>

@endsection