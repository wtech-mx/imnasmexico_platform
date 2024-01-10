@extends('layouts.app_admin')

@section('template_title')
    Notas Productos
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
 @endsection

@php
    $fecha = date('Y-m-d');
@endphp
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('notas_productos.store') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-12 mt-2">
                                        <h5 style="color:#836262"><strong>Datos del cliente</strong> </h5>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Nombre *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Correo</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="email" name="email" type="email" class="form-control" placeholder="Correo">
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Telefono *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                                            </span>
                                            <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Telefono" pattern="[0-9]{10}"  minlength="10" maxlength="10" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Fecha *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fecha}}" required>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group">
                                            <button class="mt-5" type="button" id="agregarCampo" style="border-radius: 9px;width: 36px;height: 40px;">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-11 mt-5">
                                        <h5 style="color:#836262"><strong>Seleciona los productos</strong> </h5>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div id="camposContainer">
                                                <div class="campo mt-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="">Producto</label>
                                                            <div class="form-group">
                                                                <select name="campo[]" class="form-select d-inline-block producto">
                                                                    <option value="">Seleccione producto</option>
                                                                    @foreach ($products as $product)
                                                                    <option value="{{ $product->nombre }}" data-precio_normal="{{ $product->precio_normal }}">{{ $product->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <label for="name">Cantidad *</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="campo3[]" class="form-control d-inline-block cantidad" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <label for="name">Descuento (%)</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="descuento_prod[]" class="form-control d-inline-block descuento_prod" value="0">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <label for="name">Subtotal *</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="text" name="campo4[]" class="form-control d-inline-block subtotal" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <label for="name">Quitar</label>
                                                            <div class="input-group mb-3">
                                                                <button type="button" class="btn btn-danger btn-sm eliminarCampo"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group">
                                            <button type="button" id="agregarCampoManual" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-11">
                                        <div class="form-group">
                                            <h5>Agregar un producto manual</h5>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div id="camposContainerManual">
                                                <div class="campo mt-3">
                                                    <div class="row">
                                                        <div class="form-group col-3">
                                                            <label for="nombreProducto">Nombre del Producto</label>
                                                            <input type="text" name="nombreProductoManual[]" class="form-control nombreProducto" required>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <label for="cantidad">Cantidad *</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">
                                                                    <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="cantidadManual[]" class="form-control cantidad" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <label for="precio">Precio *</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">
                                                                    <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="precioManual[]" class="form-control precio" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <label for="descuento">Descuento *</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="descuentoManual[]" class="form-control descuento_prod" value="0">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <label for="subtotal">Subtotal</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">
                                                                    <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="text" name="subtotalManual[]" class="form-control subtotal" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-1">
                                                            <label for="subtotal">Quitar</label><br>
                                                            <button type="button" class="btn btn-danger btn-sm  eliminarCampo"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2 mb-3">
                                        <h5 style="color:#836262"><strong>Pago</strong> </h5>
                                    </div>

                                    <div class="col-12 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkboxEnvio" name="envio">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <p class="" style="display: inline-block;font-size: 20px;padding: 5px;color: #3b8b00;">Si</p> <strong> (¿Agregar envio?)</strong>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="toggleSwitch" name="tipo_nota">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <p class="" style="display: inline-block;font-size: 20px;padding: 5px;color: #3b8b00;">Si</p> <strong> (¿Venta Presencial?)</strong>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="name">Subtotal *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control total" type="text" id="total" name="total" value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="name">Descuento</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="number" id="descuento" name="descuento" value="0">
                                        </div>
                                    </div>


                                    <div class="form-group col-4">
                                        <label for="name">Total</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="text" id="totalDescuento" name="totalDescuento" readonly>
                                        </div>
                                    </div>

                                    <div id="divToToggle" style="display: none;">
                                        <div class="row">

                                            <div class="form-group col-4">
                                                <label for="name">Metodo de pago</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/payment.png') }}" alt="" width="35px">
                                                    </span>
                                                    <select class="form-select" name="metodo_pago" id="metodo_pago">
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Tarjeta Credito/debito">Tarjeta Credito/debito</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="name">Monto</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/money.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="monto" name="monto" value="0">
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="name">Foto Pago</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="file" id="foto_pago2" name="foto_pago2">
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="name">Metodo de pago 2</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/payment.png') }}" alt="" width="35px">
                                                    </span>
                                                    <select class="form-select" name="metodo_pago2" id="metodo_pago2">
                                                        <option value="">Seleccione metodo de pago</option>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Tarjeta Credito/debito">Tarjeta Credito/debito</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="name">Monto 2</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/money.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="monto2" name="monto2">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Comentario/nota</label>
                                            <textarea class="form-control" name="nota" id="nota" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('datatable')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var agregarCampoBtn = document.getElementById('agregarCampo');
        var agregarCampoBtnManual = document.getElementById('agregarCampoManual');
        var camposContainer = document.getElementById('camposContainer');
        var camposContainerManual = document.getElementById('camposContainerManual');
        var campoExistente = camposContainer.querySelector('.campo');
        var campoExistenteManual = camposContainerManual.querySelector('.campo');
        var totalInput = document.getElementById('total');
        var descuentoInput = document.getElementById('descuento');
        var totalDescuentoInput = document.getElementById('totalDescuento');

        function eliminarCampo(campo) {
            campo.remove();
            actualizarSubtotal();
        }

        $(document).ready(function () {
            // Función para asociar eventos al campo de cantidad, descuento y precio
            function asociarEventosCampos(nombreProductoInput, cantidadInput, precioInput, descuentoInput, subtotalInput) {
                nombreProductoInput.addEventListener('input', function () {
                    actualizarSubtotal();
                });

                cantidadInput.addEventListener('input', function () {
                    actualizarSubtotal();
                });

                precioInput.addEventListener('input', function () {
                    actualizarSubtotal();
                });

                descuentoInput.addEventListener('input', function () {
                    actualizarSubtotal();
                });
            }

            // Función para eliminar un campo
            function eliminarCampo(campo) {
                campo.remove();
                actualizarSubtotal();
            }

            // Asociar eventos al campo original
            var nombreProductoOriginal = document.querySelector('.campo .nombreProducto');
            var cantidadOriginal = document.querySelector('.campo .cantidad');
            var precioOriginal = document.querySelector('.campo .precio');
            var descuentoOriginal = document.querySelector('.campo .descuento_prod');
            var subtotalOriginal = document.querySelector('.campo .subtotal');
            asociarEventosCampos(nombreProductoOriginal, cantidadOriginal, precioOriginal, descuentoOriginal, subtotalOriginal);

            // Agregar campo duplicado desde la base de datos
            agregarCampoBtn.addEventListener('click', function () {
                var nuevoCampo = campoExistente.cloneNode(true);
                camposContainer.appendChild(nuevoCampo);

                // Limpiar los valores en el nuevo campo
                nuevoCampo.querySelector('.producto').value = '';
                nuevoCampo.querySelector('.cantidad').value = '';
                nuevoCampo.querySelector('.precio').value = '';
                nuevoCampo.querySelector('.descuento_prod').value = '0';
                nuevoCampo.querySelector('.subtotal').value = '0.00';

                // Asignar los eventos a los nuevos campos
                var nombreProductoInput = nuevoCampo.querySelector('.nombreProducto');
                var cantidadInput = nuevoCampo.querySelector('.cantidad');
                var precioInput = nuevoCampo.querySelector('.precio');
                var descuentoInput = nuevoCampo.querySelector('.descuento_prod');
                var subtotalInput = nuevoCampo.querySelector('.subtotal');

                // Agregar evento para eliminar el nuevo campo
                var eliminarCampoBtn = nuevoCampo.querySelector('.eliminarCampo');
                eliminarCampoBtn.addEventListener('click', function () {
                    eliminarCampo(nuevoCampo);
                });

                // Actualizar el subtotal después de inicializar Select2
                actualizarSubtotal();
            });

            // Agregar evento para eliminar el campo original desde la base de datos
            var eliminarCampoBtnOriginal = document.querySelector('.campo .eliminarCampo');
            eliminarCampoBtnOriginal.addEventListener('click', function () {
                eliminarCampo(document.querySelector('.campo'));
            });

            // Asociar eventos al campo original
            asociarEventosCampos(nombreProductoOriginal, cantidadOriginal, precioOriginal, descuentoOriginal, subtotalOriginal);

            // Delegar eventos para los campos manuales
            camposContainerManual.addEventListener('change', function (event) {
                var target = event.target;
                if (
                    target.classList.contains('nombreProducto') ||
                    target.classList.contains('cantidad') ||
                    target.classList.contains('precio') ||
                    target.classList.contains('descuento_prod')
                ) {
                    actualizarSubtotal();
                }
            });

            // Agregar campo duplicado manualmente
            agregarCampoBtnManual.addEventListener('click', function () {
                var nuevoCampoManual = campoExistenteManual.cloneNode(true);
                camposContainerManual.appendChild(nuevoCampoManual);

                // Limpiar los valores en el nuevo campo
                nuevoCampoManual.querySelector('.nombreProducto').value = '';
                nuevoCampoManual.querySelector('.cantidad').value = '';
                nuevoCampoManual.querySelector('.precio').value = '';
                nuevoCampoManual.querySelector('.descuento_prod').value = '0';
                nuevoCampoManual.querySelector('.subtotal').value = '0.00';

                // Asignar los eventos a los nuevos campos
                var nombreProductoInput = nuevoCampoManual.querySelector('.nombreProducto');
                var cantidadInput = nuevoCampoManual.querySelector('.cantidad');
                var precioInput = nuevoCampoManual.querySelector('.precio');
                var descuentoInput = nuevoCampoManual.querySelector('.descuento_prod');
                var subtotalInput = nuevoCampoManual.querySelector('.subtotal');

                asociarEventosCampos(nombreProductoInput, cantidadInput, precioInput, descuentoInput, subtotalInput);

                // Agregar evento para eliminar el nuevo campo manual
                var eliminarCampoBtnManual = nuevoCampoManual.querySelector('.eliminarCampo');
                eliminarCampoBtnManual.addEventListener('click', function () {
                    eliminarCampo(nuevoCampoManual);
                });
            });

        });

        camposContainer.addEventListener('input', function(event) {
            if (event.target.classList.contains('producto') || event.target.classList.contains('cantidad')) {
                actualizarSubtotal();
            }
        });

        function actualizarSubtotal() {
            var camposProductos = camposContainer.querySelectorAll('.campo .producto');
            var camposCantidades = camposContainer.querySelectorAll('.campo .cantidad');
            var camposDescuentos = camposContainer.querySelectorAll('.campo .descuento_prod');
            var subtotales = camposContainer.querySelectorAll('.campo .subtotal');
            var total = 0;

            // Calcular subtotal para campos desde la base de datos
            for (var i = 0; i < camposProductos.length; i++) {
                var producto = camposProductos[i];
                var cantidad = camposCantidades[i];
                var descuento = camposDescuentos[i];
                var subtotal = subtotales[i];

                var precio = parseFloat(producto.options[producto.selectedIndex].getAttribute('data-precio_normal'));
                var cantidadValor = parseInt(cantidad.value);
                var descuentoValor = parseFloat(descuento.value);

                var subtotalValor = isNaN(precio) || isNaN(cantidadValor) ? 0 : precio * cantidadValor;

                // Aplicar el descuento al subtotal
                var subtotalConDescuento = subtotalValor - (subtotalValor * (descuentoValor / 100));
                subtotal.value = subtotalConDescuento.toFixed(2);

                total += subtotalConDescuento;
            }

            // Calcular subtotal para campos manuales
            var camposCantidadesManual = camposContainerManual.querySelectorAll('.campo .cantidad');
            var camposPreciosManual = camposContainerManual.querySelectorAll('.campo .precio');
            var camposDescuentosManual = camposContainerManual.querySelectorAll('.campo .descuento_prod');
            var subtotalesManual = camposContainerManual.querySelectorAll('.campo .subtotal');

            for (var j = 0; j < camposCantidadesManual.length; j++) {
                var cantidadManual = camposCantidadesManual[j];
                var precioManual = camposPreciosManual[j];
                var descuentoManual = camposDescuentosManual[j];
                var subtotalManual = subtotalesManual[j];

                var cantidadValorManual = parseInt(cantidadManual.value);
                var precioValorManual = parseFloat(precioManual.value);
                var descuentoValorManual = parseFloat(descuentoManual.value);

                var subtotalValorManual = isNaN(precioValorManual) || isNaN(cantidadValorManual) ? 0 : precioValorManual * cantidadValorManual;

                // Aplicar el descuento al subtotal manual
                var descuentoAplicadoManual = subtotalValorManual * (descuentoValorManual / 100);
                var subtotalConDescuentoManual = subtotalValorManual - descuentoAplicadoManual;
                subtotalManual.value = subtotalConDescuentoManual.toFixed(2);

                total += subtotalConDescuentoManual;
            }

            totalInput.value = total.toFixed(2);

            // Calcular el descuento total
            var descuentoTotal = parseFloat(descuentoInput.value);
            var totalDescuento = total - (total * (descuentoTotal / 100));
            totalDescuentoInput.value = totalDescuento.toFixed(2);

            // Sumar el costo de envío si el checkbox está marcado
            var costoEnvio = document.getElementById('checkboxEnvio').checked ? 250 : 0;
            var totalConEnvio = totalDescuento + costoEnvio;
            totalDescuentoInput.value = totalConEnvio.toFixed(2);
        }


        // Manejar cambios en el estado del checkbox de envío
        document.getElementById('checkboxEnvio').addEventListener('change', actualizarSubtotal);

        descuentoInput.addEventListener('keyup', function() {
            var descuento = parseFloat(descuentoInput.value);
            var total = parseFloat(totalInput.value);
            var totalDescuento = total - (total * (descuento / 100));
            totalDescuentoInput.value = totalDescuento.toFixed(2);
        });

            // Delegar eventos para los botones de eliminar en ambos contenedores
    camposContainer.addEventListener('click', function (event) {
        var target = event.target;
        if (target.classList.contains('eliminarCampo')) {
            eliminarCampo(target.closest('.campo'));
        }
    });

    camposContainerManual.addEventListener('click', function (event) {
        var target = event.target;
        if (target.classList.contains('eliminarCampo')) {
            eliminarCampo(target.closest('.campo'));
        }
    });
    });

    $(document).ready(function () {
        // Manejar el cambio de estado del switch
        $('#toggleSwitch').change(function () {
            // Mostrar u ocultar el div basado en el estado del switch
            $('#divToToggle').toggle();
        });
    });
</script>
@endsection
