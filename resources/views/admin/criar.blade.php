@extends('layout/layout_base')

@section('titulo')

<section class="breadcrumb breadcrumb_bg" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Cadastrar Usuário</h2>
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
                    <p>Novo</p>
                    <h2>Usuário</h2>
                </div>

                @if (session('erro'))
                    <div class="alert alert-danger">{{ session('erro') }}</div>
                @endif

                <form action="{{ route('admin.store') }}" method="POST" class="receita_form">
                    @csrf

                   <div class="mb-3 form-group">
    <label class="form-label">Nome</label>
    <input
        type="text"
        name="name"
        class="form-control {{ $errors->has('name') ? 'input-error' : '' }}"
        placeholder="Nome completo"
        value="{{ old('name') }}"
        autocomplete="name"
        autofocus
        required
    >
    @error('name')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3 form-group">
    <label class="form-label">Email</label>
    <input
        type="email"
        name="email"
        class="form-control {{ $errors->has('email') ? 'input-error' : '' }}"
        placeholder="email@exemplo.com"
        value="{{ old('email') }}"
        autocomplete="username"
        required
    >
    @error('email')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4 form-group">
    <label class="form-label">Senha</label>
    <input
        type="password"
        name="password"
        class="form-control {{ $errors->has('password') ? 'input-error' : '' }}"
        placeholder="Digite uma senha"
        autocomplete="new-password"
        required
    >
    @error('password')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4 form-group">
    <label class="form-label">Confirme a Senha</label>
    <input
        type="password"
        name="password_confirmation"
        class="form-control {{ $errors->has('password_confirmation') ? 'input-error' : '' }}"
        placeholder="Confirme a senha"
        autocomplete="new-password"
        required
    >
    @error('password_confirmation')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="text-center">
    <button type="submit" class="btn_1">
        Salvar Usuário
    </button>
</div>

                </form>

            </div>
        </div>

    </div>
</section>

@endsection