@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Productos Corporales
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
            <h1 class="titulo">Productos Corporales</h1>
        </div>

        <div class="col-12 mt-4 mt-sm-4 mt-md-3 mt-lg-5 mb-sm-4 mb-md-3 mb-lg-5">
            <h2 class="subtitle_todas">Todas Las Líneas</h2>

            <ul class="nav nav-pills mt-4 mt-sm-4 mt-md-3 mt-lg-2 mb-sm-4 mb-md-3 mb-lg-4" id="pills-tab" role="tablist">
                <li class="nav-item p-2" role="presentation">
                  <button class="nav-link active" id="pills-astros-tab" data-bs-toggle="pill" data-bs-target="#pills-astros" type="button" role="tab" aria-controls="pills-astros" aria-selected="true">
                    Astros
                  </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                  <button class="nav-link btn_product_nav" id="pills-eclipse-tab" data-bs-toggle="pill" data-bs-target="#pills-eclipse" type="button" role="tab" aria-controls="pills-eclipse" aria-selected="false">
                    Eclipse
                  </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                  <button class="nav-link btn_product_nav" id="pills-flash-tab" data-bs-toggle="pill" data-bs-target="#pills-flash" type="button" role="tab" aria-controls="pills-flash" aria-selected="false">
                    Flash
                  </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                    <button class="nav-link btn_product_nav" id="pills-galaxia-tab" data-bs-toggle="pill" data-bs-target="#pills-galaxia" type="button" role="tab" aria-controls="pills-galaxia" aria-selected="false">
                      Galaxia
                    </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                    <button class="nav-link btn_product_nav" id="pills-renacer-tab" data-bs-toggle="pill" data-bs-target="#pills-renacer" type="button" role="tab" aria-controls="pills-renacer" aria-selected="false">
                      Renacer
                    </button>
                  </li>

            </ul>

              <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-astros" role="tabpanel" aria-labelledby="pills-todos-tab" tabindex="0">
                    <div class="row">

                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="container_lineas_single_carousel mx-auto" style="width:80%; ">
                                <div class="content mb-3 mt-3">
                                    <div class="img_container_single_corousel mx-auto">
                                        <img class="img_grid_products_single_carousel" src="{{ asset('cosmika/inicio/lineas/constelacion.png') }}" alt="Protector">
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-center titulo_producto_carousel mt-4">
                                <strong>Shampoo Facial</strong> <br>
                                con Vitaminas 125 ml
                            </h2>

                            <h4 class="text-center price_producto_carousel mt-3">
                                <strong class="">$200.00</strong>
                            </h4>

                            <p class="text-center">

                                <a href="" class="text-center mt-3">
                                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="" style="width: 25px;margin-right: auto;margin-left: auto;">
                                </a>
                            </p>

                        </div>

                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="container_lineas_single_carousel mx-auto" style="width:80%; ">
                                <div class="content mb-3 mt-3">
                                    <div class="img_container_single_corousel mx-auto">
                                        <img class="img_grid_products_single_carousel" src="{{ asset('cosmika/inicio/lineas/constelacion.png') }}" alt="Protector">
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-center titulo_producto_carousel mt-4">
                                <strong>Shampoo Facial</strong> <br>
                                con Vitaminas 125 ml
                            </h2>

                            <h4 class="text-center price_producto_carousel mt-3">
                                <strong class="">$200.00</strong>
                            </h4>

                            <p class="text-center">

                                <a href="" class="text-center mt-3">
                                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="" style="width: 25px;margin-right: auto;margin-left: auto;">
                                </a>
                            </p>

                        </div>

                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="container_lineas_single_carousel mx-auto" style="width:80%; ">
                                <div class="content mb-3 mt-3">
                                    <div class="img_container_single_corousel mx-auto">
                                        <img class="img_grid_products_single_carousel" src="{{ asset('cosmika/inicio/lineas/constelacion.png') }}" alt="Protector">
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-center titulo_producto_carousel mt-4">
                                <strong>Shampoo Facial</strong> <br>
                                con Vitaminas 125 ml
                            </h2>

                            <h4 class="text-center price_producto_carousel mt-3">
                                <strong class="">$200.00</strong>
                            </h4>

                            <p class="text-center">

                                <a href="" class="text-center mt-3">
                                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="" style="width: 25px;margin-right: auto;margin-left: auto;">
                                </a>
                            </p>
                        </div>

                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="container_lineas_single_carousel mx-auto" style="width:80%; ">
                                <div class="content mb-3 mt-3">
                                    <div class="img_container_single_corousel mx-auto">
                                        <img class="img_grid_products_single_carousel" src="{{ asset('cosmika/inicio/lineas/constelacion.png') }}" alt="Protector">
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-center titulo_producto_carousel mt-4">
                                <strong>Shampoo Facial</strong> <br>
                                con Vitaminas 125 ml
                            </h2>

                            <h4 class="text-center price_producto_carousel mt-3">
                                <strong class="">$200.00</strong>
                            </h4>

                            <p class="text-center">

                                <a href="" class="text-center mt-3">
                                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="" style="width: 25px;margin-right: auto;margin-left: auto;">
                                </a>
                            </p>

                        </div>

                    </div>
                </div>

                <div class="tab-pane fade" id="pills-eclipse" role="tabpanel" aria-labelledby="pills-facial-tab" tabindex="0">

                </div>

                <div class="tab-pane fade" id="pills-corporal" role="tabpanel" aria-labelledby="pills-corporal-tab" tabindex="0">

                </div>

              </div>

        </div>
    </div>


</div>

@endsection

@section('js')

@endsection


