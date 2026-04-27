<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login - ChefBook</title>
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
        background: #f5f5f5;
    }

    .left {
        width: 50%;
        background: #f5f5f5;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 80px;
    }

    .logo {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .subtitle {
        color: #ff6b3d;
        margin-bottom: 10px;
    }

    .title {
        font-size: 42px;
        margin-bottom: 20px;
    }

    .description {
        color: #555;
        margin-bottom: 40px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
    }

    input:focus {
        border-color: #ff6b3d;
    }

    .btn {
        width: 100%;
        padding: 12px;
        background: #ff6b3d;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn {
    display: block;
    text-align: center;
    text-decoration: none;
}

    .btn:hover {
        background: #e85a2f;
    }


    .right {
        width: 50%;
        background: url('https://images.unsplash.com/photo-1544025162-d76694265947') no-repeat center;
        background-size: cover;
        border-top-left-radius: 100px;
        border-bottom-left-radius: 100px;
    }

</style>
</head>
<body>

<div class="left">
    <div class="logo">🍳 ChefBook</div>
    <div class="subtitle">Seu Livro de Receitas</div>
    <div class="title">Login</div>
    <div class="description">Acesse sua conta para gerenciar suas receitas</div>

    <form>
        <div class="form-group">
            <input type="email" placeholder="Email" >
        </div>

        <div class="form-group">
            <input type="password" placeholder="Senha" >
        </div>

    <a href="/inicio" class="btn">Entrar</a>
    </form>
</div>

<div class="right"></div>

</body>
</html>