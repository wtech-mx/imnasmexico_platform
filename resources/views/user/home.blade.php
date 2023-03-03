@extends('layouts.app_user')

@section('template_title')
    Inicio
@endsection

@section('content')

<section class="primario bg_overley" style="heigth:500px;background-image: url('{{ asset('assets/user/utilidades/cosmetologa_bg.jpg')}}')">

    <nav class="navbar navbar_custom navbar-expand-lg bg-body-tertiary mt-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
              <img src="{{ asset('assets/user/logotipos/imnas.webp')}}" alt="Logo" width="90"  class="d-inline-block align-text-top">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;margin-left: 7rem;">
              <li class="nav-item">
                <a class="nav-link nav_link_custom active" aria-current="page" href="#">Calendario</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav_link_custom" href="#">Avales</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav_link_custom" href="#">Paquetes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav_link_custom" href="#">Nosotros</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav_link_custom" href="#">Tienda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav_link_custom" href="#">Instalaciones</a>
              </li>
            </ul>

            <div class="d-flex">
                <a class="btn btn-primario me-4" style="font-size: 25px;">
                    Acceso alumnas
                </a>
            </div>

          </div>
        </div>
      </nav>


<div class="row">
    <div class="col-6">
        <h1 class="text-white titulo" style="margin-top: 6rem;">
            Instituto Mexicano <br>
            Naturales Ain Spa
        </h1>
        <p class="text-white parrafo" style="">
            Plataforma número uno de cursos en línea y <br>
            presenciales dedicados a la cosmetología y <br>
            cosmiatría a nivel nacional e internacional.
        </p>
        <div class="d-flex justify-content-start">
            <a class="btn btn-primario me-4">
                Certificaciones
            </a>
            <a class="btn btn-secundario">
                Saber mas
            </a>
        </div>
    </div>

    <div class="col-6">

        <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <div class="d-flex justify-content-center">
                    <div class="card card-custom" style="">
                        <img class="card_image" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body card_body_custom">
                        <h5 class="card-title card_modalidad">Presencial</h5>
                        <h3 class="card_titulo">CURSO DE PIEDRAS CALIENTES</h3>
                        <h4 class="card_date">Jueves 16 de Febrero</h4>

                        <a class="btn btn-primario me-3">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    Comprar ahora
                                </p>
                                <div class="card_bg_btn ">
                                    <i class="fas fa-cart-plus card_icon_btn"></i>
                                </div>
                            </div>
                        </a>

                        <a class="btn btn-secundario me-1">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    Saber mas
                                </p>
                                <div class="card_bg_btn_secundario">
                                    <i class="fas fa-plus card_icon_btn_secundario"></i>
                                </div>
                            </div>
                        </a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                  <div class="card card-custom" style="">
                    <img class="card_image" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" class="card-img-top" alt="...">
                    <div class="card-body card_body_custom">
                      <h5 class="card-title">Presencial</h5>
                      <h3>CURSO DE PIEDRAS CALIENTES</h3>
                      <h4>Jueves 16 de Febrero</h4>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                  <div class="card card-custom" style="">
                    <img class="card_image" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title 2</h5>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
                </div>
            </div>

        </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>

    </div>
</div>

</section>


@endsection
