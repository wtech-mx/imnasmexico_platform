@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Productos Faciales
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
            <h1 class="titulo">Productos Faciales</h1>
        </div>

        <div class="col-12 mt-4 mt-sm-4 mt-md-3 mt-lg-5 mb-sm-4 mb-md-3 mb-lg-5">
            <h2 class="subtitle_todas">Todas Las Líneas</h2>

            <ul class="nav nav-pills mt-4 mt-sm-4 mt-md-3 mt-lg-2 mb-sm-4 mb-md-3 mb-lg-4" id="pills-tab" role="tablist">
                <li class="nav-item p-2" role="presentation">
                  <button class="nav-link active" id="pills-constelacion-tab" data-bs-toggle="pill" data-bs-target="#pills-constelacion" type="button" role="tab" aria-controls="pills-constelacion" aria-selected="true">
                    Constelacion
                  </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                  <button class="nav-link btn_product_nav" id="pills-espectro-tab" data-bs-toggle="pill" data-bs-target="#pills-espectro" type="button" role="tab" aria-controls="pills-espectro" aria-selected="false">
                    Espectro
                  </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                  <button class="nav-link btn_product_nav" id="pills-lunar-tab" data-bs-toggle="pill" data-bs-target="#pills-lunar" type="button" role="tab" aria-controls="pills-lunar" aria-selected="false">
                    Lunar
                  </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                    <button class="nav-link btn_product_nav" id="pills-mascarillas-tab" data-bs-toggle="pill" data-bs-target="#pills-mascarillas" type="button" role="tab" aria-controls="pills-mascarillas" aria-selected="false">
                      Mascarillas Estelares
                    </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                    <button class="nav-link btn_product_nav" id="pills-nebulosa-tab" data-bs-toggle="pill" data-bs-target="#pills-nebulosa" type="button" role="tab" aria-controls="pills-nebulosa" aria-selected="false">
                      Nebulosa
                    </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                    <button class="nav-link btn_product_nav" id="pills-pluton-tab" data-bs-toggle="pill" data-bs-target="#pills-pluton" type="button" role="tab" aria-controls="pills-pluton" aria-selected="false">
                      Pluton
                    </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                    <button class="nav-link btn_product_nav" id="pills-solar-tab" data-bs-toggle="pill" data-bs-target="#pills-solar" type="button" role="tab" aria-controls="pills-solar" aria-selected="false">
                      Solar
                    </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                    <button class="nav-link btn_product_nav" id="pills-venus-tab" data-bs-toggle="pill" data-bs-target="#pills-venus" type="button" role="tab" aria-controls="pills-venus" aria-selected="false">
                      Venus
                    </button>
                </li>
            </ul>

              <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-constelacion" role="tabpanel" aria-labelledby="pills-constelacion-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_constelacion as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-espectro" role="tabpanel" aria-labelledby="pills-espectro-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_espectro as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-lunar" role="tabpanel" aria-labelledby="pills-lunar-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_lunar as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-mascarillas" role="tabpanel" aria-labelledby="pills-mascarillas-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_mascarillas as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-nebulosa" role="tabpanel" aria-labelledby="pills-nebulosa-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_nebulosa as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-pluton" role="tabpanel" aria-labelledby="pills-pluton-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_pluton as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-solar" role="tabpanel" aria-labelledby="pills-solar-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_solar as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-venus" role="tabpanel" aria-labelledby="pills-venus-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_venus as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>
              </div>

        </div>
    </div>


</div>

@endsection

@section('js')

@endsection


