@extends('layouts.app_ecommerce')

@section('template_title') {{$producto->nombre}} @endsection

@section('css_custom')
    <link rel="stylesheet" href="{{ asset('assets/css/single_product.css') }}">
@endsection

@section('ecomeerce')

<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3 mt-10">

    <div class="row">

        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="container_img_portada">

                @if ($producto->imagen_principal == NULL)
                    <div class="mx-auto img_portada_product"
                        style="background-image: url('{{ asset('ecommerce/Isotipo_negro.png') }}'); background-size: contain; background-repeat: no-repeat; background-position: center;">
                    </div>
                @else
                <div class="mx-auto img_portada_product"
                    style="background-image: url(&quot;{{ asset('imagen_principal/empresa' . $empresa->id . '/' . $producto->imagen_principal) }}&quot;); background-size: contain; background-repeat: no-repeat; background-position: center;">
                </div>
                @endif

            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto" itemscope itemtype="https://schema.org/Product">
            <meta itemprop="sku" content="{{ $producto->ProductoStock->sku }}">
            <meta itemprop="gtin" content="{{ $producto->ProductoStock->sku }}"> <!-- GTIN si aplica -->

            <!-- Nombre del producto -->
            <h5 class="text-left mt-2 brand_text_single" itemprop="brand" itemscope itemtype="https://schema.org/Brand">
                <span itemprop="name">{{ $producto->Marca->nombre ?? 'SM' }}</span>
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
                                    <meta itemprop="availability" content="{{ $stockDisponible > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}">

                                    @if($producto->ProductoStock->precio_descuento == NULL)
                                        @if(date('N') == 1 && $producto->id_categoria == 26)
                                            <h6 class="price_text_grid_desc text-dark">
                                                <strong class="precio_reaja text-dark">
                                                    de <s>${{ number_format($precioOriginal, 2, '.', ',') }}</s>
                                                </strong>
                                                a <span itemprop="price">${{ number_format($producto->ProductoStock->precio_normal, 2, '.', ',') }}</span> MXN
                                            </h6>
                                        @else
                                            <h6 class="price_text_grid text-dark">
                                                <span itemprop="price">${{ number_format($producto->ProductoStock->precio_normal, 2) }}</span> MXN
                                            </h6>
                                        @endif
                                    @else
                                        @if(strtotime($producto->ProductoStock->fecha_fin_desc) >= strtotime(date('Y-m-d')))
                                            <h6 class="price_text_grid_desc text-dark">
                                                <strong class="precio_reaja text-dark">
                                                    de <s>${{ number_format($producto->ProductoStock->precio_normal, 2, '.', ',') }}</s>
                                                </strong>
                                                a <span itemprop="price">${{ number_format($producto->ProductoStock->precio_descuento, 2, '.', ',') }}</span> MXN
                                            </h6>
                                        @else
                                            <h6 class="price_text_grid text-dark">
                                                <span itemprop="price">${{ number_format($producto->ProductoStock->precio_normal, 2) }}</span> MXN
                                            </h6>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="col-4 my-auto">
                                <div class="d-flex justify-content-around">
                                    @if ($producto->unidad_venta === 'Kg' || $producto->unidad_venta === 'kg')
                                        @if ($producto->id_marca == 147 || $producto->id_marca == 102)
                                            @php
                                                $precioPorKg = $producto->ProductoStock->precio_normal;
                                                $precio500g = ($precioPorKg * 500) / 1000;
                                                $precio2kg = $precioPorKg * 2;
                                                $precio3kg = $precioPorKg * 3;
                                            @endphp

                                            <select class="select_peso form-control" name="cantidad" id="cantidad_{{ $producto->id }}" data-stock="{{ $stockDisponible }}">
                                                <option value="1" data-precio="{{ $precioPorKg }}">1 Kg - ${{ number_format($precioPorKg, 2) }}</option>
                                                <option value="0.5" data-precio="{{ $precio500g }}">500 g - ${{ number_format($precio500g, 2) }}</option>
                                                <option value="2" data-precio="{{ $precio2kg }}">2 Kg - ${{ number_format($precio2kg, 2) }}</option>
                                                <option value="3" data-precio="{{ $precio3kg }}">3 Kg - ${{ number_format($precio3kg, 2) }}</option>
                                            </select>
                                        @elseif ($producto->id_marca == 5)
                                            @php
                                                $precioPorKg = $producto->ProductoStock->precio_normal;
                                                $precio2kg = $precioPorKg * 2;
                                                $precio3kg = $precioPorKg * 3;
                                            @endphp

                                            <select class="select_peso form-control" name="cantidad" id="cantidad_{{ $producto->id }}" data-stock="{{ $stockDisponible }}">
                                                <option value="1" data-precio="{{ $precioPorKg }}">1 Kg - ${{ number_format($precioPorKg, 2) }}</option>
                                                <option value="2" data-precio="{{ $precio2kg }}">2 Kg - ${{ number_format($precio2kg, 2) }}</option>
                                                <option value="3" data-precio="{{ $precio3kg }}">3 Kg - ${{ number_format($precio3kg, 2) }}</option>
                                            </select>
                                        @else
                                            @php
                                                $precioPorKg = $producto->ProductoStock->precio_normal;
                                                $precio600g = ($precioPorKg * 600) / 1000;
                                                $precio400g = ($precioPorKg * 400) / 1000;
                                            @endphp

                                            <select class="select_peso form-control" name="cantidad" id="cantidad_{{ $producto->id }}" data-stock="{{ $stockDisponible }}">
                                                <option value="1" data-precio="{{ $precioPorKg }}">1 Kg - ${{ number_format($precioPorKg, 2) }}</option>
                                                <option value="0.6" data-precio="{{ $precio600g }}">600 g - ${{ number_format($precio600g, 2) }}</option>
                                                <option value="0.4" data-precio="{{ $precio400g }}">400 g - ${{ number_format($precio400g, 2) }}</option>
                                            </select>
                                        @endif
                                    @else
                                        <div class="btn_menos" style="cursor: pointer;"><i class="bi bi-dash"></i></div>
                                        <input class="input_single_cantidad" name="cantidad" type="number" value="1" min="1"
                                            id="cantidad_{{ $producto->id }}" data-stock="{{ $stockDisponible }}"
                                            style="text-align: center; width: 50px;">
                                        <div class="btn_plus" style="cursor: pointer;"><i class="bi bi-plus"></i></div>
                                    @endif
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
                By <span itemprop="category"> {{ $producto->categorias->pluck('nombre')->implode(', ') }}</span>
            </p>

            @if($stockDisponible <= 0)
                <p class="text-left mt-2 category_text_grid_single" style="color:#C41E1E!important">
                    Stock <span itemprop="category">{{ $stockDisponible }}</span>
                </p>
            @else
                <p class="text-left mt-2 category_text_grid_single"  style="color:#83c890!important">
                    Stock <span itemprop="category">{{ $stockDisponible }}</span>
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

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $producto->nombre }}",
  "image": "{{ asset('imagen_principal/empresa' . $empresa->id . '/' . $producto->imagen_principal) }}",
  "description": "{{ strip_tags($producto->descripcion) }}",
  "sku": "{{ $producto->ProductoStock->sku }}",
  "brand": {
    "@type": "Brand",
    "name": "{{ $producto->Marca->nombre ?? 'Sin marca' }}"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ route('tienda_online.single', $producto->slug) }}",
    "priceCurrency": "MXN",
    "price": "{{ $producto->ProductoStock->precio_descuento ?? $producto->ProductoStock->precio_normal }}",
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "{{ $stockDisponible > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
    "seller": {
      "@type": "Organization",
      "name": "Zocofresh"
    }
  }
}
</script>

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
