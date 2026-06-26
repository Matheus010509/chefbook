<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>ChefBook - Cadastro</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    display: flex;
    height: 100vh;
}

.left {
    width: 55%;
    background: url('https://images.unsplash.com/photo-1544025162-d76694265947') no-repeat center;
    background-size: cover;
    position: relative;
}

.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0,0,0,0.5), rgba(255,107,61,0.4));
}

.text-overlay {
    position: absolute;
    bottom: 60px;
    left: 60px;
    color: white;
}

.text-overlay h1 {
    font-size: 42px;
    margin-bottom: 10px;
}

.text-overlay p {
    font-size: 16px;
    max-width: 400px;
}

.right {
    width: 45%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f5f5f5;
}

.card {
    width: 380px;
    padding: 40px;
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.logo {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 5px;
}

.subtitle {
    color: #ff6b3d;
    margin-bottom: 20px;
}

.title {
    font-size: 28px;
    margin-bottom: 10px;
}

.description {
    font-size: 14px;
    color: #555;
    margin-bottom: 25px;
}


.form-group {
    margin-bottom: 15px;
}

input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
    transition: 0.3s;
}

input:focus {
    border-color: #ff6b3d;
    box-shadow: 0 0 5px rgba(255,107,61,0.3);
}

.btn {
    width: 100%;
    padding: 12px;
    background: #ff6b3d;
    border: none;
    color: white;
    font-size: 15px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background: #e85a2f;
}

.link {
    margin-top: 15px;
    font-size: 13px;
    text-align: center;
}

.link a {
    color: #ff6b3d;
    text-decoration: none;
}

</style>
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

    {{-- ERROS --}}
    @if ($errors->any())
        <div style="color:red; margin-bottom:10px;">
            Corrija os campos do cadastro
        </div>
    @endif

    <div class="form-group">
        <input type="text" name="name" placeholder="Nome de usuário" required>
    </div>

    <div class="form-group">
        <input type="email" name="email" placeholder="Email" required>
    </div>

    <div class="form-group">
        <input type="password" name="password" placeholder="Senha" required>
    </div>

    <div class="form-group">
        <input type="password" name="password_confirmation" placeholder="Confirme a Senha" required>
    </div>


    <button type="submit" class="btn">
        Criar Conta
    </button>

  
</form>
    </div>
</div>

</body>
</html>