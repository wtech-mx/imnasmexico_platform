@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Inicio
@endsection

@section('css')

@endsection

@section('content')


<div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">

          <div class="carousel-item active">
            <img src="{{ asset('cosmika/inicio/banner/BANNER-4.png') }}" class="d-block w-100" alt="">
          </div>

          <div class="carousel-item ">
            <img src="{{ asset('cosmika/inicio/banner/BANNER-1.png') }}" class="d-block w-100" alt="">
          </div>


          <div class="carousel-item">
            <img src="{{ asset('cosmika/inicio/banner/BANNER-2.png') }}" class="d-block w-100" alt="">
          </div>

          <div class="carousel-item">
            <img src="{{ asset('cosmika/inicio/banner/BANNER-3.png') }}" class="d-block w-100" alt="">
          </div>

          <div class="carousel-item">
            <img src="{{ asset('cosmika/inicio/banner/BANNER-4.png') }}" class="d-block w-100" alt="">
          </div>

          <div class="carousel-item">
            <img src="{{ asset('cosmika/inicio/banner/BANNER-5.png') }}" class="d-block w-100" alt="">
          </div>

          <div class="carousel-item">
            <img src="{{ asset('cosmika/inicio/banner/BANNER-6.png') }}" class="d-block w-100" alt="">
          </div>

          <div class="carousel-item">
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
        <div class="col-12 mt-5 mb-4">
            <h3 class="text-center Quinsi titulos">Productos Faciales</h3>
            <h2 class="text-center Avenir titulos">Líneas Populares</h2>
            <p class="text-center">
                <img src="{{asset('cosmika/inicio/ESTRELLAS-DORADAS.png')}}" alt="">
            </p>
        </div>
    </div>
    <!-- FLECHAS DE NAVEGACIÓN -->
    <div class="d-flex justify-content-between align-items-center">
        <button class="btn-prev-facial"><i class="fa-solid fa-chevron-left"></i></button>
        <div id="facialPopular" class="owl-carousel">

            <div class="item ">
                <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_faciales') }}#pills-nebulosa">
                    <div class="container_lineas_slide">

                        <div class="content mb-3 mt-3">
                            <div class="img_container mx-auto">
                                <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/nebulosa.png') }}" alt="Protector">
                            </div>
                            <h4 class="text-center  Avenir text-white title_linea m-0">Líneas</h4>
                            <h5 class="text-center  Quinsi text-white subtitle_linea m-0">NEBULOSA</h5>
                        </div>

                    </div>
                </a>
            </div>

            <div class="item">
                <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_faciales') }}#pills-constelacion">
                    <div class="container_lineas_grid">

                        <div class="content mb-3 mt-3">
                            <div class="img_container mx-auto">
                                <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/constelacion.png') }}" alt="Protector">
                            </div>
                            <h4 class="text-center  Avenir color_2 title_linea m-0">Líneas</h4>
                            <h5 class="text-center Quinsi color_2 subtitle_linea m-0">CONSTELACION</h5>
                        </div>

                    </div>
                </a>
            </div>

            <div class="item ">
                <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_faciales') }}#pills-venus">
                    <div class="container_lineas_slide">

                        <div class="content mb-3 mt-3">
                            <div class="img_container mx-auto">
                                <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/producto-6.png') }}" alt="Protector">
                            </div>
                            <h4 class="text-center  Avenir text-white title_linea m-0">Líneas</h4>
                            <h5 class="text-center  Quinsi text-white subtitle_linea m-0">VENUS</h5>
                        </div>

                    </div>
                </a>
            </div>

            <div class="item ">
                <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_faciales') }}#pills-espectro">
                    <div class="container_lineas_grid">

                        <div class="content mb-3 mt-3">
                            <div class="img_container mx-auto">
                                <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/producto-4.png') }}" alt="Protector">
                            </div>
                            <h4 class="text-center  Avenir color_2 title_linea m-0">Líneas</h4>
                            <h5 class="text-center  Quinsi color_2 subtitle_linea m-0">ESPECTRO</h5>
                        </div>

                    </div>
                </a>
            </div>

            <div class="item">
                <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_faciales') }}#pills-mascarillas">
                    <div class="container_lineas_slide">

                        <div class="content mb-3 mt-3">
                            <div class="img_container mx-auto">
                                <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/producto-5.png') }}" alt="Protector">
                            </div>
                            <h4 class="text-center  Avenir text-white title_linea m-0">Líneas</h4>
                            <h5 class="text-center Quinsi text-white subtitle_linea m-0">ESTELAR</h5>
                        </div>

                    </div>
                </a>
            </div>

            <div class="item">
                <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_faciales') }}#pills-pluton">
                    <div class="container_lineas_grid">

                        <div class="content mb-3 mt-3">
                            <div class="img_container mx-auto">
                                <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/producto_13.png') }}" alt="Protector">
                            </div>
                            <h4 class="text-center  Avenir color_2 title_linea m-0">Líneas</h4>
                            <h5 class="text-center Quinsi color_2 subtitle_linea m-0">PLUTÓN</h5>
                        </div>

                    </div>
                </a>
            </div>

            <div class="item">
                <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_faciales') }}#pills-solar">
                    <div class="container_lineas_slide">

                        <div class="content mb-3 mt-3">
                            <div class="img_container mx-auto">
                                <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/producto-7.png') }}" alt="Protector">
                            </div>
                            <h4 class="text-center  Avenir text-white title_linea m-0">Líneas</h4>
                            <h5 class="text-center Quinsi text-white subtitle_linea m-0">SOLAR</h5>
                        </div>

                    </div>
                </a>
            </div>

            <div class="item">
                <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_faciales') }}#pills-lunar">
                    <div class="container_lineas_grid">

                        <div class="content mb-3 mt-3">
                            <div class="img_container mx-auto">
                                <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/producto-3.png') }}" alt="Protector">
                            </div>
                            <h4 class="text-center  Avenir color_2 title_linea m-0">Líneas</h4>
                            <h5 class="text-center Quinsi color_2 subtitle_linea m-0">LUNAR</h5>
                        </div>

                    </div>
                </a>
            </div>

                <div class="item">
                    <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_corporales') }}#pills-pure">
                        <div class="container_lineas_slide">
                            <div class="content mb-3 mt-3">
                                <div class="img_container mx-auto">
                                    <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/pure.png') }}" alt="Protector">
                                </div>
                                <h4 class="text-center  Avenir text-white  title_linea m-0">Líneas</h4>
                                <h5 class="text-center Quinsi text-white  subtitle_linea m-0">Pure</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="item">
                    <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_corporales') }}#pills-rose">
                        <div class="container_lineas_grid">
                            <div class="content mb-3 mt-3">
                                <div class="img_container mx-auto">
                                    <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/caviar.png') }}" alt="Protector">
                                </div>
                                <h4 class="text-center  Avenir color_2 title_linea m-0">Líneas</h4>
                                <h5 class="text-center Quinsi color_2 subtitle_linea m-0">Rose Caviar</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="item">
                    <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_corporales') }}#pills-lumina">
                        <div class="container_lineas_slide">
                            <div class="content mb-3 mt-3">
                                <div class="img_container mx-auto">
                                    <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/lumina.png') }}" alt="Protector">
                                </div>
                                <h4 class="text-center  Avenir text-white color_2 title_linea m-0">Línea</h4>
                                <h5 class="text-center Quinsi text-white color_2 subtitle_linea m-0">Lumina</h5>
                            </div>
                        </div>
                    </a>
                </div>

        </div>
        <button class="btn-next-facial"><i class="fa-solid fa-chevron-right"></i></button>
    </div>


    <div class="row">
            <div class="col-12 mt-5">
                <h3 class="text-center Quinsi titulos">Productos Corporales</h3>
                <h2 class="text-center Avenir titulos">Líneas Populares</h2>
                <p class="text-center">
                    <img src="{{asset('cosmika/inicio/ESTRELLAS-DORADAS.png')}}" alt="">
                </p>
            </div>
    </div>

        <!-- FLECHAS DE NAVEGACIÓN -->
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn-prev-corporal"><i class="fa-solid fa-chevron-left"></i></button>
            <div id="corporalPopular" class="owl-carousel">

                <div class="item ">
                    <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_corporales') }}#pills-renacer">
                        <div class="container_lineas_slide">
                            <div class="content mb-3 mt-3">
                                <div class="img_container mx-auto">
                                    <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/producto-1.png') }}" alt="Protector">
                                </div>
                                <h4 class="text-center  Avenir text-white title_linea m-0">Líneas</h4>
                                <h5 class="text-center  Quinsi text-white subtitle_linea m-0">RENACER</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="item">
                    <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_corporales') }}#pills-esencia">
                        <div class="container_lineas_grid">
                            <div class="content mb-3 mt-3">
                                <div class="img_container mx-auto">
                                    <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/esencial.png') }}" alt="Protector">
                                </div>
                                <h4 class="text-center  Avenir color_2 title_linea m-0">Líneas</h4>
                                <h5 class="text-center Quinsi color_2 subtitle_linea m-0">Esencia Vital</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="item">
                    <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_corporales') }}#pills-flash">
                        <div class="container_lineas_grid">
                            <div class="content mb-3 mt-3">
                                <div class="img_container mx-auto">
                                    <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/producto-9.png') }}" alt="Protector">
                                </div>
                                <h4 class="text-center  Avenir color_2 title_linea m-0">Líneas</h4>
                                <h5 class="text-center Quinsi color_2 subtitle_linea m-0">FLASH</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="item ">
                    <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_corporales') }}#pills-astros">
                        <div class="container_lineas_slide">
                            <div class="content mb-3 mt-3">
                                <div class="img_container mx-auto">
                                    <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/producto-8.png') }}" alt="Protector">
                                </div>
                                <h4 class="text-center  Avenir text-white title_linea m-0">Líneas</h4>
                                <h5 class="text-center  Quinsi text-white subtitle_linea m-0">ASTROS</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="item">
                    <a style="color:#2D2432;text-decoration: none;" href="{{ route('tienda.productos_corporales') }}#pills-galaxia">
                        <div class="container_lineas_grid">
                            <div class="content mb-3 mt-3">
                                <div class="img_container mx-auto">
                                    <img class="img_grid_products" src="{{ asset('cosmika/inicio/lineas/producto-10.png') }}" alt="Protector">
                                </div>
                                <h4 class="text-center  Avenir color_2 title_linea m-0">Líneas</h4>
                                <h5 class="text-center Quinsi color_2 subtitle_linea m-0">GALAXIA</h5>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <button class="btn-next-corporal"><i class="fa-solid fa-chevron-right"></i></button>
        </div>

