@extends('layout/layout_base')

@section('titulo')

  
<section class="breadcrumb breadcrumb_bg" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Receitas Favoritas</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('conteudo')
    <section class="review_part gray_bg section_padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="section_tittle">
                        <h2>Favoritas</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-11">
                    <div class="client_review_part owl-carousel">
                        <div class="client_review_single media">
                       
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


 
@endsection