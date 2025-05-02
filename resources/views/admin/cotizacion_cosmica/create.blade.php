@extends('layouts.app_admin')

@section('template_title')
    Cotizacion Cosmica
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
                        <form method="POST" action="{{ route('cotizacion_cosmica.store') }}" enctype="multipart/form-data" role="form" id="miFormulario">
                            @csrf
                            <input id="tipo_cotizacion" name="tipo_cotizacion" type="hidden" class="form-control" value="Cotizacion">
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-12 mt-2">
                                        <h4 style="color:#783E5D"><strong>Crear Cotizacion Cosmica</strong> </h4>

                                        <h4 style="color:#783E5D"><strong>Datos del cliente</strong> </h4>
                                    </div>

                                    <div class="col-3">
                                        <label for="precio">Nuevo cliente</label><br>
                                        <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            Agregar <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                                        </button>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Cliente *</label>
                                            <select class="form-select cliente d-inline-block"  data-toggle="select" id="id_cliente" name="id_cliente" value="{{ old('id_cliente') }}">
                                                <option value="">Seleccionar cliente</option>
                                                @foreach ($clientes as $item)
                                                    <option value="{{ $item->id }}">A{{ $item->id }} - {{ $item->name }} / {{ $item->telefono }}</option>
                                                @endforeach
                                            </select>
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
                                                            <input id="name" name="name" type="text" class="form-control" placeholder="Nombre">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <h4 for="name">Correo</h4>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input id="email" name="email" type="email" class="form-control" placeholder="Correo">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <h4 for="name">Telefono *</h4>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input type="number" id="telefono" name="telefono" class="form-control" placeholder="Telefono" pattern="[0-9]{10}"  minlength="10" maxlength="10" value="">
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

                                    <h3 style="color:#783E5D" id="membresia-info"></h3>

                                    <div class="col-12 mt-5">
                                        <h4 style="color:#783E5D"><strong>Seleciona los productos</strong> </h4>
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
                                                                <input type="number" name="campo3[]" class="form-control d-inline-block cantidad" value="0">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <h4 for="name">Descuento (%)</h4>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" id="descuento_prod" name="descuento_prod[]" class="form-control d-inline-block descuento_prod" value="0">
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
                                        <h4 style="color:#783E5D"><strong>Pago</strong> </h4>
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
{{--
                                    <div id="divFactura" style="display: none;">
                                        <div class="row">
                                            <h2 style="color: #783E5D">Factura</h2>

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
                                    </div> --}}

                                    <div class="col-12">
                                        <div class="form-group">
                                            <h4 for="name">Comentario/nota</h4>
                                            <textarea class="form-control" name="nota" id="nota" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn close-modal" style="background: #322338; color: #ffff; font-size: 17px;">Guardar</button>
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
    campoExistente.querySelector('.cantidad').value = '0';
    var totalInput = document.getElementById('total');
    var descuentoInput = document.getElementById('descuento');
    var totalDescuentoInput = document.getElementById('totalDescuento');
    var nameInput = document.getElementById('name');


        // Validar la entrada en tiempo real
        nameInput.addEventListener('input', function () {
            // Eliminar cualquier número ingresado
            this.value = this.value.replace(/\d/g, '');
        });


    $(document).ready(function() {
        $('.producto').select2();
        $('.cliente').select2();

        var clienteData = null;

        $('#id_cliente').on('change', function() {
            var clienteId = $(this).val();

            if (clienteId) {
                $.ajax({
                    url: '/get-descuento/' + clienteId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var clienteData = data;
                        var membresiaInfo = '';

                        if (data.status === 'activo') {
                            if (data.membresia === 'Cosmos') {
                                $('#descuento').val(40);
                                membresiaInfo = 'Membresía: Cosmos';
                                $('#descuento_prod').prop('disabled', false);
                            } else if (data.membresia === 'Estelar') {
                                $('#descuento').val(60);
                                membresiaInfo = 'Membresía: Estelar';
                                $('#descuento_prod').prop('disabled', false);
                            }
                        } else {
                            $('#descuento').val(0); // Opcional: Resetear si no está activo
                            membresiaInfo = 'El cliente no tiene una membresía activa';
                            $('#descuento_prod').prop('disabled', false);
                        }

                        // Actualiza el contenido del h4 con la información de la membresía
                        $('#membresia-info').text(membresiaInfo);
                        actualizarSubtotal();
                    }
                });
            } else {
                $('#membresia-info').text('');
                $('#descuento').val(0); // Opcional: Resetear si no hay cliente seleccionado
                clienteData = null;
                actualizarSubtotal();
            }
        });

        function asociarEventosCampos(cantidadInput, descuentoInput, productoInput) {
            cantidadInput.addEventListener('input', actualizarSubtotal);
            cantidadInput.addEventListener('blur', actualizarSubtotal);
            descuentoInput.addEventListener('input', actualizarSubtotal);
            productoInput.addEventListener('change', actualizarSubtotal);
        }

        function eliminarCampo(campo) {
            campo.remove();
            actualizarSubtotal();
        }

        var cantidadOriginal = document.querySelector('.campo .cantidad');
        var descuentoOriginal = document.querySelector('.campo .descuento_prod');
        var productoOriginal = document.querySelector('.campo .producto');
        asociarEventosCampos(cantidadOriginal, descuentoOriginal, productoOriginal);

        agregarCampoBtn.addEventListener('click', function() {
            var nuevoCampo = campoExistente.cloneNode(true);
            camposContainer.appendChild(nuevoCampo);

            nuevoCampo.querySelector('.producto').value = '';
            nuevoCampo.querySelector('.cantidad').value = '';
            nuevoCampo.querySelector('.descuento_prod').value = '0';
            nuevoCampo.querySelector('.subtotal').value = '0.00';

            nuevoCampo.querySelector('.producto').addEventListener('change', actualizarSubtotal);

            var cantidadInput = nuevoCampo.querySelector('.cantidad');
            var descuentoInput = nuevoCampo.querySelector('.descuento_prod');
            var productoInput = nuevoCampo.querySelector('.producto');
            asociarEventosCampos(cantidadInput, descuentoInput, productoInput);

            $(nuevoCampo).find('.producto').removeClass('select2-hidden-accessible').next().remove();
            $(nuevoCampo).find('.producto').select2();

            var eliminarCampoBtn = nuevoCampo.querySelector('.eliminarCampo');
            eliminarCampoBtn.addEventListener('click', function() {
                eliminarCampo(nuevoCampo);
            });

            actualizarSubtotal();
        });

        var eliminarCampoBtnOriginal = document.querySelector('.campo .eliminarCampo');
        eliminarCampoBtnOriginal.addEventListener('click', function() {
            eliminarCampo(document.querySelector('.campo'));
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

                var subtotalConDescuento = subtotalValor - (subtotalValor * (descuentoValor / 100));
                subtotal.value = subtotalConDescuento.toFixed(2);

                total += subtotalConDescuento;
            }

            totalInput.value = total.toFixed(2);

            var descuentoTotal = parseFloat(descuentoInput.value);
            var totalDescuento = total - (total * (descuentoTotal / 100));
            totalDescuentoInput.value = totalDescuento.toFixed(2);

            var costoEnvio = 0;

            if (clienteData && clienteData.status === 'activo') {
                if (clienteData.membresia === 'Cosmos') {
                    costoEnvio = total >= 1500 ? 90 : 126;
                } else if (clienteData.membresia === 'Estelar') {
                    costoEnvio = total >= 2500 ? 0 : 90;
                }
            }

            var envioCheckbox = document.getElementById('checkboxEnvio');
            if (envioCheckbox.checked) {
                if (!clienteData || clienteData.status !== 'activo') {
                    costoEnvio = 180; // Si el cliente no tiene membresía o no está activa, el costo de envío es 180
                }
            } else {
                costoEnvio = 0; // Si el checkbox no está marcado, el costo de envío es 0
            }

            var totalConEnvio = totalDescuento + costoEnvio;

            var toggleFactura = document.getElementById('toggleFactura');
            if (toggleFactura.checked) {
                totalConEnvio *= 1.16;
            }

            totalDescuentoInput.value = totalConEnvio.toFixed(2);
        }

        document.getElementById('checkboxEnvio').addEventListener('change', actualizarSubtotal);
        document.getElementById('toggleFactura').addEventListener('change', actualizarSubtotal);

        actualizarSubtotal();

        descuentoInput.addEventListener('keyup', function() {
            var descuento = parseFloat(descuentoInput.value);
            var total = parseFloat(totalInput.value);
            var totalDescuento = total - (total * (descuento / 100));
            totalDescuentoInput.value = totalDescuento.toFixed(2);
        });
    });
});




    $(document).ready(function () {
        // Manejar el cambio de estado del switch
        $('#toggleSwitch').change(function () {
            // Mostrar u ocultar el div basado en el estado del switch
            $('#divToToggle').toggle();
        });

        // // Manejar el cambio de estado del switch
        // $('#toggleFactura').change(function () {
        //     // Mostrar u ocultar el div basado en el estado del switch
        //     $('#divFactura').toggle();
        // });
    });
</script>
@endsection
