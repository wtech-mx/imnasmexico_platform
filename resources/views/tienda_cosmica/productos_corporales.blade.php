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

                  <li class="nav-item p-2" role="presentation">
                    <button class="nav-link btn_product_nav" id="pills-rose-tab" data-bs-toggle="pill" data-bs-target="#pills-rose" type="button" role="tab" aria-controls="pills-rose" aria-selected="false">
                      Rose
                    </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                    <button class="nav-link btn_product_nav" id="pills-esencia-tab" data-bs-toggle="pill" data-bs-target="#pills-esencia" type="button" role="tab" aria-controls="pills-esencia" aria-selected="false">
                      Esencia
                    </button>
                </li>

                <li class="nav-item p-2" role="presentation">
                    <button class="nav-link btn_product_nav" id="pills-pure-tab" data-bs-toggle="pill" data-bs-target="#pills-pure" type="button" role="tab" aria-controls="pills-pure" aria-selected="false">
                        Pure
                    </button>
                </li>

            </ul>

              <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-astros" role="tabpanel" aria-labelledby="pills-todos-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_Astros $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-eclipse" role="tabpanel" aria-labelledby="pills-facial-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_Eclipse as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-flash" role="tabpanel" aria-labelledby="pills-flash-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_Flash as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-galaxia" role="tabpanel" aria-labelledby="pills-galaxia-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_Flash as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-renacer" role="tabpanel" aria-labelledby="pills-renacer-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_Renacer as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-rose" role="tabpanel" aria-labelledby="pills-rose-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_rose as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-esencia" role="tabpanel" aria-labelledby="pills-esencia-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_Esencia as $product)
                            @include('tienda_cosmica.Components.item_categorias')
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-pure" role="tabpanel" aria-labelledby="pills-pure-tab" tabindex="0">
                    <div class="row">
                        @foreach ($products_Pure as $product)
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hash = window.location.hash; // Obtener el fragmento de la URL
        if (hash) {
            const tabButton = document.querySelector(`[data-bs-target="${hash}"]`);
            if (tabButton) {
                // Activar la pestaña
                const tab = new bootstrap.Tab(tabButton);
                tab.show();
            }
        }
    });
</script>
@endsection
