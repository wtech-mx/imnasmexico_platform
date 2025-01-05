@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Inicio
@endsection

@section('css')

@endsection


@section('content')

<div class="container-fluid p-0">
    <div id="carouelExample" class="carousel slide">

        <div class="carousel-inner img_banners">
            <div class="carousel-item active ">
                {{-- <img src="{{ asset('cosmika/INICIO/IMAGEN-1_compuesta.png') }}" class="d-block w-100" alt=""> --}}
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
        <div class="col-12 mt-5 mb-4">
            <h3 class="text-center Quinsi titulos">Productos Faciales</h3>
            <h2 class="text-center Avenir titulos">Líneas Populares</h2>
            <p class="text-center">
                <img src="{{asset('cosmika/INICIO/ESTRELLAS-DORADAS.png')}}" alt="">
            </p>
        </div>
    </div>

    <div class="row ">
        <div class="col-6 col-md-4 col-lg-3 mb-4 ">
            <div class="container_lineas_slide">

                <div class="content mb-3 mt-3">
                    <div class="img_container mx-auto">
                        <img class="img_grid_products" src="{{ asset('cosmika/inicio/nebulosa.png') }}" alt="Protector">
                    </div>
                    <h4 class="text-center  Avenir text-white title_linea m-0">Linea</h4>
                    <h5 class="text-center  Quinsi text-white subtitle_linea m-0">NEBULOSA</h5>
                </div>

            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="container_lineas_grid">

                <div class="content mb-3 mt-3">
                    <div class="img_container mx-auto">
                        <img class="img_grid_products" src="{{ asset('cosmika/inicio/constelacion.png') }}" alt="Protector">
                    </div>
                    <h4 class="text-center  Avenir color_2 title_linea m-0">Linea</h4>
                    <h5 class="text-center Quinsi color_2 subtitle_linea m-0">CONSTELACION</h5>
                </div>

            </div>
        </div>

    </div>

    <div class="row">
            <div class="col-12 mt-5">
                <h3 class="text-center Quinsi titulos">Productos Corporales</h3>
                <h2 class="text-center Avenir titulos">Líneas Populares</h2>
                <p class="text-center">
                    <img src="{{asset('cosmika/INICIO/ESTRELLAS-DORADAS.png')}}" alt="">
                </p>
            </div>

    </div>

    <div class="row">

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="container_lineas_grid">

                <div class="content mb-3 mt-3">
                    <div class="img_container mx-auto">
                        <img class="img_grid_products" src="{{ asset('cosmika/inicio/protector.png') }}" alt="Protector">
                    </div>
                    <h4 class="text-center  Avenir color_2 title_linea m-0">Linea</h4>
                    <h5 class="text-center Quinsi color_2 subtitle_linea m-0">Astros</h5>
                </div>

            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4 ">
            <div class="container_lineas_slide">

                <div class="content mb-3 mt-3">
                    <div class="img_container mx-auto">
                        <img class="img_grid_products" src="{{ asset('cosmika/inicio/protector.png') }}" alt="Protector">
                    </div>
                    <h4 class="text-center  Avenir text-white title_linea m-0">Linea</h4>
                    <h5 class="text-center  Quinsi text-white subtitle_linea m-0">Astros</h5>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="container-fluid d-flex align-items-center justify-content-between container_encabezado mt-5 mb-4">
    <hr class="flex-grow-1 mx-3 hr_categories" style="">
    <h1 class="me-5 Avenir title_categories">Categorias Populares</h1>
</div>

