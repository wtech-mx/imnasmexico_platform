
@extends('layouts.app_cotizador')

@section('cotizador')

<div class="container-xxl">
    <div class="row">

        <!-- Productos -->
        <div class="col-lg-8">

            <div class="row ">

                <div class="col-12 mb-3">
                    <div class="d-flex justify-content-start mt-3 mb-1 product-navbar my-auto">
                        <p class="p-2 my-auto"><i class="bi bi-calendar3 p-2"></i>Miercoles 30 Abril 2024</p>
                        <p class="p-2 my-auto"><i class="bi bi-clock p-2"></i> 07:35 AM</p>
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
                <h5 class="mb-4 mt-1 text-center">Eloise's Order</h5>

                <!-- Lista de productos -->
                <ul class="list-group mb-3" >
                    <li class="list-group-item" style="padding: 0!important;border: 0!important;">
                        <div class="d-flex">
                            <!-- Imagen del producto -->
                            <div class="me-3">
                                <img src="https://fastly.picsum.photos/id/0/5000/3333.jpg?hmac=_j6ghY5fCfSD6tvtcV74zXivkJSPIfR9B8w34XeQmvU" alt="Beef Crough" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            </div>

                            <!-- Detalles y controles -->
                            <div class="flex-grow-1 d-flex flex-column justify-content-between" style="position: relative">
                                <div>
                                    <div class="fw-semibold">Beef Crough Beef Croug Beef Croug </div>
                                    <small class="text-muted">$5.50</small>
                                </div>

                                <div class="d-flex justify-content-end align-items-center mt-2 btns_flotantes">
                                    <button class="btn btn-counter btn-sm">-</button>
                                    <span class="mx-2">1</span>
                                    <button class="btn btn-counter btn-sm">+</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </li>
                    <!-- ... más productos -->
                </ul>


                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between">
                    <span>Subtotal:</span>
                    <span>$20.00</span>
                </div>

                <div class="mb-2 d-flex justify-content-between">
                    <span>Discount:</span>
                    <span class="text-danger">-$1.00</span>
                </div>

                <div class="mb-3 d-flex justify-content-between fw-bold border-top pt-2">
                    <span>TOTAL:</span>
                    <span>$21.00</span>
                </div>


                <!-- Botón -->
                <button class="btn btn-primary w-100">Place Order</button>
            </div>
        </div>

    </div>
</div>

@endsection
