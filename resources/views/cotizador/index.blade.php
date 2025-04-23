
@extends('layouts.app_cotizador')

@section('cotizador')

<div class="container-xxl">
    <div class="row">

        <!-- Productos -->
        <div class="col-lg-8">

            <div class="row ">

                <div class="col-12 mb-3">
                    <div class="d-flex justify-content-start mt-3 mb-1 product-navbar my-auto">
                        @php
                            setlocale(LC_TIME, 'es_MX.UTF-8');
                            $fecha = \Carbon\Carbon::now()->translatedFormat('l d F Y');
                        @endphp

                        <p class="p-2 my-auto">
                            <i class="bi bi-calendar3 p-2"></i>{{ ucfirst($fecha) }}
                        </p>

                        <p class="p-2 my-auto">
                            <i class="bi bi-clock p-2"></i> <span id="hora-actual"></span>
                        </p>
                    </div>
                </div>

                <div class="col-12">
                    <h5 class="p-2">Categorías</h5>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs mb-3" id="categoriaTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="corp-tab" data-bs-toggle="tab" data-bs-target="#corp" type="button" role="tab" aria-controls="corp" aria-selected="true">
                                Corporales
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="facial-tab" data-bs-toggle="tab" data-bs-target="#facial" type="button" role="tab" aria-controls="facial" aria-selected="false">
                                Faciales
                            </button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Corporales -->
                        <div class="tab-pane fade show active" id="corp" role="tabpanel" aria-labelledby="corp-tab">
                            <div id="loop_categorias_corp" class="owl-carousel">
                                @foreach ($categoriasCorporal as $categoria)
                                    <div class="item">
                                        <div class="product_category" onclick="cargarProductosPorCategoria({{ $categoria->id }})">
                                            <h6 class="mt-3 mb-1 tittle_category">Corporal</h6>
                                            <img src="{{ asset('categorias/'.$categoria->imagen) }}" alt="Producto">
                                            <h6 class="mt-3 mb-1 tittle_category">{{ $categoria->nombre }}</h6>
                                            <div class="fw-bold mt-1">
                                                <p class="text_items" style="margin: 0;">
                                                    {{ $categoria->productos_count }} Artículos
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Faciales -->
                        <div class="tab-pane fade" id="facial" role="tabpanel" aria-labelledby="facial-tab">
                            <div id="loop_categorias_facial" class="owl-carousel">
                                @foreach ($categoriasFacial as $categoria)
                                    <div class="item">
                                        <div class="product_category" onclick="cargarProductosPorCategoria({{ $categoria->id }})">
                                            <h6 class="mt-3 mb-1 tittle_category">Facial</h6>
                                            <img src="{{ asset('categorias/'.$categoria->imagen) }}" alt="Producto">
                                            <h6 class="mt-3 mb-1 tittle_category">{{ $categoria->nombre }}</h6>
                                            <div class="fw-bold mt-1">
                                                <p class="text_items" style="margin: 0;">
                                                    {{ $categoria->productos_count }} Artículos
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-12">
                    <form class="d-flex mt-3 mb-3" id="formBuscarProductos">
                        <input id="inputBuscarProductos" class="form-control me-2" type="search" placeholder="Buscar producto..." aria-label="Search">
                    </form>

                </div>

                <!-- Repetir este div para cada producto -->
                    <div class="" id="contenedor_productos">
                        <!-- Aquí se insertan los productos dinámicamente -->
                    </div>
                <!-- ... más productos -->
            </div>

        </div>

        <!-- Orden -->
        <div class="col-lg-4 mt-3">
            <div class="sidebar">
                <h5 class="mb-4 mt-1 text-center">Cotiza tu pedido</h5>

                <!-- Lista de productos -->
                <ul class="list-group mb-3" >

                    <!-- ... más productos -->
                </ul>


                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between">
                    <span>Subtotal:</span>
                    <span id="subtotal">$0.00</span>
                </div>

                <div class="mb-2 d-flex justify-content-between">
                    <span>Discount:</span>
                    <span class="text-danger">-$0.00</span>
                </div>

                <div class="mb-3 d-flex justify-content-between fw-bold border-top pt-2">
                    <span>TOTAL:</span>
                    <span id="total">$0.00</span>
                </div>

                <!-- Botón -->
                <button class="btn btn-xs btn-success w-100"><i class="bi bi-cart3"></i> Ralizar pedido </button>
            </div>
        </div>

    </div>
</div>

@endsection