<div class="container">
    <div class="row">

        <div class="col-4">
            <div class="container_categorias_popu">
                <div class="img_container_categorias_popu" style="background: url('{{ asset('cosmika/INICIO/TODO-CHICA.png') }}') #ffffff00 50% / cover no-repeat;"></div>
                <p class="titulo_categorias Avenir">TODO</p>
            </div>
        </div>

        <div class="col-4">
            <div class="container_categorias_popu">
                <div class="img_container_categorias_popu" style="background: url('{{ asset('cosmika/INICIO/FACIAL-CHICA.png') }}') #ffffff00 50% / cover no-repeat;"></div>
                <p class="titulo_categorias Avenir">FACIAL</p>
            </div>
        </div>

        <div class="col-4">
            <div class="container_categorias_popu">
                <div class="img_container_categorias_popu" style="background: url('{{ asset('cosmika/INICIO/CORPORAL-CHICA.png') }}') #ffffff00 50% / cover no-repeat;"></div>
                <p class="titulo_categorias Avenir">CORPORAL</p>
            </div>
        </div>

    </div>
</div>

<section class="category-banner my-auto mt-5" style="background-image: url('{{ asset('cosmika/INICIO/FONDO-ESENCIAS.png') }}')">
    <div class="overlay"></div>

    <div class="row">
        <div class="col-3">
            <img class="img_portada_linea_esencial" src="{{ asset('cosmika/INICIO/ESENCIAS.png') }}" alt="">
        </div>

        <div class="col-9 ">
            <div class="container text-center">
                <h1 class="Avenir h1_portada_linea_esencial m-0 mt-5">Línea</h1>
                <h3 class="Quinsi h3_portada_linea_esencial m-0">Esencial Vital</strong></h3>
                <a href="" class="Quinsi btn btn_portada_linea_esencial">Comprar ahora</a>
            </div>
        </div>
    </div>
</section>

<div class="container_fluid bg_gradiente_all_linea">
    <div class="row">
        <div class="col-12">
            <p class="text-center mt-5">
                <img class="img_gradiente_all_linea" src="{{ asset('cosmika/INICIO/PRODUCTOS-NNUEVA-MARCA-MEXICANA.png') }}" alt="">
            </p>
            <h6 class="text-center Quinsi h6_all_gradient">¡Nueva Marca mexicana!</h6>
            <h5 class="text-center Avenir h5_all_gradient">Compra toda la linea y <br> recibe un super descuento </h5>
            <p class="text-center  mt-4">
                <a href="" class="Quinsi btn btn_all_gradient">Comprar ahora</a>
            </p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3 class="text-center Quinsi titulos">Cósmica Skin</h3>
            <h2 class="text-center Avenir titulos">Productos Populares</h2>
            <p class="text-center">
                <img src="{{asset('cosmika/INICIO/ESTRELLAS-DORADAS.png')}}" alt="">
            </p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="container_lineas_grid">

                <div class="content">
                    <div class="icon_heart">
                        <div class="d-flex justify-content-start">
                            <img class="icon_card_product_grid" src="{{ asset('cosmika/inicio/CORAZON-POPULARES.png') }}" alt="">
                        </div>
                    </div>
                    <div class="img_container mx-auto">
                        <img class="img_grid_products" src="{{ asset('cosmika/inicio/protector.png') }}" alt="Protector">
                    </div>
                    <h4 class="text-center Avenir color_2 title_lineagrid m-0">Protector</h4>
                    <h5 class="text-center Avenir color_2 subtitle_lineagrid m-0">Solar 50 fps</h5>
                    <p class="text-center">
                        <a href="" class="btn btn_plus_grid">
                            <img class="img_btn_plus_grid" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="">
                        </a>
                    </p>
                </div>

            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="container_lineas_grid">

                <div class="content">
                    <div class="icon_heart">
                        <div class="d-flex justify-content-start">
                            <img class="icon_card_product_grid" src="{{ asset('cosmika/inicio/CORAZON-POPULARES.png') }}" alt="">
                        </div>
                    </div>
                    <div class="img_container mx-auto">
                        <img class="img_grid_products" src="{{ asset('cosmika/inicio/serum.png') }}" alt="Protector">
                    </div>
                    <h4 class="text-center Avenir color_2 title_lineagrid m-0">Protector</h4>
                    <h5 class="text-center Avenir color_2 subtitle_lineagrid m-0">Solar 50 fps</h5>
                    <p class="text-center">
                        <a href="" class="btn btn_plus_grid">
                            <img class="img_btn_plus_grid" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="">
                        </a>
                    </p>
                </div>

            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="container_lineas_grid">

                <div class="content">
                    <div class="icon_heart">
                        <div class="d-flex justify-content-start">
                            <img class="icon_card_product_grid" src="{{ asset('cosmika/inicio/CORAZON-POPULARES.png') }}" alt="">
                        </div>
                    </div>
                    <div class="img_container mx-auto">
                        <img class="img_grid_products" src="{{ asset('cosmika/inicio/mascarilla.png') }}" alt="Protector">
                    </div>
                    <h4 class="text-center Avenir color_2 title_lineagrid m-0">Mascarill</h4>
                    <h5 class="text-center Avenir color_2 subtitle_lineagrid m-0">Solar 50 fps</h5>
                    <p class="text-center">
                        <a href="" class="btn btn_plus_grid">
                            <img class="img_btn_plus_grid" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="">
                        </a>
                    </p>
                </div>

            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="container_lineas_grid">

                <div class="content">
                    <div class="icon_heart">
                        <div class="d-flex justify-content-start">
                            <img class="icon_card_product_grid" src="{{ asset('cosmika/inicio/CORAZON-POPULARES.png') }}" alt="">
                        </div>
                    </div>
                    <div class="img_container mx-auto">
                        <img class="img_grid_products" src="{{ asset('cosmika/inicio/protector.png') }}" alt="Protector">
                    </div>
                    <h4 class="text-center Avenir color_2 title_lineagrid m-0">Protector</h4>
                    <h5 class="text-center Avenir color_2 subtitle_lineagrid m-0">Solar 50 fps</h5>
                    <p class="text-center">
                        <a href="" class="btn btn_plus_grid">
                            <img class="img_btn_plus_grid" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="">
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="container-fluid horizontal-banner" style="background-image: url('{{ asset('cosmika/INICIO/MERCADO-LIBRE.png') }}'); /* Cambia por tu imagen */">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            {{-- <div class="banner-content text-center">
                <h2 class="banner-title">¡Promoción Especial!</h2>
                <p class="banner-subtitle">Aprovecha nuestras ofertas exclusivas por tiempo limitado</p>
            </div> --}}
        </div>
    </div>
