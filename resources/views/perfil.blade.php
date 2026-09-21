@extends('layout/layout_base')

@section('conteudo')

<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

<div class="profile-wrapper">
    <div class="profile-container">

        <div class="profile-header">
        </div>

        //editar perfil
        
        <div class="card">
            <h3>Informações do Perfil</h3>
            <p class="card-desc">Atualize seu nome e endereço de email.</p>

            <form method="POST" action="{{ route('profile.update') }}"> //chamo a funcao do breeze de atualizar perfil
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}" #pego o valor antigo do nome
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

                </div>

                <div class="save-row">
                    <button type="submit" class="btn-primary">Salvar</button>
                    @if (session('status') === 'profile-updated')
                        <span class="saved-msg" id="profile-saved">✓ Salvo com sucesso</span> //mensagem de sucesso ao salvar o perfil
                        <script>
                            const el = document.getElementById('profile-saved');
                            el.style.display = 'inline';
                            setTimeout(() => el.style.display = 'none', 2500);
                        </script>
                    @endif
                </div>
            </form>
        </div>

        // alterar senha
        <div class="card">
            <h3>Alterar Senha</h3>
            <p class="card-desc">Use uma senha longa e segura para proteger sua conta.</p>

            <form method="POST" action="{{ route('password.update') }}"> //chamo a funcao do breeze de atualizar senha
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
                    @if ($errors->updatePassword->has('current_password')) //vejo se tem algum erro na senha atual
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
                    @if ($errors->updatePassword->has('password')) //na senha nova
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
                    @if ($errors->updatePassword->has('password_confirmation')) //e na confirmacao da senha nova
                        <div class="field-error">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                    @endif
                </div>

                <div class="save-row">
                    <button type="submit" class="btn-primary">Salvar</button>
                    @if (session('status') === 'password-updated')
                        <span class="saved-msg" id="password-saved">✓ Senha atualizada</span> //msm coisa, dou uma mensagem rapida
                        <script>
                            const el2 = document.getElementById('password-saved');
                            el2.style.display = 'inline';
                            setTimeout(() => el2.style.display = 'none', 2500);
                        </script>
                    @endif
                </div>
            </form>
        </div>

        //logout
        <div class="card">
            <h3>Sair da Conta</h3>
            <p class="card-desc" style="margin-bottom: 16px;">Encerre sua sessão no ChefBook.</p>
            <form method="POST" action="{{ route('logout') }}"> //chamo a funcao do breeze de logout
                @csrf
                <button type="submit" class="btn-logout">Sair da Conta</button>
            </form>
        </div>

    </div>
</div>

@endsection