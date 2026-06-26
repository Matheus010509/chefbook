@extends('layout/layout_base')

@section('conteudo')

<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

<div class="profile-wrapper">
    <div class="profile-container">

        {{-- HEADER --}}
        <div class="profile-header">
        </div>

        {{-- CARD: EDITAR PERFIL --}}
        <div class="card">
            <h3>Informações do Perfil</h3>
            <p class="card-desc">Atualize seu nome e endereço de email.</p>

            @if (session('status') === 'verification-link-sent')
                <div class="status-success">
                    Um novo link de verificação foi enviado para o seu email.
                </div>
            @endif

            <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        autocomplete="name"
                        autofocus
                        required
                        class="{{ $errors->has('name') ? 'input-error' : '' }}"
                    >
                    @error('name')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        autocomplete="username"
                        required
                        class="{{ $errors->has('email') ? 'input-error' : '' }}"
                    >
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="unverified-box">
                            Seu email ainda não foi verificado.
                            <button form="send-verification">
                                Clique aqui para reenviar o link de verificação.
                            </button>
                        </div>
                    @endif
                </div>

                <div class="save-row">
                    <button type="submit" class="btn-primary">Salvar</button>
                    @if (session('status') === 'profile-updated')
                        <span class="saved-msg" id="profile-saved">✓ Salvo com sucesso</span>
                        <script>
                            const el = document.getElementById('profile-saved');
                            el.style.display = 'inline';
                            setTimeout(() => el.style.display = 'none', 2500);
                        </script>
                    @endif
                </div>
            </form>
        </div>

        {{-- CARD: ALTERAR SENHA --}}
        <div class="card">
            <h3>Alterar Senha</h3>
            <p class="card-desc">Use uma senha longa e segura para proteger sua conta.</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="current_password">Senha Atual</label>
                    <input
                        id="current_password"
                        type="password"
                        name="current_password"
                        autocomplete="current-password"
                        class="{{ $errors->updatePassword->has('current_password') ? 'input-error' : '' }}"
                    >
                    @if ($errors->updatePassword->has('current_password'))
                        <div class="field-error">{{ $errors->updatePassword->first('current_password') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="new_password">Nova Senha</label>
                    <input
                        id="new_password"
                        type="password"
                        name="password"
                        autocomplete="new-password"
                        class="{{ $errors->updatePassword->has('password') ? 'input-error' : '' }}"
                    >
                    @if ($errors->updatePassword->has('password'))
                        <div class="field-error">{{ $errors->updatePassword->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Nova Senha</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        autocomplete="new-password"
                        class="{{ $errors->updatePassword->has('password_confirmation') ? 'input-error' : '' }}"
                    >
                    @if ($errors->updatePassword->has('password_confirmation'))
                        <div class="field-error">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                    @endif
                </div>

                <div class="save-row">
                    <button type="submit" class="btn-primary">Salvar</button>
                    @if (session('status') === 'password-updated')
                        <span class="saved-msg" id="password-saved">✓ Senha atualizada</span>
                        <script>
                            const el2 = document.getElementById('password-saved');
                            el2.style.display = 'inline';
                            setTimeout(() => el2.style.display = 'none', 2500);
                        </script>
                    @endif
                </div>
            </form>
        </div>

        {{-- CARD: LOGOUT --}}
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