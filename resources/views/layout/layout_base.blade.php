<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>ChefBook</title>
</head>
<body>
    @include('layout/scripts_css')
    @include('layout/menu_base')
     @yield('titulo')
    @yield('conteudo')
@include('layout/scripts_js')

</body>
</html>