</div>

<div class="container-fluid d-flex align-items-center justify-content-between container_encabezado mt-5 mb-4">
    <hr class="flex-grow-1 mx-3 hr_categorie    s" style="">
    <h1 class="me-5 Avenir title_categories">Categorias Populares</h1>
</div>

<div class="container-xs container-lg">
    <div class="row">

        <div class="col-4 p-0 p-sm-0 p-md-2">
            <a href="{{ route('tienda.productos') }}" class="d-block text-decoration-none">
                <div class="container_categorias_popu">
                    <div class="img_container_categorias_popu" style="background: url('{{ asset('cosmika/inicio/TODO-CHICA.png') }}') #ffffff00 50% / cover no-repeat;"></div>
                    <p class="titulo_categorias Avenir">TODO</p>
                </div>
            </a>
        </div>

        <div class="col-4 p-0 p-sm-0 p-md-2">
            <a href="{{ route('tienda.productos_faciales') }}" class="d-block text-decoration-none">
                <div class="container_categorias_popu">
                    <div class="img_container_categorias_popu" style="background: url('{{ asset('cosmika/inicio/FACIAL-CHICA.png') }}') #ffffff00 50% / cover no-repeat;"></div>
                    <p class="titulo_categorias Avenir">FACIAL</p>
                </div>
            </a>
        </div>

        <div class="col-4 p-0 p-sm-0 p-md-2">
            <a href="{{ route('tienda.productos_corporales') }}" class="d-block text-decoration-none">
                <div class="container_categorias_popu">
                    <div class="img_container_categorias_popu" style="background: url('{{ asset('cosmika/inicio/CORPORAL-CHICA.png') }}') #ffffff00 50% / cover no-repeat;"></div>
                    <p class="titulo_categorias Avenir">CORPORAL</p>
                </div>
            </a>
        </div>

    </div>
