@extends('layouts.app_admin')

@section('template_title')
    Notas Cotizacion
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
                        <form method="POST" action="{{ route('notas_cotizacion.store') }}" enctype="multipart/form-data" role="form" id="miFormulario">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <input id="tipo_cotizacion" name="tipo_cotizacion" type="hidden" class="form-control" value="Cotizacion">
                                    <div class="col-12 mt-2">
                                        <h2 style="color:#836262"><strong>Datos del cliente</strong> </h2>
                                    </div>

                                    <div class="col-3">
                                        <label for="precio">Nuevo cliente</label><br>
                                        <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            Agregar
                                        </button>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label for="name">Cliente *</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select cliente d-inline-block"  data-toggle="select" id="id_client" name="id_client" value="{{ old('id_client') }}">
                                                    <option value="">Seleccionar cliente</option>
                                                    @foreach ($clientes as $item)
                                                        <option value="{{ $item->id }}" >
                                                            {{ $item->name }} / {{ $item->telefono }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-12">
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <h4 for="name">Nombre *</h4>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" value="{{old('name')}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <h4 for="name">Correo <strong style="color:red;">(No es forzoso)</strong></h4>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input id="email" name="email" type="email" class="form-control" placeholder="Correo" value="{{old('Correo')}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <h4 for="name">Telefono *</h4>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Telefono" pattern="[0-9]{10}"  minlength="10" maxlength="10" value="{{old('telefono')}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <h4 >
                                                            Cliente de MELI
                                                        </h4>
                                                        <div class="form-check mt-4 input-group">
                                                            <input class="form-check-input" type="checkbox" value="1" id="ClienteMeli" name="ClienteMeli">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <h4 for="name">Fecha *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fecha}}" required>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-5">
                                        <h2 style="color:#836262"><strong>Seleciona los productos</strong> </h2>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group">
                                            <button class="mt-5" type="button" id="agregarCampo" style="border-radius: 9px;width: 36px;height: 40px;">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-11">
                                        <div class="form-group">
                                            <div id="camposContainer">
                                                <div class="campo mt-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <h4 for="">Producto</h4>
                                                            <div class="form-group">
                                                                <select name="campo[]" class="form-select d-inline-block producto">
                                                                    <option value="">Seleccione products</option>
                                                                    @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}" data-precio_normal="{{ $product->precio_normal }}">{{ $product->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <h4 for="name">Cantidad *</h4>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="campo3[]" class="form-control d-inline-block cantidad">
                                                                @error('campo3.*')
                                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <h4 for="name">Descuento (%)</h4>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="descuento_prod[]" class="form-control d-inline-block descuento_prod" value="0">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <h4 for="name">Subtotal *</h4>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="text" name="campo4[]" class="form-control d-inline-block subtotal" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <h4 for="name">Quitar</h4>
                                                            <div class="input-group mb-3">
                                                                <button type="button" class="btn btn-danger btn-sm eliminarCampo"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2 mb-3">
                                        <h2 style="color:#836262"><strong>Pago</strong> </h2>
                                    </div>

                                    <div class="col-4 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkboxEnvio" name="envio">
                                            <h4 class="form-check-h4" for="flexCheckDefault">
                                                <p class="" style="display: inline-block;font-size: 20px;padding: 5px;color: #3b8b00;">Si</p> <strong> (¿Agregar envio?)</strong>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="col-4 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="toggleFactura" name="factura" value="1">
                                            <h4 class="form-check-h4" for="flexCheckDefault">
                                                <p class="" style="display: inline-block;font-size: 20px;padding: 5px;color: #3b8b00;">Si</p> <strong> (¿Factura?)</strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="form-group col-4">
                                        <h4 for="name">Subtotal *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control total" type="text" id="total" name="total" value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Descuento</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="number" id="descuento" name="descuento" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Total</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="text" id="totalDescuento" name="totalDescuento" readonly>
                                        </div>
                                    </div>

                                    <div id="divFactura" style="display: none;">
                                        <div class="row">
                                            <h2>Factura</h2>

                                            <div class="form-group col-4">
                                                <h4 for="name">Situacion Fiscal</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="file" id="situacion_fiscal" name="situacion_fiscal">
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <h4 for="name">Nombre / Razon Social</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/firma-digital.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="razon_social" name="razon_social">
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <h4 for="name">RFC</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/carta.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="rfc" name="rfc">
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <h4 for="name">CFDI</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/monetary-policy.png') }}" alt="" width="35px">
                                                    </span>
                                                    <select class="form-select" name="cfdi" id="cfdi">
                                                        <option value="">Seleccione CFDI</option>
                                                        <option value="G01 Adquisicion de Mercancias">G01 Adquisicion de Mercancias</option>
                                                        <option value="G02 Devoluciones, Descuentos o Bonificaciones">G02 Devoluciones, Descuentos o Bonificaciones</option>
                                                        <option value="G03 Gastos en General">G03 Gastos en General</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <h4 for="name">Correo</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/email.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="correo_fac" name="correo_fac">
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <h4 for="name">Telefono</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/complain.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="number" id="telefono_fac" name="telefono_fac">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <h4 for="name">Direccion de Factura</h4>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/cp.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="direccion_fac" name="direccion_fac">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <h4 for="name">Comentario/nota</h4>
                                            <textarea class="form-control" name="nota" id="nota" cols="30" rows="3">{{ old('nota') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff; font-size: 17px;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('datatable')
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {


        var form = document.getElementById('miFormulario');

        form.addEventListener('submit', function(event) {
            var cantidadInputs = document.querySelectorAll('.campo .cantidad');
            var isValid = true;

            cantidadInputs.forEach(function(input) {
                if (input.value === '' || input.value < 1) {
                    isValid = false;
                    alert('La cantidad no puede estar vacía o ser menor que 1');
                    input.focus();
                }
            });

            if (!isValid) {
                event.preventDefault(); // Prevenir el envío del formulario
            }
        });

        var agregarCampoBtn = document.getElementById('agregarCampo');
        var camposContainer = document.getElementById('camposContainer');
        var campoExistente = camposContainer.querySelector('.campo');
        campoExistente.querySelector('.cantidad').value = '';
        var totalInput = document.getElementById('total');
        var descuentoInput = document.getElementById('descuento');
        var totalDescuentoInput = document.getElementById('totalDescuento');
        var nameInput = document.getElementById('name');
        var telefonoInput = document.getElementById('telefono');


        // Validar la entrada en tiempo real
        nameInput.addEventListener('input', function () {
            // Eliminar cualquier número ingresado
            this.value = this.value.replace(/\d/g, '');
        });

        telefonoInput.addEventListener('input', function () {
            // Reemplazar cualquier carácter no numérico
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $(document).ready(function() {
            $('.cliente').select2();
            $('.producto').select2();



            // Función para asociar eventos al campo de cantidad y descuento
            function asociarEventosCampos(cantidadInput, descuentoInput, productoInput) {
                cantidadInput.addEventListener('input', function() {
                    actualizarSubtotal();
                });

                cantidadInput.addEventListener('blur', function() {
                    actualizarSubtotal();
                });

                descuentoInput.addEventListener('input', function() {
                    actualizarSubtotal();
                });

                productoInput.addEventListener('change', function () {
                    actualizarSubtotal();
                });
            }

            // Función para eliminar un campo
            function eliminarCampo(campo) {
                campo.remove();
                actualizarSubtotal();
            }

            // Asociar eventos al campo de cantidad y descuento original
            var cantidadOriginal = document.querySelector('.campo .cantidad');
            var descuentoOriginal = document.querySelector('.campo .descuento_prod');
            var productoOriginal = document.querySelector('.campo .producto');
            asociarEventosCampos(cantidadOriginal, descuentoOriginal, productoOriginal);

            // Agregar campo duplicado
            agregarCampoBtn.addEventListener('click', function() {
                var nuevoCampo = campoExistente.cloneNode(true);
                camposContainer.appendChild(nuevoCampo);

                // Limpiar los valores en el nuevo campo
                nuevoCampo.querySelector('.producto').value = '';
                nuevoCampo.querySelector('.cantidad').value = '';
                nuevoCampo.querySelector('.descuento_prod').value = '0';
                nuevoCampo.querySelector('.subtotal').value = '0.00';

                nuevoCampo.querySelector('.producto').addEventListener('change', function () {
                    actualizarSubtotal();
                });

                // Obtener los campos de cantidad y descuento del nuevo campo
                var cantidadInput = nuevoCampo.querySelector('.cantidad');
                var descuentoInput = nuevoCampo.querySelector('.descuento_prod');
                var productoInput = nuevoCampo.querySelector('.producto');

                // Asociar eventos al nuevo campo de cantidad y descuento
                asociarEventosCampos(cantidadInput, descuentoInput, productoInput);

                // Eliminar la clase 'select2-hidden-accessible' y la data de select2 antes de clonar
                $(nuevoCampo).find('.producto').removeClass('select2-hidden-accessible').next().remove();

                // Inicializar select2 después de clonar
                $(nuevoCampo).find('.producto').select2();

                // Agregar evento para eliminar el nuevo campo
                var eliminarCampoBtn = nuevoCampo.querySelector('.eliminarCampo');
                eliminarCampoBtn.addEventListener('click', function() {
                    eliminarCampo(nuevoCampo);
                });

                // Actualizar subtotal al agregar nuevo campo
                actualizarSubtotal();
            });

            // Agregar evento para eliminar el campo original
            var eliminarCampoBtnOriginal = document.querySelector('.campo .eliminarCampo');
            eliminarCampoBtnOriginal.addEventListener('click', function() {
                eliminarCampo(document.querySelector('.campo'));
            });

        });

        camposContainer.addEventListener('change', function(event) {
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

            totalInput.value = total.toFixed(2);

            // Calcular el descuento total
            var descuentoTotal = parseFloat(descuentoInput.value);
            var totalDescuento = total - (total * (descuentoTotal / 100));
            totalDescuentoInput.value = totalDescuento.toFixed(2);

            // Sumar el costo de envío si el checkbox está marcado
            var costoEnvio = document.getElementById('checkboxEnvio').checked ? 250 : 0;
            var totalConEnvio = totalDescuento + costoEnvio;

            // Sumar el 16% si el checkbox de factura está marcado
            var toggleFactura = document.getElementById('toggleFactura');
            if (toggleFactura.checked) {
                totalConEnvio *= 1.16;
            }

            // Actualizar el valor en el input
            totalDescuentoInput.value = totalConEnvio.toFixed(2);
        }

        // Manejar cambios en el estado del checkbox de envío
        document.getElementById('checkboxEnvio').addEventListener('change', actualizarSubtotal);

        // Agregar un evento change al checkbox de factura
        document.getElementById('toggleFactura').addEventListener('change', actualizarSubtotal);

        // Llamar a la función inicialmente para establecer el valor inicial
        actualizarSubtotal();

        descuentoInput.addEventListener('keyup', function() {
            var descuento = parseFloat(descuentoInput.value);
            var total = parseFloat(totalInput.value);
            var totalDescuento = total - (total * (descuento / 100));
            totalDescuentoInput.value = totalDescuento.toFixed(2);
        });
    });

    $(document).ready(function () {
        // Manejar el cambio de estado del switch
        $('#toggleSwitch').change(function () {
            // Mostrar u ocultar el div basado en el estado del switch
            $('#divToToggle').toggle();
        });

        // Manejar el cambio de estado del switch
        $('#toggleFactura').change(function () {
            // Mostrar u ocultar el div basado en el estado del switch
            $('#divFactura').toggle();
        });
    });
</script>
@endsection
