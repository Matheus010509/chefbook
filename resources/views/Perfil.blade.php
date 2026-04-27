@extends('layout/layout_base')

@section('conteudo')


<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">


<div style="width: 100%; max-width: 500px; text-align: center;">

    <h2 class="mb-4" style="color: orange;">Perfil</h2>

    <div class="mb-4">
        <i class="bi bi-person-circle" style="font-size: 90px; color: orange;"></i>
    </div>

    <div class="p-3 mb-3 text-start" style="background: #ffe0b2; border-radius: 20px;">
        <strong>Nome: </strong> Matheus Nascimento
    </div>


    <div class="p-3 mb-3 text-start" style="background: #ffe0b2; border-radius: 20px;">
        <strong>Email: </strong> matheusnascimento010520@gmail.com
    </div>

    <div class="p-3 mb-3 text-start" style="background: #ffe0b2; border-radius: 20px;">
        <strong>Senha: </strong> ********
    </div>

</div>


</div>

@endsection