</div>

{{-- <section class="category-banner my-auto mt-3 mt-md-5 mt-lg-5 mb-3 mb-md-5 mb-lg-5" style="background-image: url('{{ asset('cosmika/inicio/FONDO-ESENCIAS.png') }}')">
    <div class="overlay"></div>

    <div class="row">
        <div class="col-3">
            <img class="img_portada_linea_esencial" src="{{ asset('cosmika/inicio/esencias.png') }}" alt="">
        </div>

        <div class="col-9 ">
            <div class="container text-center">
                <h1 class="Avenir h1_portada_linea_esencial m-0 mt-5">Línea</h1>
                <h3 class="Quinsi h3_portada_linea_esencial m-0">Esencial Vital</strong></h3>
                <a href="{{ route('tienda.productos_corporales') }}#pills-esencia" class="Quinsi btn btn_portada_linea_esencial">Comprar ahora</a>
            </div>
        </div>
    </div>
</section> --}}

<div id="carouselLinea" class="carousel slide">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <a href="https://cosmicaskin.com/tienda/kits/1849" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('cosmika/inicio/banner/banner-9.png') }}" class="d-block w-100" alt="">
        </a>
      </div>
    </div>
  </div>
</div>

<div class="container_fluid bg_gradiente_all_linea">
    <div class="row">
        <div class="col-12">
            <p class="text-center mt-5">
                <img class="img_gradiente_all_linea" src="{{ asset('cosmika/inicio/PRODUCTOS-NNUEVA-MARCA-MEXICANA.png') }}" alt="">
            </p>
            <h6 class="text-center Quinsi h6_all_gradient">¡Nueva Marca mexicana!</h6>
            <h5 class="text-center Avenir h5_all_gradient">Compra toda la linea y <br> recibe un super descuento </h5>
            <p class="text-center  mt-4">
                <a href="https://cosmicaskin.com/tienda/kits/1849" class="Quinsi btn btn_all_gradient">Comprar ahora</a>
            </p>
        </div>
    </div>
