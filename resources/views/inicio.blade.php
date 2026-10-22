@extends('layout/layout_base')

@section('conteudo')

<section class="banner_part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner_text">
                    <div class="banner_text_iner">
                        <h5>Seu livro de receitas</h5>
                        <h1>ChefBook</h1>
                        <p>Seja bem vindo(a) ao seu restaurante virtual, aqui você pode organizar e centralizar suas receitas em um só lugar!</p>
                        <div class="banner_btn">
                            <div class="banner_btn_iner">
                           <a href="/minhas-receitas" class="meu-botao-receitas">
    Minhas receitas
   <img src="{{ asset('img/icon/left_1.svg') }}" alt="">
</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="exclusive_item_part blog_item_section">
    <div class="container">
        <h2>Receita popular</h2>
    </div>
</section>


<section class="about_part">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-4 col-lg-5 offset-lg-1">
                <img src="{{ asset('img/brigadeiro.webp') }}" alt="">
            </div>
            <div class="col-sm-8 col-lg-4">
              <h2>Brigadeiro</h2>
<br>
<h4>Ingredientes</h4>
<p>
    1 lata de leite condensado <br>
    1/2 caixa de creme de leite <br>
    7 colheres de sopa de chocolate em pó <br>
    1 colher de sopa de manteiga <br>
    Granulado
</p>
<br>
<h4>Modo de preparo</h4>
<p>
    Misture o leite condensado, o creme de leite, o chocolate em pó e a manteiga em uma panela.
    Leve ao fogo baixo, mexendo sempre, até desgrudar do fundo da panela.
    Deixe esfriar, enrole em bolinhas e passe no granulado.
</p>
            </div>
        </div>
    </div>
</section>

<!-- outras receitas -->
<section class="blog_item_section blog_section section_padding">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="section_tittle">
                    <h2>Outras receitas</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Panqueca -->
            <div class="col-sm-6 col-lg-4">
                <div class="single_blog_item">
                    <div class="single_blog_img">
                        <img src="{{ asset('img/blog/blog_1.png') }}" alt="">
                    </div>
                    <div class="single_blog_text">
                        <h3><a href="receitas-prontas">Panquecas americanas</a></h3>
                        <a href="receitas-prontas" class="btn_3">
                            Leia mais 
                            <img src="{{ asset('img/icon/left_1.svg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Cookie -->
            <div class="col-sm-6 col-lg-4">
                <div class="single_blog_item">
                    <div class="single_blog_img">
                        <img src="{{ asset('img/cookie.jpg') }}" alt="">
                    </div>
                    <div class="single_blog_text">
                        <h3><a href="receitas-prontas">Cookies</a></h3>
                        <a href="receitas-prontas" class="btn_3">
                            Leia mais 
                            <img src="{{ asset('img/icon/left_1.svg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pavê -->
            <div class="col-sm-6 col-lg-4">
                <div class="single_blog_item">
                    <div class="single_blog_img">
                        <img src="{{ asset('img/pave.webp') }}" alt="">
                    </div>
                    <div class="single_blog_text">
                        <h3><a href="receitas-prontas">Pavê de maracujá</a></h3>
                        <a href="receitas-prontas" class="btn_3">
                            Leia mais 
                            <img src="{{ asset('img/icon/left_1.svg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection