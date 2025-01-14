@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Single Product
@endsection

@section('body_custom')
    bg_single_product
@endsection


@section('css')

@endsection

@section('content')

<div class="container ">

    <div class="row">
        <div class="col-12">
            <h2 class="text-center mt-5 m-5"><strong>< Seguir</strong> Comprando</h2>
        </div>

        <div class="col-4 p-3">

            <div class="container_lineas_single">
                <div class="content mb-3 mt-3">
                    <div class="img_container_single mx-auto">
                        <img class="img_grid_products_single" src="{{ asset('cosmika/inicio/lineas/producto_4.png') }}" alt="Protector">
                    </div>
                </div>
            </div>

            <p class="text-center mt-4">
                <img src="{{asset('cosmika/INICIO/ESTRELLAS-DORADAS.png')}}" alt="">
            </p>
        </div>

        <div class="col-8 p-5">

            <h1 class="text-center"><strong>Sérum</strong> Hialurónico</h1>

            <div class="container_price mb-5 mt-4">
                <div class="d-flex justify-content-around">
                    <h2 class="my-auto">$550.0</h2>
                    <p class="my-auto">1
                        <a href="" class="">
                            <img class="icon_plus_cantidad" src="{{ asset('cosmika/INICIO/AGREGAR-POPULARES.png') }}" alt="Carrito">
                        </a>
                    </p>
                    <a href="" class="btn btn_shop my-auto">Comprar
                        <img class="img_btn_shop" src="{{ asset('cosmika/menu/BOLSA-DE-COMPRA.png') }}" alt="Carrito">
                    </a>
                </div>
            </div>

            <div class="contaner_details">
                <h3>Detalles</h3>
                <p>El Serum de ácido Hialurónico aporta volumen, además de reducir las arrugas y disimular
                    las líneas de expresión y revitalizar las capas superficiales externas de la piel.
                </p>
                <h4>MODO DE EMPLEO:</h4>
                <p>luego masajee suavemente hasta su total absorción, para obtener el mejor efecto de
                    cuidado de la piel.
                </p>
                <h4>BENEFICIOS</h4>
                <p>Combate líneas de expresión y manchas mantiene una piel rejuvenecida e
                    hidratada.
                </p>
                <h5>INGREDIENTES</h5>
                <p>
                    AGUA DESMINERALIZADA, ALCOHOL, GLICERINA, GLICOL DE
                    PROPILENO, ÁCIDO HIALURÓNICO, ACETILADO DE SODIO, ÁCIDO HIALURONICO,
                    COLÁGENO HIDROLIZADO, ELASTINA, SILICIO, FRAGANCIA, FENOXIETANOL Y
                    ETILHEXILGLICERINA.
                </p>
                <h5><strong>PRODUCTO DE USO COSMÉTICO.</strong></h5>
                <h4>PRECAUCIONES:</h4>
                Si presenta irritación, enrojecimiento o alguna molestia, suspenda el uso y acuda al médico.
                No se deje al alcance de los niños. Manténgase en lugar seco y fresco
            </div>

        </div>

        <div class="col-4"></div>
        <div class="col-4 text-center">

            <div class="container_lineas_single">
                <a href="" class="text_shop_single">
                    $550.00 MXN Agregar
                </a>
            </div>
        </div>
        <div class="col-4"></div>


    </div>

    <div class="row">
        <div class="col-12">
            <h4 class="title_product_populares text-center mt-5 mb-5">Pensamos que te podría interesar</h4>
        </div>
    </div>

    <div class="row">

        <div class="col-4">

            <div class="container_lineas_single mx-auto" style="width:80%; ">
                <div class="content mb-3 mt-3">
                    <div class="img_container_single mx-auto">
                        <img class="img_grid_products_single" src="{{ asset('cosmika/inicio/lineas/producto_4.png') }}" alt="Protector">
                    </div>
                </div>
            </div>
            <h2 class="text-center">
                <strong>Shampoo Facial</strong> <br>
                con Vitaminas 125 ml
            </h2>
            <h4 class="text-center">
                $200.00
            </h4>
            <p class="text-center">

                <a href="" class="text-center mt-3">
                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/CORAZON-POPULARES.png') }}" alt="">
                </a>
            </p>
            <p class="text-center">

                <a href="" class="text-center mt-3">
                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="">
                </a>
            </p>

        </div>

        <div class="col-4">

            <div class="container_lineas_single mx-auto" style="width:80%; ">
                <div class="content mb-3 mt-3">
                    <div class="img_container_single mx-auto">
                        <img class="img_grid_products_single" src="{{ asset('cosmika/inicio/lineas/producto_4.png') }}" alt="Protector">
                    </div>
                </div>
            </div>
            <h2 class="text-center">
                <strong>Shampoo Facial</strong> <br>
                con Vitaminas 125 ml
            </h2>
            <h4 class="text-center">
                $200.00
            </h4>
            <p class="text-center">

                <a href="" class="text-center mt-3">
                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/CORAZON-POPULARES.png') }}" alt="">
                </a>
            </p>
            <p class="text-center">

                <a href="" class="text-center mt-3">
                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="">
                </a>
            </p>

        </div>

        <div class="col-4">

            <div class="container_lineas_single mx-auto" style="width:80%; ">
                <div class="content mb-3 mt-3">
                    <div class="img_container_single mx-auto">
                        <img class="img_grid_products_single" src="{{ asset('cosmika/inicio/lineas/producto_4.png') }}" alt="Protector">
                    </div>
                </div>
            </div>
            <h2 class="text-center">
                <strong>Shampoo Facial</strong> <br>
                con Vitaminas 125 ml
            </h2>
            <h4 class="text-center">
                $200.00
            </h4>
            <p class="text-center">

                <a href="" class="text-center mt-3">
                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/CORAZON-POPULARES.png') }}" alt="">
                </a>
            </p>
            <p class="text-center">

                <a href="" class="text-center mt-3">
                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="">
                </a>
            </p>

        </div>

    </div>

    @include('tienda_cosmica.Components.productos_populares')


</div>


@endsection

@section('js')

@endsection