</div>

<div class="container">

    @include('tienda_cosmica.Components.productos_populares')

</div>

<div id="carouselKits" class="carousel slide">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <a href="{{ route('tienda.kits') }}" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('cosmika/inicio/banner/banner-8.png') }}" class="d-block w-100" alt="">
        </a>
      </div>
    </div>
  </div>
</div>


<div id="carouselLumina" class="carousel slide">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <a href="{{ route('tienda.productos_faciales') }}#pills-lumina" rel="noopener noreferrer">
            <img src="{{ asset('cosmika/inicio/banner/linea_lumina.png') }}" class="d-block w-100" alt="">
        </a>
      </div>
    </div>
  </div>
</div>


<div id="carouselExampleMeli" class="carousel slide">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <a href="https://perfil.mercadolibre.com.mx/COSMICA_SKIN" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('cosmika/inicio/MERCADO-LIBRE.png') }}" class="d-block w-100" alt="">
        </a>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid position-relative mt-5">
    <!-- Capa de fondo -->
    <div class="background-image" style="background-image: url('{{ asset('cosmika/inicio/NUEVAS-LINEAS.png') }}');"></div>

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
                <a href="{{ route('tienda.productos_corporales') }}#pills-rose" class="btn btn_caviar_linea">Explorar Línea</a>
            </p>
        </div>
    </div>
</div>

@endsection

@section('js')

@endsection


