@extends('layouts.app_ecommerce')

@section('template_title') {{$producto->nombre}} @endsection

@section('css_custom')
<link rel="stylesheet" href="{{ asset('assets/ecommerce/css/single_product.css') }}">
@endsection

@section('ecomeerce')

<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3 mt-10">

    <div class="row">

        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="container_img_portada">

                @if ($producto->imagenes == NULL)
                    <div class="mx-auto img_portada_product"
                        style="background-image: url('{{ asset('ecommerce/Isotipo_negro.png') }}'); background-size: contain; background-repeat: no-repeat; background-position: center;">
                    </div>
                @else
                {{-- <div class="mx-auto img_grid" style="background: url(&quot;{{$producto->imagenes}}&quot;) #ffffff00 50% / contain no-repeat;"></div> --}}

                <div class="mx-auto img_portada_product"
                    style="background: url(&quot;{{$producto->imagenes}}&quot;); background-size: contain; background-repeat: no-repeat; background-position: center;">
                </div>
                @endif

            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto" itemscope itemtype="https://schema.org/Product">
            <meta itemprop="sku" content="{{ $producto->sku }}">
            <meta itemprop="gtin" content="{{ $producto->sku }}"> <!-- GTIN si aplica -->

            <!-- Nombre del producto -->
            <h5 class="text-left mt-2 brand_text_single" itemprop="brand" itemscope itemtype="https://schema.org/Brand">
                <span itemprop="name">NAS</span>
            </h5>

            <h4 class="text-left mt-2 title_product_single" itemprop="name">{{ $producto->nombre }}</h4>

            <div class="row mt-3 mb-3">
                <div class="col-12">
                    <div class="container_shop_single">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <!-- Precio -->
                                <div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                    <meta itemprop="priceCurrency" content="MXN">
                                    <meta itemprop="availability" content="{{ $producto->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}">

                                    @if($producto->precio_rebajado == NULL)
                                        @if(strtotime($producto->fecha_fin) >= strtotime(date('Y-m-d')))
                                            <h6 class="price_text_grid_desc text-dark">
                                                <strong class="precio_reaja text-dark">
                                                    de <s>${{ number_format($producto->precio_normal, 2, '.', ',') }}</s>
                                                </strong>
                                                a <span itemprop="price">${{ number_format($producto->precio_rebajado, 2, '.', ',') }}</span> MXN
                                            </h6>
                                        @else
                                            <h6 class="price_text_grid text-dark">
                                                <span itemprop="price">${{ number_format($producto->precio_normal, 2) }}</span> MXN
                                            </h6>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="col-4 my-auto">
                                <div class="d-flex justify-content-around">
                                    <div class="btn_menos" style="cursor: pointer;"><i class="bi bi-dash"></i></div>
                                    <input class="input_single_cantidad" name="cantidad" type="number" value="1" min="1"
                                        id="cantidad_{{ $producto->id }}" data-stock="{{ $producto->stock }}"
                                        style="text-align: center; width: 50px;">
                                    <div class="btn_plus" style="cursor: pointer;"><i class="bi bi-plus"></i></div>
                                </div>
                            </div>

                            <div class="col-4 my-auto">
                                <a href="javascript:void(0)" class="btn btn-xs btn_comprar_single cafe text-white agregar-carrito"
                                    data-id="{{ $producto->id }}" id="btn-comprar-{{ $producto->id }}">
                                        Comprar <i class="bi bi-cart-plus"></i>
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categoría -->
            <p class="text-left mt-2 category_text_grid_single">
                By <span itemprop="category">By {{ $producto->Categoria->nombre ?? 'Sin categoría' }}</span>
            </p>

            @if($producto->stock <= 0)
                <p class="text-left mt-2 category_text_grid_single" style="color:#C41E1E!important">
                    Stock <span itemprop="category">{{ $producto->stock }}</span>
                </p>
            @else
                <p class="text-left mt-2 category_text_grid_single"  style="color:#83c890!important">
                    Stock <span itemprop="category">{{ $producto->stock }}</span>
                </p>
            @endif

            <!-- Descripción -->
            <h6 class="text-left mt-2 title_details_ingle">Detalles</h6>
            <p class="text-left mt-2 detalles_text_single" itemprop="description">
                {{ strip_tags($producto->descripcion) }}
            </p>
        </div>

    </div>

