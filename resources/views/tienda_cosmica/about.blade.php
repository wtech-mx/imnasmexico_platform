@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Sobre Nosotros
@endsection

@section('body_custom')
    bg_single_product
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/ecommerce_about.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('cosmika/inicio/banner/BANNER-7.png') }}" class="d-block w-100" alt="">
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


<div class="container">

    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <h3 class="text-center titulo_hola mt-5">¡HOLA!</h3>
            <h2 class="text-center subtitulo_somos">
                SOMOS
            </h2>
            <p class="text-center">
                <img class="text-center img_logo" src="{{ asset('cosmika/logo_2.png') }}" alt="">
            </p>
            <h4 class="text-center h4_subtitle">Cosmica Skincare es más que una marca.</h4>
            <p class="text-center parrafo_about">
                Es una experiencia que conecta a las personas con la majestuosidad del
                cosmos a través del cuidado consciente de la piel. <br><br>
                Con cada producto, invitamos a nuestros clientes a celebrar su belleza natural
                y a brillar como las estrellas en el cosmos
            </p>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-auto">
            <p class="text-center">
                <img class="img_about" src="{{ asset('cosmika/about/IMAGEN-2.png') }}" alt="imagen equipo cosmica" >
            </p>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-auto order-last order-sm-first">
            <p class="text-center">
                <img class="img_about" src="{{ asset('cosmika/about/IMAGEN-3.png') }}" alt="imagen equipo cosmica" >
            </p>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-auto order-first order-sm-last">
            <h3 class="text-center subtitulo_somos">NUESTRA <br>VISIÓN</h3>
            <p class="parrafo_about text-center">
                Cosmica Skincare nace en el corazón
                de México con la misión de
                transformar el cuidado de la piel a
                través de la sabiduría de la
                naturaleza y los principios
                macrobióticos. <br><br>
                Nuestra visión es convertirnos en un
                referente de belleza y salud integral,
                integrando ingredientes naturales y
                técnicas ancestrales en productos
                que cuiden, protejan y rejuvenezcan
                la piel.
            </p>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <h3 class="text-center subtitulo_somos">NUESTRA <br>FILOSOFÍA</h3>
            <p class="parrafo_about text-center">
                Inspirados por la riqueza natural y cultural de México, Cosmica
                Skincare utiliza ingredientes endémicos de las regiones más fértiles
                del país, fusionados con principios macrobióticos que equilibran el
                cuerpo y el espíritu. <br><br>
                Cada producto es una sinfonía de elementos puros que promueven
                el bienestar desde el exterior hacia el interior, reflejando la belleza
                celestial del cosmos
            </p>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-auto">
            <p class="texto_about_principal SwilyBright_Italic text-center">
                <img src="{{ asset('cosmika/INICIO/estrellas_2.png') }}" alt="" class="img_estrellas_about">
                Que tu piel <span class="Christmas">brille</span> <br> como las estrellas en el cosmos.
                <img src="{{ asset('cosmika/INICIO/estrellas_2.png') }}" alt="" class="img_estrellas_about">
            </p>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-auto order-last order-sm-first">
            <p class="text-white texto_footer_principal SwilyBright_Italic text-center">
                <img class="img_about" src="{{ asset('cosmika/about/IMAGEN-4.png') }}" alt="imagen equipo cosmica" >
            </p>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-auto order-first order-sm-last">

            <h3 class="text-center subtitulo_somos">
                PROMOCIÓN <br> DE LA SALUD <br> INTEGRRAL
            </h3>
            <p class="parrafo_about text-center">
                Creemos que el cuidado de la piel es una extensión del
                cuidado del alma. Por ello, Cosmica organiza workshops que
                enseñan a los participantes cómo integrar prácticas de
                bienestar en su rutina diaria, combinando meditación,
                alimentación macrobiótica y rutinas de skincare.
            </p>
        </div>

    </div>

</div>


@endsection

@section('js')

@endsection


