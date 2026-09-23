<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChefBook</title>

    @include('layout/scripts_css')
</head>
<body>
    @include('layout/menu_base')

    @yield('titulo')
    @yield('conteudo')

    @include('layout/scripts_js')
</body>
</html>