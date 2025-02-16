@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Kits
@endsection

@section('body_custom')
    bg_productos
@endsection

@section('css_custom')

<link href="{{asset('assets/user/custom/ecommerce_productos.css')}}" rel="stylesheet" />

@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-4 mt-sm-4 mt-md-3 mt-lg-4 mb-sm-2 mb-md-2 mb-lg-1">
            <h1>Todos Los Kits</h1>
        </div>

        <div class="col-12 mt-4 mt-sm-4 mt-md-3 mt-lg-5 mb-sm-4 mb-md-3 mb-lg-5">
            <h2 class="subtitle_todas">Todas Los Kits</h2>
            <div class="row">
                @foreach ($products_kits as $product)

                    @php
                        $nombre = $product->nombre;
                        $partes = explode(' ', $nombre, 2); // Divide el nombre en máximo 2 partes
                        $primeraPalabra = $partes[0]; // La primera palabra
                        $restoDelTexto = $partes[1] ?? ''; // El resto del texto, si existe
                    @endphp

                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <a href="{{ route('tienda.view_kit', $product->id) }}" class="text-center mt-3">
                            <div class="container_lineas_single_carousel mx-auto" style="width:80%; ">
                                <div class="content mb-3 mt-3">
                                    <div class="img_container_single_corousel mx-auto">
                                        <img class="img_grid_products_single_carousel" src="{{asset('products/'.$product->imagenes) }}" alt="Protector">
                                    </div>
                                </div>
                            </div>
                        </a>

                        <h2 class="text-center titulo_producto_carousel mt-4">
                            <strong>{{$primeraPalabra}}</strong> <br>
                            {{$restoDelTexto}}
                        </h2>

                        <h4 class="text-center price_producto_carousel mt-3">
                            <strong class="">${{number_format($product->precio_normal, 0, '.', ',')}}</strong>
                        </h4>

                        <p class="text-center">
                            <a href="{{ route('tienda.view_kit', $product->id) }}" class="text-center mt-3">
                                <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="" style="width: 25px;margin-right: auto;margin-left: auto;">
                            </a>
                        </p>
                    </div>

                @endforeach
            </div>
        </div>
    </div>


</div>

@endsection

@section('js')

@endsection


