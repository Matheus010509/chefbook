<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>ChefBook - Cadastro</title>
<link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
</head>

<body>

<div class="left">
    <div class="overlay"></div>
    <div class="text-overlay">
        <h1>ChefBook</h1>
        <p>Organize, salve e descubra receitas incríveis em um só lugar.</p>
    </div>
</div>

<div class="right">
    <div class="card">
        <div class="logo">🍳 ChefBook</div>
        <div class="subtitle">Seu Livro de Receitas</div>
        <div class="title">Criar Conta</div>
        <div class="description">Comece agora sua jornada culinária</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <input
                    type="text"
                    name="name"
                    placeholder="Nome de usuário"
                    value="{{ old('name') }}"
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
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    required
                    class="{{ $errors->has('email') ? 'input-error' : '' }}"
                >
                @error('email')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- SENHA --}}
            <div class="form-group">
                <input
                    type="password"
                    name="password"
                    placeholder="Senha"
                    autocomplete="new-password"
                    required
                    class="{{ $errors->has('password') ? 'input-error' : '' }}"
                >
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- CONFIRMAR SENHA --}}
            <div class="form-group">
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirme a Senha"
                    autocomplete="new-password"
                    required
                    class="{{ $errors->has('password_confirmation') ? 'input-error' : '' }}"
                >
                @error('password_confirmation')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">Criar Conta</button>

            <div class="link">
                Já possui uma conta? <a href="{{ route('login') }}">Entrar</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>