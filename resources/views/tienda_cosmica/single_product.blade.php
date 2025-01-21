@extends('layouts.app_tienda_cosmica')

@section('template_title')
    {{$product->nombre}}
@endsection

@section('body_custom')
    bg_single_product
@endsection


@section('css_custom')
    <link href="{{asset('assets/user/custom/ecommerce_single.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="container ">

    <div class="row">
        <div class="col-12">
            <h2 class="text-center tittle_single mt-3 mt-sm-2 mt-md-3 mt-lg-5 mb-3 mb-sm-2 mb-md-3 mb-lg-5"><strong>< Seguir</strong> Comprando</h2>
        </div>

        <div class="col-12 col-sm-12 col-md-5 col-lg-4 p-3 p-sm-2 p-md-3 p-lg-3">

            <div class="container_lineas_single_product">
                <div class="content mb-3 mt-3">
                    <div class="img_container_single_product mx-auto">
                        <img class="img_grid_products_single_product" src="{{$product->imagenes}}" alt="Protector">
                    </div>
                </div>
            </div>

            <p class="text-center  mt-2 mt-sm-2 mt-md-3 mt-lg-4 mb-2 mb-sm-2 mb-md-3 mb-lg-4">
                <img src="{{asset('cosmika/INICIO/ESTRELLAS-DORADAS.png')}}" alt="">
            </p>
        </div>

        <div class="col-12 col-sm-12 col-md-7 col-lg-8 p-1 p-sm-1 p-md-3 p-lg-5">

            <h1 class="text-center name_product"><strong>{{$product->nombre}}</strong></h1>

            <div class="container_price  mt-3 mt-sm-3 mt-md-4 mt-lg-5 mb-3 mb-sm-3 mb-md-3 mb-lg-5">
                <div class="d-flex justify-content-around">
                    <h2 class="my-auto price">${{number_format($product->precio_normal, 0, '.', ',')}}</h2>
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
                <h3 class="detalles"> <strong>Detalles</strong> </h3>
                <p class="detalles_dinamico">{{$product->descripcion}}</p>

                <h4 class="modo">MODO DE EMPLEO:</h4>
                <p class="modo_dinamico">{{$product->modo_empleo}}</p>

                <h4 class="beneficios">BENEFICIOS</h4>
                <p class="beneficios_dinamico">{{$product->beneficios}}</p>

                <h5 class="ingrediente">INGREDIENTES</h5>
                <p class="ingrediente_dinamico">{{$product->ingredientes}}</p>

                <h5 class="producto_de_uso"><strong>PRODUCTO DE USO COSMÉTICO.</strong></h5>
                <h4 class="precauciones">PRECAUCIONES:</h4>
                Si presenta irritación, enrojecimiento o alguna molestia, suspenda el uso y acuda al médico.
                No se deje al alcance de los niños. Manténgase en lugar seco y fresco
            </div>

        </div>

        <div class="col-0 col-0 col-md-2 col-lg-4"></div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-4 text-center">
            <div class="container_lineas_single  mt-4 mt-sm-2 mt-md-3 mt-lg-3 mb-4 mb-sm-2 mb-md-3 mb-lg-3">
                <a href="" class="text_shop_single">
                    ${{number_format($product->precio_normal, 0, '.', ',')}} MXN Agregar
                </a>
            </div>
        </div>
        <div class="col-0 col-sm-0 col-md-2 col-lg-4 "></div>
    </div>

    <div class="row">
        <div class="col-12">
            <h4 class="title_product_populares text-center mt-4 mt-sm-2 mt-md-3 mt-lg-5 mb-4 mb-sm-2 mb-md-3 mb-lg-5">Pensamos que te podría interesar</h4>
        </div>
    </div>


    @include('tienda_cosmica.Components.corousel_single_product')

    @include('tienda_cosmica.Components.productos_populares')

</div>


@endsection

@section('js')

@endsection


