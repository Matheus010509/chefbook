<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login - ChefBook</title>
<link rel="icon" href="{{ asset('img/favicon.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="left">

    <div class="logo">🍳 ChefBook</div>
    <div class="subtitle">Seu Livro de Receitas</div>
    <div class="title">Login</div>
    <div class="description">Acesse sua conta para gerenciar suas receitas</div>

    @if (session('status'))
        <div class="session-status">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <input
                type="email"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}"
                autocomplete="username"
                autofocus
                required
                class="{{ $errors->has('email') ? 'input-error' : '' }}"
            >
            @error('email')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

  
        <div class="form-group">
            <input
                type="password"
                name="password"
                placeholder="Senha"
                autocomplete="current-password"
                required
                class="{{ $errors->has('password') ? 'input-error' : '' }}"
            >
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn">Entrar</button>

        <div class="link">
            Não possui uma conta? <a href="{{ route('register') }}">Cadastrar</a>
        </div>

    </form>

</div>

<div class="right"></div>

</body>
</html>