@extends('layouts.app_ecommerce')

@section('template_title')

Carrito
 @endsection

@section('css_custom')
    <link rel="stylesheet" href="{{ asset('assets/css/single_product.css') }}">
    <style>
        .form-check-input:checked {
            background-color: #D19B9B;
            border-color: #D19B9B;
        }
    </style>
@endsection

@section('ecomeerce')

    <div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3  mt-10">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-4 p-sm-3 p-md-3 p-lg-3">
                <h3 class="mb-4">Compras</h3>

                @if(session('cart'))
                    @foreach(session('cart') as $id => $producto)
                        <div class="container_order_item_cart row mb-4">
                            <div class="d-flex justify-content-between">

                                @if ($producto['imagenes'] == NULL)
                                    <div class="mx-auto img_portada_cart" style="background: url({{ asset('ecommerce/Isotipo_negro.png') }}) #ffffff00  50% / contain no-repeat;"></div>
                                @else
                                    <div class="mx-auto img_portada_cart" style="background: url(&quot;{{$producto['imagenes']}}&quot;) #ffffff00  50% / contain no-repeat;"></div>
                                @endif

                                <p class="title_product_cart m-0 my-auto">{{ $producto['nombre'] }}</p>

                                <div class="container_item_cart my-auto" style="">

                                        <div href="javascript:void(0);" class="btn_menos d-inline decrementar" data-id="{{ $id }}"><i class="bi bi-dash icon-small"></i></div>
                                        <input type="number" class="btn_input_cart" value="{{ $producto['cantidad'] }}" min="1" data-id="{{ $id }}" data-stock="{{ $producto['stock'] }}">
                                        <div href="javascript:void(0);" class="btn_plus d-inline incrementar" data-id="{{ $id }}"><i class="bi bi-plus-lg icon-small"></i></div>

                                </div>

                                <p class="title_price_cart m-0 my-auto" id="total-{{ $id }}">
                                    ${{ number_format($producto['precio'] * $producto['cantidad'], 2, '.', ',') }}
                                </p>


                                {{-- <p class="title_price_cart m-0 my-auto" id="total-{{ $id }}">${{ number_format($producto['precio'] * $producto['cantidad'], 0, '.', ',') }}</p> --}}
                                <a class="eliminar-producto m-0 my-auto" data-id="{{ $id }}" style="color:red;"><i class="bi bi-trash3 icon_tras_cart my-auto"></i></a>
                            </div>
                        </div>
                    @endforeach
                @endif

                @php
                    $cart_productos = session('cart', []);
                    $subtotal = array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], $cart_productos));
                @endphp

                <h6 class="mt-0 subtotal_cart">Subtotal:  <span id="subtotal-carrito">${{ number_format($subtotal, 0, '.', ',') }}</span></h6>
                <h5 class="mt-0 envio_cart">Envío: <span id="envio-carrito">$0.00</span></h5>
                <p id="envio-gratis" style="color: green; display: none;">¡Envío Gratis!</p>
                <h4 class="mt-0 mb-3 total_cart">Total:  <span id="total-carrito">${{ number_format($subtotal, 0, '.', ',') }}</span></h4>

                <div class="input-group">
                    <span class="input-group-text input_cupon_cart" id="">
                        <i class="bi bi-ticket"></i>
                    </span>
                    <input type="text" class="form-control input_bg_cart" placeholder="Codigo de Cupon">
                </div>

                <p class="text-end">
                    <button class="btn btn_cupon_cart text-white mt-4">Aplicar Cupon</button>
                </p>

            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-4 p-sm-3 p-md-3 p-lg-3">
                <form method="POST" action="">
                    @csrf
                    <div class="row">
                        <h3 class="mb-3">Detalles del cliente</h3>
                        <input type="hidden" name="total_carrito" id="total_carrito" value="{{ $subtotal }}">
                        <div class="input-group col-12 mb-3">
                                    <span class="input-group-text span_cart_pay" id="">
                                        <i class="bi bi-person-circle"></i>
                                    </span>
                                    <input type="text" name="nombre" class="form-control input_cart_pay" placeholder="Nombre Completo" required>
                        </div>

                        <div class="input-group col-12 mb-3">
                                    <span class="input-group-text span_cart_pay" id="">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" name="correo" class="form-control input_cart_pay" placeholder="correo@correo.com" required>
                        </div>

                        <div class="input-group col-12 mb-3">
                                    <span class="input-group-text span_cart_pay" id="">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                    <input type="tel" minlength="10" maxlength="10" name="telefono" id="telefono" class="form-control input_cart_pay" placeholder="Telefono *" required>
                        </div>

                        @include('shop.components.inputs_factura')

                        <div class="col-12 mt-3 mb-3">
                                    <div class="row">
                                        <h3 class="">Detalles del Envio</h3>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="pickup" checked>
                                                    <label class="form-check-label" for="inlineRadio1">PickUp</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="domicilio">
                                                    <label class="form-check-label" for="inlineRadio2">Envio a Domicilio</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Contenedor PickUp -->
                                        <div class="container_pickup row mt-3">
                                            <p>
                                                <a href="https://maps.app.goo.gl/iVavCu1K9nh6k6DN7" style="color: #D19B9B">
                                                    Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México, CDMX
                                                </a>
                                            </p>
                                            <iframe class="ifram_custom" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30106.79577601507!2d-99.18064112568361!3d19.397300699999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses!2smx!4v1743215720695!5m2!1ses!2smx" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>

                                        <!-- Contenedor Envio a Domicilio -->
                                        <div class="container_envioDomicilio row mt-3" style="display: none;">

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-123"></i>
                                                </span>
                                                <input type="text" name="codigo_postal" class="form-control input_cart_pay" placeholder="CP">
                                            </div>

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-mailbox-flag"></i>
                                                </span>
                                                <input type="text" name="colonia" class="form-control input_cart_pay" placeholder="Colonia">
                                            </div>

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-geo-alt"></i>
                                                </span>
                                                <input type="text" name="estado" class="form-control input_cart_pay" placeholder="Estado">
                                            </div>

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-bank"></i>
                                                </span>
                                                <input type="text" name="alcaldia" class="form-control input_cart_pay" placeholder="Municipio o Alcaldia">
                                            </div>

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-signpost-split"></i>
                                                </span>
                                                <input type="text" name="calle_numero" class="form-control input_cart_pay" placeholder="Calle y numero">
                                            </div>

                                            <div class="input-group col-6 mb-3">
                                                <span class="input-group-text span_cart_pay" id="">
                                                    <i class="bi bi-house"></i>
                                                </span>
                                                <input type="text" name="referencia" class="form-control input_cart_pay" placeholder="Referencia (Dep  Casa, Color , etc)">
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" required>
                                                <a href="{{ route('terminos.index') }}" target="_blank" rel="noopener noreferrer">He leído y acepto los términos y condiciones del sitio.</a>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <p class="text-center">
                                                <p id="mensaje-envio" style="color: red; display: none;"></p>
                                                <button id="btn-pagar" class="btn btn_cupon_cart text-white mt-2 w-100" type="submit">Pagar</button>
                                            </p>
                                        </div>
                                    </div>
                        </div>



                    </div>

                </form>
            </div>

        </div>
    </div>

