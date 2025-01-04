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
        <div class="col-12 mt-5">
            <h3 class="text-center Quinsi titulos">Productos Faciales</h3>
            <h2 class="text-center Avenir titulos">Líneas Populares</h2>
            <p class="text-center">
                <img src="{{asset('cosmika/INICIO/ESTRELLAS-DORADAS.png')}}" alt="">
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="container_lineas p-5">
                <div class="mx-auto img_grid" style="background: url('{{ asset('cosmika/inicio/PROTECTOR-BARRA.png') }}') #ffffff00 50% / contain no-repeat; filter: none!important;"></div>
                <h4 class="text-center Avenir text-white title_linea m-0">Linea</h4>
                <h5 class="text-center Quinsi text-white subtitle_linea m-0">Nebulosa</h5>
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
            <div class="col-4">
                <div class="container_lineas p-5">
                    <div class="mx-auto img_grid" style="background: url('{{ asset('cosmika/inicio/PROTECTOR-BARRA.png') }}') #ffffff00 50% / contain no-repeat; filter: none!important;"></div>
                    <h4 class="text-center Avenir text-white title_linea m-0">Linea</h4>
                    <h5 class="text-center Quinsi text-white subtitle_linea m-0">Astros</h5>
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
                <div class="img_container_categorias_popu" style="background: url('{{ asset('cosmika/INICIO/TODO-CHICA.png') }}') #ffffff00 50% / contain no-repeat;"></div>
                <p class="titulo_categorias Avenir">TODO</p>
            </div>
        </div>

        <div class="col-4">
            <div class="container_categorias_popu">
                <div class="img_container_categorias_popu" style="background: url('{{ asset('cosmika/INICIO/FACIAL-CHICA.png') }}') #ffffff00 50% / contain no-repeat;"></div>
                <p class="titulo_categorias Avenir">FACIAL</p>
            </div>
        </div>

        <div class="col-4">
            <div class="container_categorias_popu">
                <div class="img_container_categorias_popu" style="background: url('{{ asset('cosmika/INICIO/CORPORAL-CHICA.png') }}') #ffffff00 50% / contain no-repeat;"></div>
                <p class="titulo_categorias Avenir">CORPORAL</p>
            </div>
        </div>

    </div>
</div>

@endsection

@section('js')

@endsection