</div>

<div class="container-fluid position-relative mt-5">
    <!-- Capa de fondo -->
    <div class="background-image" style="background-image: url('{{ asset('cosmika/INICIO/NUEVAS-LINEAS.png') }}');"></div>

    <!-- Capa superior con contenido -->
    <div class="overlay-content d-flex align-items-center justify-content-center">
        <div class="content-blur text-center p-5">
            <h2 class="Avenir h2_linea_caviar">Líneas</h2>
            <h3 class="Quinsi h3_linea_caviar">Caviar Rose Lux y <br>Esencial Vital</h3>
            <p class="Avenir p_linea_caviar">
                Representa el equilibrio perfecto entre lujo y ciencia. Diseñada con tecnología avanzada y activos únicos,
                esta colección redefine el cuidado de la piel al fusionar ingredientes premium con innovación dermocosmética.
            </p>
            <p>
                <a href="#" class="btn btn_caviar_linea">Explorar Línea</a>
            </p>
        </div>
    </div>
</div>

<div class="container-fluid bg_footer">
    <div class="row">
        <div class="col-12  mt-3 mt-md-5 mt-lg-5 mb-0 mb-md-5 mb-lg-5">
            <div class="conatainer_text_starts">
                <p class="text-white texto_footer_principal SwilyBright_Italic text-center">
                    <img src="{{ asset('cosmika/INICIO/estrellas_2.png') }}" alt="" class="img_estrellas_footer">
                    Que tu piel <strong class="Christmas">brille</strong> <br> como las estrellas en el cosmos.
                    <img src="{{ asset('cosmika/INICIO/estrellas_2.png') }}" alt="" class="img_estrellas_footer">
                </p>
                <p class="text-center text-white">- Cósmica Skin</p>
                <p class="text-center">
                    <img src="{{ asset('cosmika/INICIO/fb.png') }}" alt="" class="img_estrellas_footer">
                    <img src="{{ asset('cosmika/INICIO/ig.png') }}" alt="" class="img_estrellas_footer">
                    <img src="{{ asset('cosmika/INICIO/wp.png') }}" alt="" class="img_estrellas_footer">

                </p>
            </div>
        </div>
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center ">
    <div class="col">

    </div>

    <div class="col-10 ">
        <div class="row mt-4">
            <div class="text-white col-6 col-12-sm-12 col-lg-4 mb-3">
                <h5 class="text-white text-center mb-3 mt-3">Paginas</h5>
                <ul class="text-white nav flex-column" style="align-items: center;">
                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">
                        <i class="text-white bi bi-envelope"></i> Inicio</a>
                    </li>

                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">
                        <i class="text-white bi bi-whatsapp"></i> Categorias</a>
                    </li>

                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">
                        <i class="text-white bi bi-instagram"></i> Productos</a>
                    </li>

                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">
                        <i class="text-white bi bi-facebook"></i> Sobre Nosotros</a>
                    </li>

                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">
                        <i class="text-white bi bi-youtube"></i> Distribuidoras</a>
                    </li>

                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">
                        <i class="text-white bi bi-youtube"></i> Profesionales</a>
                    </li>

                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">
                        <i class="text-white bi bi-youtube"></i> Contacto</a>
                    </li>

                </ul>
            </div>

            <div class="text-white col-6 col-12-sm-12 col-lg-4 mb-3">
                <h5 class="text-white text-center mb-3 mt-3">Contacto</h5>
                <ul class="text-white nav flex-column" style="align-items: center;">
                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">Terminos y Condiciones</a>
                    </li>

                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">Aviso de Provacidad</a>
                    </li>

                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">5637540093</a>
                    </li>

                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">Castilla 136, Álamos, Benito Juarez, 03400</a>
                    </li>

                    <li class="text-white nav-item mb-2">
                        <a href="#" class="text-white nav-link p-0">FAQS</a>
                    </li>
                </ul>
            </div>

            <div class="text-white col-12 col-12-sm-12 col-lg-4 mb-3">
                <h5 class="text-white text-center mb-3 mt-3">Formas de pago</h5>
                <div class="row">

                    <div class="col-6">
                        <p class="text-center ">
                            <img src="{{ asset('cosmika/INICIO/camion.png') }}" alt="" class="img_icon_footer">
                        </p>

                        <a href="#" class="text-white text-center nav-link p-0 subtitle_footer mt-3">
                            Aprovecha el beneficio del envío gratis
                        </a>

                        <p class="text-center p_title_footer mt-3">
                            Aplica en compras a partir de +$2,000. Suma todo lo que quieras al carrito
                        </p>

                        <p class="text-center">
                            <img src="{{ asset('cosmika/INICIO/tienda.png') }}" alt="" class="img_icon_footer">
                        </p>
                    </div>

                    <div class="col-6">
                        <p class="text-center">
                            <img src="{{ asset('cosmika/INICIO/tarjeta.png') }}" alt="" class="img_icon_footer">
                        </p>

                        <a href="#" class="text-white text-center nav-link p-0 subtitle_footer mt-3">
                            Elige tu medio de pago favorito
                        </a>

                        <p class="text-center p_title_footer mt-3">
                            Paga con tarjeta o en efectivo. Tu dinero está protegido con Mercado Pago.
                        </p>

                        <p class="text-center">
                            <img src="{{ asset('cosmika/INICIO/mercado lib.png') }}" alt="" class="img_icon_footer">
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col">

    </div>

    </footer>
</div>


@endsection

@section('js')

@endsection


