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
        <div class="col-12 mt-4 mt-sm-4 mt-md-3 mt-lg-4 mb-sm-2 mb-md-2 mb-lg-1">
            <h1>Todos Los Productos</h1>
        </div>

        <div class="col-12 mt-4 mt-sm-4 mt-md-3 mt-lg-5 mb-sm-4 mb-md-3 mb-lg-5">
            <h2 class="subtitle_todas">Todas Las Líneas</h2>

            <ul class="nav nav-pills mt-4 mt-sm-4 mt-md-3 mt-lg-2 mb-sm-4 mb-md-3 mb-lg-4" id="pills-tab" role="tablist">
                <li class="nav-item p-2" role="presentation">
                  <button class="nav-link active" id="pills-todos-tab" data-bs-toggle="pill" data-bs-target="#pills-todos" type="button" role="tab" aria-controls="pills-todos" aria-selected="true">
                    Todos
                  </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                  <button class="nav-link btn_product_nav" id="pills-facial-tab" data-bs-toggle="pill" data-bs-target="#pills-facial" type="button" role="tab" aria-controls="pills-facial" aria-selected="false">
                    Facial
                  </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                  <button class="nav-link btn_product_nav" id="pills-corporal-tab" data-bs-toggle="pill" data-bs-target="#pills-corporal" type="button" role="tab" aria-controls="pills-corporal" aria-selected="false">
                    Corporal
                  </button>
                </li>
            </ul>

              <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-todos" role="tabpanel" aria-labelledby="pills-todos-tab" tabindex="0">
                    <div class="row">

                        @foreach ( $products as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach

                    </div>
                </div>

                <div class="tab-pane fade" id="pills-facial" role="tabpanel" aria-labelledby="pills-facial-tab" tabindex="0">
                    <div class="row">
                        @foreach ( $products_facial as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-corporal" role="tabpanel" aria-labelledby="pills-corporal-tab" tabindex="0">
                    <div class="row">
                        @foreach ( $products_corporal as $product)
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


