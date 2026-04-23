@extends('layout_base')

@section('conteudo')

<!-- banner part start-->
<section class="banner_part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner_text">
                    <div class="banner_text_iner">
                        <h5>Seu livro de receitas</h5>
                        <h1>ChefBook</h1>
                        <p>Seja bem vindo ao seu restaurente virtual, aqui voce pode organizar e centralizar suas receitas em um so lugar!</p>
                        <div class="banner_btn">
                            <div class="banner_btn_iner">
                                <a href="#" class="btn_2">Minhas receitas <img src="img/icon/left_1.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Receita popular -->
<section class="exclusive_item_part blog_item_section">
    <div class="container">
        <h2>Receita popular</h2>
    </div>
</section>

<!-- about part -->
<section class="about_part">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-4 col-lg-5 offset-lg-1">
                <img src="img/brigadeiro.webp" alt="">
            </div>
            <div class="col-sm-8 col-lg-4">
                <h2>Brigadeiro</h2>

                <h4>Ingredientes</h4>
                <p>
                    1 lata de leite condensado <br>
                    7 colheres de chocolate <br>
                    1 colher de manteiga <br>
                    Granulado
                </p>

                <h4>Modo de preparo</h4>
                <p>
                    Misture tudo na panela, mexa até desgrudar,
                    deixe esfriar, enrole e passe no granulado.
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
                        <h3><a href="#">Panquecas americanas</a></h3>
                        <a href="#" class="btn_3">
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
                        <h3><a href="#">Cookie</a></h3>
                        <a href="#" class="btn_3">
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
                        <h3><a href="#">Pavê de maracujá</a></h3>
                        <a href="#" class="btn_3">
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