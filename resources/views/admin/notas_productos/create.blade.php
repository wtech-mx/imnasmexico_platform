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
                                    <div class="col-12">
                                        <h5 for="toggleSwitch">¿Venta Presencial?</h5>
                                        <label for="toggleSwitch">Si</label>
                                        <input type="checkbox" id="toggleSwitch" name="tipo_nota">
                                    </div>

                                    <div class="col-12">
                                        <h5>Datos del cliente</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Nombre *</label>
                                            <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Correo</label>
                                            <input id="email" name="email" type="email" class="form-control" placeholder="Correo">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Telefono *</label>
                                            <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Telefono" pattern="[0-9]{10}"  minlength="10" maxlength="10" required>

                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Fecha</label>
                                            <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fecha}}" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <h5>Seleciona los productos </h5>
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
                                                        <div class="col-6">
                                                            <label for="">Producto</label>
                                                            <div class="form-group">
                                                                <select name="campo[]" class="form-select d-inline-block producto">
                                                                    <option value="">Seleccione products</option>
                                                                    @foreach ($products as $product)
                                                                    <option value="{{ $product->nombre }}" data-precio_normal="{{ $product->precio_normal }}">{{ $product->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="">Cantidad</label>
                                                            <div class="form-group">
                                                                <input type="number" name="campo3[]" class="form-control d-inline-block cantidad" >
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="">Subtotal</label>
                                                            <div class="form-group">
                                                                <input type="text" name="campo4[]" class="form-control d-inline-block subtotal" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <h5>Pago</h5>
                                    </div>

                                    <div class="col-12">
                                        <h5 for="toggleSwitch">¿Agregar envio?</h5>
                                        <label for="">Si</label>
                                        <input type="checkbox" id="checkboxEnvio" name="envio">
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Subtotal</label>
                                            <input class="form-control total" type="text" id="total" name="total" value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Descuento</label>
                                            <input class="form-control" type="number" id="descuento" name="descuento" value="0">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Total</label>
                                            <input class="form-control" type="text" id="totalDescuento" name="totalDescuento" readonly>
                                        </div>
                                    </div>

                                    <div id="divToToggle" style="display: none;">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="name">Metodo de pago</label>
                                                    <select class="form-select" name="metodo_pago" id="metodo_pago">
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Tarjeta Credito/debito">Tarjeta Credito/debito</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="name">Monto</label>
                                                    <input class="form-control" type="text" id="monto" name="monto" value="0">
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="name">Foto Pago</label>
                                                    <input class="form-control" type="file" id="foto_pago2" name="foto_pago2">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name">Metodo de pago 2</label>
                                                    <select class="form-select" name="metodo_pago2" id="metodo_pago2">
                                                        <option value="">Seleccione metodo de pago</option>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Tarjeta Credito/debito">Tarjeta Credito/debito</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name">Monto 2</label>
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
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
        var agregarCampoBtn = document.getElementById('agregarCampo');
        var camposContainer = document.getElementById('camposContainer');
        var campoExistente = camposContainer.querySelector('.campo');
        var totalInput = document.getElementById('total');
        var descuentoInput = document.getElementById('descuento');
        var totalDescuentoInput = document.getElementById('totalDescuento');

        $(document).ready(function() {
            $('.producto').select2();

            // Función para asociar eventos al campo de cantidad
            function asociarEventosCantidad(cantidadInput) {
                cantidadInput.addEventListener('input', function() {
                    actualizarSubtotal();
                });
            }

            // Asociar eventos al campo de cantidad original
            var cantidadOriginal = document.querySelector('.campo .cantidad');
            asociarEventosCantidad(cantidadOriginal);

            agregarCampoBtn.addEventListener('click', function() {
                var nuevoCampo = campoExistente.cloneNode(true);
                camposContainer.appendChild(nuevoCampo);

                // Limpiar los valores en el nuevo campo
                nuevoCampo.querySelector('.producto').value = '';
                nuevoCampo.querySelector('.cantidad').value = '';
                nuevoCampo.querySelector('.subtotal').value = '0.00';

                // Asignar los eventos a los nuevos campos
                nuevoCampo.querySelector('.producto').addEventListener('change', actualizarSubtotal);

                // Obtener el campo de cantidad del nuevo campo
                var cantidadInput = nuevoCampo.querySelector('.cantidad');

                // Asociar eventos al nuevo campo de cantidad
                asociarEventosCantidad(cantidadInput);

                // Eliminar la clase 'select2-hidden-accessible' y la data de select2 antes de clonar
                $(nuevoCampo).find('.producto').removeClass('select2-hidden-accessible').next().remove();

                // Inicializar select2 después de clonar
                $(nuevoCampo).find('.producto').select2();
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
            var subtotales = camposContainer.querySelectorAll('.campo .subtotal');
            var total = 0;

            for (var i = 0; i < camposProductos.length; i++) {
                var producto = camposProductos[i];
                var cantidad = camposCantidades[i];
                var subtotal = subtotales[i];

                var precio = parseFloat(producto.options[producto.selectedIndex].getAttribute('data-precio_normal'));
                var cantidadValor = parseInt(cantidad.value);

                var subtotalValor = isNaN(precio) || isNaN(cantidadValor) ? 0 : precio * cantidadValor;
                subtotal.value = subtotalValor.toFixed(2);

                total += subtotalValor;
            }
            totalInput.value = total.toFixed(2);
                console.log('totsl', total);

            // Calcular el descuento
            var descuento = parseFloat(descuentoInput.value);
            var totalDescuento = total - (total * (descuento / 100));
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
