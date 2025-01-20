@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Productos
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
        <div class="col-12 mt-4 mt-sm-4 mt-md-3 mt-lg-4 mb-sm-4 mb-md-3 mb-lg-4">
            <h1>Todos Los Productos</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
            <div class="container_lineas_grid">

                <div class="content">
                    <div class="icon_heart">
                        <div class="d-flex justify-content-start">
                            <img class="icon_card_product_grid" src="{{ asset('cosmika/inicio/CORAZON-POPULARES.png') }}" alt="" style="width: 20px">
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

@endsection

@section('js')

@endsection


