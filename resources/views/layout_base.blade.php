<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>ChefBook</title>
</head>
<body>
    @include('scripts_css')
    @include('menu_base')
@yield('titulo')
    @yield('conteudo')
@include('scripts_js')

</body>
</html>