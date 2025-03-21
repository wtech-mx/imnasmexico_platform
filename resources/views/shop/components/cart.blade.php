<!-- Modal -->
<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3">
    <div class="row">
        <div class="col-12 col-sm-7 col-md-7 col-lg-7">
            <h3 class="mb-4">Compras</h3>

            @if(session('cart'))
                @foreach(session('cart') as $id => $producto)
                    <div class="container_order_item_cart row mb-4">
                        <div class="d-flex justify-content-between">
                            <div class="mx-auto img_portada_cart" style="background: url('{{ asset('imagen_principal/empresa1/' . $producto['imagen']) }}') #ffffff00  50% / contain no-repeat;"></div>
                            <p class="title_product_cart m-0 my-auto">{{ $producto['nombre'] }}</p>

                            <div class="container_item_cart my-auto">
                                <div href="javascript:void(0);" class="btn_menos d-inline decrementar" data-id="{{ $id }}"><i class="bi bi-dash icon-small"></i></div>
                                <input type="number" class="btn_input_cart" value="{{ $producto['cantidad'] }}" min="1" data-id="{{ $id }}">
                                <div href="javascript:void(0);" class="btn_plus d-inline incrementar" data-id="{{ $id }}"><i class="bi bi-plus-lg icon-small"></i></div>
                            </div>
                            <p class="title_price_cart m-0 my-auto" id="total-{{ $id }}">
                                @if(isset($producto['precio_original']) && $producto['precio'] < $producto['precio_original'])
                                    <s>${{ number_format($producto['precio_original'] * $producto['cantidad'], 2, '.', ',') }}</s>
                                    ${{ number_format($producto['precio'] * $producto['cantidad'], 2, '.', ',') }}
                                @else
                                    ${{ number_format($producto['precio'] * $producto['cantidad'], 2, '.', ',') }}
                                @endif
                            </p>
                            <a class="eliminar-producto" data-id="{{ $id }}"><i class="bi bi-trash3 icon_tras_cart my-auto" ></i></a>
                        </div>
                    </div>
                @endforeach
            @endif

            @php
                $cart_productos = session('cart', []);
                $total_carrito = array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], $cart_productos));
            @endphp

            <h4 class="mt-3"><b>Total: </b> <span id="total-carrito">${{ number_format($total_carrito, 2, '.', ',') }}</span></h4>

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

        <div class="col-12 col-sm-5 col-md-5 col-lg-5">
            <h3 class="mb-4">Detalles del cliente</h3>
            <form method="POST" action="{{ route('procesar.pago') }}">
                @csrf
                <div class="row">
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

                    <div class="col-12">
                        <div class="row">
                            <h3 class="mb-4">Detalles del Envio</h3>

                            <!-- Radio Buttons -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="pickup" checked>
                                <label class="form-check-label" for="inlineRadio1">PickUp</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="domicilio">
                                <label class="form-check-label" for="inlineRadio2">Envio a Domicilio</label>
                            </div>

                            <!-- Contenedor PickUp -->
                            <div class="container_pickup row mt-3">
                                <p>
                                    <a href="https://maps.app.goo.gl/WoEycdRbmkpVLquXA">
                                        Mérida 64, Cuahutemoc 19-4214, -99.1579, Roma Nte., 06700 Ciudad de México, CDMX
                                    </a>
                                </p>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.7954834491547!2d-99.16045332523932!3d19.421240581855653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ffbe36afe1f7%3A0x3ea01a1b1ae9104c!2sZoco%20Fresh%20Roma%20Tienda%20org%C3%A1nica!5e0!3m2!1ses-419!2smx!4v1735834614408!5m2!1ses-419!2smx" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

                            <div class="col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" required>
                                    <label class="form-check-label" for="inlineCheckbox1">He leído y acepto los términos y condiciones del sitio.</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <p class="text-center">
                        <button class="btn btn_cupon_cart text-white mt-4" type="submit">Pagar</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

@section('js_custom')

<script>
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
</script>

<script>
    $(document).ready(function() {
        let totalCarrito = {{ $total_carrito }};
        // Lógica para agregar producto al carrito
        $(".agregar-carrito").click(function() {
            var productId = $(this).data("id");
            var cantidad = $("#cantidad_" + productId).val();

            $.ajax({
                url: "{{ route('carrito.agregar') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: productId,
                    cantidad: cantidad
                },
                success: function(response) {
                    // Mostrar el modal del carrito
                    const cartModal = new bootstrap.Modal(document.getElementById("cartModal"), {
                        backdrop: "static",
                        keyboard: true
                    });
                    cartModal.show();
                },
                error: function(xhr) {
                    alert("Hubo un error al agregar el producto.");
                }
            });
        });

        // Aumentar cantidad
        $('.incrementar').click(function () {
            let id = $(this).data('id');
            let input = $('input[data-id="' + id + '"]');
            let cantidad = parseInt(input.val()) + 1;
            actualizarCantidad(id, cantidad);
        });

        // Disminuir cantidad
        $('.decrementar').click(function () {
            let id = $(this).data('id');
            let input = $('input[data-id="' + id + '"]');
            let cantidad = parseInt(input.val()) - 1;
            if (cantidad > 0) {
                actualizarCantidad(id, cantidad);
            }
        });

        // Actualizar cantidad desde input
        $('.input_cart_list').on('change', function () {
            let id = $(this).data('id');
            let cantidad = parseInt($(this).val());
            if (cantidad > 0) {
                actualizarCantidad(id, cantidad);
            }
        });

        // Función AJAX para actualizar cantidad
        function actualizarCantidad(id, cantidad) {
            $.ajax({
                url: "{{ route('cart.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    cantidad: cantidad
                },
                success: function (response) {
                    if (response.success) {
                        $('input[data-id="' + id + '"]').val(cantidad);
                        $('#total-' + id).text('$' + response.total_producto);
                        $('#total-carrito').text('$' + response.total_carrito);
                    }
                }
            });
        }

        // Eliminar producto del carrito
        $('.eliminar-producto').click(function () {
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('cart.remove') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function (response) {
                    if (response.success) {
                        location.reload(); // Recargar la página para actualizar el carrito
                    }
                }
            });
        });

        // Lógica del código postal
        const zonas = {
            13: ["01588", "01700", "01708", "01720"],
            12: ["01049", "01060", "01089", "01090"],
            11: ["01259", "01260", "01296"]
        };
        const costosZona = { 13: 10, 12: 15, 11: 20 };

        $("input[name='codigo_postal']").on("input", function () {
            const codigoPostal = $(this).val().trim();
            let costoAdicional = 0;

            // Determinar la zona y el costo adicional
            for (const zona in zonas) {
                if (zonas[zona].includes(codigoPostal)) {
                    costoAdicional = costosZona[zona];
                    break;
                }
            }

            // Actualizar el total del carrito con el costo adicional
            actualizarTotalCarrito(costoAdicional);
        });

        // Función para actualizar el total del carrito con el costo adicional
        function actualizarTotalCarrito(costoAdicional) {
            // Total final con el costo adicional
            let totalFinal = totalCarrito + costoAdicional;

            // Mostrar el total actualizado en el DOM
            $('#total-carrito').text('$' + totalFinal.toFixed(2)); // Actualiza el total
        }
    });
</script>

@endsection