@endsection

@section('js_custom')

<script>
$(document).ready(function () {
    let envio = 'pickup'; // Valor predeterminado para el método de envío

    if ($('.container_order_item_cart').length === 0) {
        $('.subtotal_cart, .envio_cart, .total_cart').hide();
        $('#listaProductos').html('<p>Tu carrito está vacío.</p>');
    }

    // Cambiar el método de envío
    $('input[name="inlineRadioOptions"]').on('change', function () {
        envio = $(this).val(); // Actualizar el método de envío
        actualizarTotales(); // Recalcular los totales
    });

    // Incrementar cantidad
    $('.incrementar').click(function () {
        let id = $(this).data('id');
        let input = $('input[data-id="' + id + '"]');
        let cantidad = parseInt(input.val()) || 1;
        let stockMaximo = parseInt(input.data('stock')) || 1;

        if (cantidad < stockMaximo) {
            cantidad++;
            input.val(cantidad); // Actualizamos el valor del input
            actualizarCantidad(id, cantidad);
        } else {
            mostrarToast("❌ ¡No hay más stock disponible!", "error");
        }
    });

    // Disminuir cantidad
    $('.decrementar').click(function () {
        let id = $(this).data('id');
        let input = $('input[data-id="' + id + '"]');
        let cantidad = parseInt(input.val()) || 1;

        if (cantidad > 1) {
            cantidad--;
            input.val(cantidad); // Actualizamos el valor del input
            actualizarCantidad(id, cantidad);
        }
    });

    // Actualizar cantidad manualmente
    $('.btn_input_cart').on('change', function () {
        let id = $(this).data('id');
        let cantidad = parseInt($(this).val()) || 1;
        let stockMaximo = parseInt($(this).data('stock')) || 1;

        if (cantidad < 1) {
            $(this).val(1);
        } else if (cantidad > stockMaximo) {
            $(this).val(stockMaximo);
            mostrarToast("❌ ¡No hay más stock disponible!", "error");
        } else {
            actualizarCantidad(id, cantidad);
        }
    });

        // ✅ Eliminar producto del carrito
// ✅ Eliminar producto del carrito
$('.eliminar-producto').click(function () {
    let id = $(this).data('id');

    $.ajax({
        url: "{{ route('cart.removeNas') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: id,
            envio: envio // Enviar el método de envío al servidor
        },
        success: function (response) {
            if (response.success) {
                // Eliminar el producto del DOM
                $('a[data-id="' + id + '"]').closest('.container_order_item_cart').remove();

                // Actualizar los totales en el DOM
                $('#subtotal-carrito').text('$' + response.subtotal.toFixed(2));
                $('#envio-carrito').text('$' + response.costo_envio.toFixed(2));
                $('#total-carrito').text('$' + response.total.toFixed(2));

                // Mostrar mensaje de envío gratis si aplica
                if (response.costo_envio === 0 && envio === 'domicilio') {
                    $('#envio-gratis').show();
                } else {
                    $('#envio-gratis').hide();
                }

                mostrarToast("🗑️ Producto eliminado del carrito", "success");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error al eliminar el producto:", error);
        }
    });
});

    // Función para actualizar la cantidad en el carrito vía AJAX
    function actualizarCantidad(id, cantidad) {
        $.ajax({
            url: "{{ route('cart.updateNas') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                cantidad: cantidad,
                envio: envio // Enviar el método de envío al servidor
            },
            success: function (response) {
                if (response.success) {
                    let precioTotal = response.total_producto.toFixed(2);
                    let subtotal = response.subtotal.toFixed(2);
                    let costoEnvio = response.costo_envio.toFixed(2);
                    let total = response.total.toFixed(2);

                    // Actualizar precios en la vista
                    $('#total-' + id).text('$' + precioTotal);
                    $('#subtotal-carrito').text('$' + subtotal);
                    $('#envio-carrito').text('$' + costoEnvio);
                    $('#total-carrito').text('$' + total);

                    // Mostrar mensaje de envío gratis si aplica
                    if (costoEnvio == 0 && envio === 'domicilio') {
                        $('#envio-gratis').show();
                    } else {
                        $('#envio-gratis').hide();
                    }

                    mostrarToast("🛒 Carrito actualizado", "success");
                }
            }
        });
    }

    // Función para mostrar Toast con sonido
    function mostrarToast(mensaje, tipo) {
        let audioSrc = tipo === "success"
            ? "{{ asset('assets/media/audio/save_global.mp3') }}"
            : "{{ asset('assets/media/audio/stock_insuficiente.mp3') }}";

        let audio = new Audio(audioSrc);
        audio.play();

        Swal.fire({
            toast: true,
            position: "top-end",
            icon: tipo,
            title: mensaje,
            showConfirmButton: false,
            timer: 2000
        });
    }

    function actualizarTotales() {
        let subtotal = parseFloat($('#subtotal-carrito').text().replace('$', '').replace(',', '')) || 0;
        let costoEnvio = 0;

        // Verificar si el método de envío es "domicilio"
        if (envio === 'domicilio') {
            if (subtotal >= 1000) {
                costoEnvio = 0; // Envío gratis si el subtotal es mayor o igual a $1000
                $('#envio-gratis').show(); // Mostrar mensaje de envío gratis
            } else {
                costoEnvio = 150; // Costo de envío si el subtotal es menor a $1000
                $('#envio-gratis').hide(); // Ocultar mensaje de envío gratis
            }
        } else {
            $('#envio-gratis').hide(); // Ocultar mensaje de envío gratis si no es "domicilio"
        }

        // Calcular el total
        let total = subtotal + costoEnvio;

        // Actualizar los valores en el DOM
        $('#envio-carrito').text('$' + costoEnvio.toFixed(2));
        $('#total-carrito').text('$' + total.toFixed(2));
    }
});
</script>

<script>
    $(document).ready(function() {
        $('.razon_social').select2();
        $('.cfdi').select2();
        $('.forma_pago').select2();
    });
          // Obtén los elementos
      const pickupRadio = document.getElementById("inlineRadio1");
      const domicilioRadio = document.getElementById("inlineRadio2");
      const containerPickup = document.querySelector(".container_pickup");
      const containerDomicilio = document.querySelector(".container_envioDomicilio");

      // Escucha cambios en los radios
      pickupRadio.addEventListener("change", toggleContainers);
      domicilioRadio.addEventListener("change", toggleContainers);

      // Función para alternar los contenedores
      function toggleContainers() {
          if (pickupRadio.checked) {
              containerPickup.style.display = "block";
              containerDomicilio.style.display = "none";
          } else if (domicilioRadio.checked) {
              containerPickup.style.display = "none";
              containerDomicilio.style.display = "block";
          }
      }

      $('input[name="factura"]').change(function () {
        if ($(this).val() === 'si') {
            $('#form_factura').slideDown(); // Muestra el formulario con animación
        } else {
            $('#form_factura').slideUp(); // Oculta el formulario con animación
        }
    });

</script>


@endsection