</div>

@include('shop.components.categories_ecommerce')

@include('shop.components.products_slide')

@include('shop.components.categories_slide')



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btnMinusList = document.querySelectorAll(".btn_menos");
        const btnPlusList = document.querySelectorAll(".btn_plus");
        const inputCantidadList = document.querySelectorAll(".input_single_cantidad");
        const btnComprarList = document.querySelectorAll(".agregar-carrito");

        // 🛒 Función para mostrar Toast con sonido
        function mostrarToast(mensaje) {
            let audio = new Audio("{{ asset('assets/media/audio/error_sm.mp3') }}");
            audio.play();

            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "warning",
                title: mensaje,
                showConfirmButton: false,
                timer: 2000
            });
        }

        // 🔽 Disminuir cantidad
        btnMinusList.forEach((btnMinus) => {
            btnMinus.addEventListener("click", function () {
                let inputCantidad = btnMinus.nextElementSibling;
                let currentValue = parseInt(inputCantidad.value) || 1;

                if (currentValue > 1) {
                    inputCantidad.value = currentValue - 1;
                }
                actualizarEstadoBoton(inputCantidad);
            });
        });

        // 🔼 Aumentar cantidad
        btnPlusList.forEach((btnPlus) => {
            btnPlus.addEventListener("click", function () {
                let inputCantidad = btnPlus.previousElementSibling;
                let currentValue = parseInt(inputCantidad.value) || 1;
                let stockMaximo = parseInt(inputCantidad.dataset.stock) || 1;

                if (currentValue < stockMaximo) {
                    inputCantidad.value = currentValue + 1;
                } else {
                    mostrarToast("❌ ¡No hay más stock disponible!");
                }
                actualizarEstadoBoton(inputCantidad);
            });
        });

        // 📏 Validar cambios manuales en el input
        inputCantidadList.forEach((inputCantidad) => {
            inputCantidad.addEventListener("input", function () {
                let currentValue = parseInt(inputCantidad.value) || 1;
                let stockMaximo = parseInt(inputCantidad.dataset.stock) || 1;

                if (currentValue < 1) {
                    inputCantidad.value = 1;
                } else if (currentValue > stockMaximo) {
                    inputCantidad.value = stockMaximo;
                    mostrarToast("❌ ¡No hay más stock disponible!");
                }
                actualizarEstadoBoton(inputCantidad);
            });
        });

        // 🚀 Bloquear botón de compra si no hay stock
        function actualizarEstadoBoton(inputCantidad) {
            let stockDisponible = parseInt(inputCantidad.dataset.stock) || 0;
            let cantidadSeleccionada = parseInt(inputCantidad.value) || 1;
            let idProducto = inputCantidad.id.replace("cantidad_", ""); // Extraer el ID del producto
            let botonComprar = document.getElementById(`btn-comprar-${idProducto}`);

            if (cantidadSeleccionada > stockDisponible || stockDisponible === 0) {
                botonComprar.disabled = true;
                botonComprar.classList.add("disabled");
            } else {
                botonComprar.disabled = false;
                botonComprar.classList.remove("disabled");
            }
        }

        // 🛍 Validar stock al presionar "Comprar"
        btnComprarList.forEach((btn) => {
            btn.addEventListener("click", function (event) {
                let idProducto = btn.dataset.id;
                let inputCantidad = document.getElementById(`cantidad_${idProducto}`);
                let stockDisponible = parseInt(inputCantidad.dataset.stock) || 0;
                let cantidadSeleccionada = parseInt(inputCantidad.value) || 1;

                if (cantidadSeleccionada > stockDisponible || stockDisponible === 0) {
                    event.preventDefault(); // Bloqueamos la compra
                    mostrarToast("❌ ¡No hay suficiente stock disponible!");
                }
            });
        });

        // 🛠 Aplicar validación inicial
        inputCantidadList.forEach(actualizarEstadoBoton);
    });
</script>

@endsection
