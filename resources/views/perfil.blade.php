@extends('layout/layout_base')

@section('conteudo')

<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

<div class="profile-wrapper">
    <div class="profile-container">

        <div class="profile-header">
        </div>

        <div class="card">
            <h3>Informações do Perfil</h3>
            <p class="card-desc">Dados da sua conta.</p>

            <div class="form-group">
                <label for="name">Nome</label>
                <input
                    id="name"
                    type="text"
                    value="{{ $user->name }}"
                    disabled
                    readonly
                >
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    value="{{ $user->email }}"
                    disabled
                    readonly
                >

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="unverified-box">
                        Seu email ainda não foi verificado.
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <h3>Sair da Conta</h3>
            <p class="card-desc" style="margin-bottom: 16px;">Encerre sua sessão no ChefBook.</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Sair da Conta</button>
            </form>
        </div>

    </div>
</div>

@endsection