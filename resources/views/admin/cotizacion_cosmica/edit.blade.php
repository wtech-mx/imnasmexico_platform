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
                        <form method="POST" action="{{ route('cotizacion_cosmica.update', $cotizacion->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <h5 style="color:#783E5D"><strong>Datos del cliente</strong> </h5>
                                    </div>
                                    <input id="id_cliente" name="id_cliente" type="hidden" class="form-control" value="{{ $cotizacion->id_usuario }}" >
                                    @if ($cotizacion->id_usuario == NULL)

                                        <div class="form-group col-6">
                                            <label for="name">Nombre *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="name" name="name" type="text" class="form-control" value="{{ $cotizacion->nombre }}" >

                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="name">Telefono *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="telefono" name="telefono" type="number" class="form-control" value="{{ $cotizacion->telefono }}">
                                            </div>
                                        </div>

                                    @else

                                        <div class="form-group col-6">
                                            <label for="name">Nombre *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="name" name="name" type="text" class="form-control" value="{{ $cotizacion->User->name }}" >
                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="name">Correo *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="email" name="email" type="email" class="form-control" value="{{ $cotizacion->User->email }}">
                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="name">Telefono *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="telefono" name="telefono" type="number" class="form-control" value="{{ $cotizacion->User->telefono }}">
                                            </div>
                                        </div>

                                    @endif

                                    <div class="form-group col-6">
                                        <label for="name">Fecha *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="fecha" name="fecha" type="date" class="form-control" value="{{ $cotizacion->fecha }}">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 style="color:#783E5D"><strong>Productos Selecionados</strong> </h5>
                                    </div>

                                    @php
                                        $total = 0;
                                        $totalCantidad = 0;
                                    @endphp

                                    @foreach ($cotizacion_productos as  $productos)
                                        <div class="row campo3" data-id="{{ $productos->id }}">
                                            @php
                                                if($productos->cantidad != NULL){
                                                    $precio_unitario = $productos->price / $productos->cantidad;
                                                    $precio_format = number_format($productos->price, 0, '.', ',');
                                                    $precio_unitario_format = number_format($precio_unitario, 0, '.', ',');
                                                }
                                            @endphp

                                            <div class="col-3">
                                                <label for="">Nombre</label>
                                                <input type="text"  name="productos[]" class="form-control d-inline-block" value="{{ $productos->producto }}" readonly>
                                            </div>

                                            <div class="form-group col-2">
                                                <label for="cantidad_{{ $productos->id }}">Cantidad *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="number" id="cantidad_{{ $productos->id }}" name="cantidad[]" class="form-control cantidad" style="width: 65%;" value="{{ $productos->cantidad }}">
                                                </div>
                                            </div>

                                            <div class="form-group col-2">
                                                <label for="descuento_{{ $productos->id }}">Descuento *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="number" id="descuento_{{ $productos->id }}" name="descuento[]" class="form-control descuento" value="{{ $productos->descuento }}">
                                                </div>
                                            </div>

                                            <div class="form-group col-3">
                                                <label for="subtotal_{{ $productos->id }}">Subtotal *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="text" id="subtotal_{{ $productos->id }}" name="price[]" class="form-control subtotal" value="${{ $precio_format }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group col-2">
                                                <h4 for="name">Quitar</h4>
                                                <div class="input-group mb-3">
                                                    <button type="button" class="btn btn-danger btn-sm eliminarCampo3" data-id="{{ $productos->id }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </div>
                                            </div>

                                            <!-- Campo oculto para el precio unitario -->
                                            <input type="hidden" id="precio_unitario_{{ $productos->id }}" value="{{ $precio_unitario }}">

                                            @php
                                                $subtotal = $productos->price;
                                                $total += $subtotal;
                                                $precio = $total;
                                            @endphp
                                        </div>
                                    @endforeach

                                    <div class="col-12">
                                        <h5 class="mt-5">Seleciona mas productos </h5>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group">
                                            <button class="mt-5" type="button" id="agregarCampo2" style="border-radius: 9px;width: 36px;height: 40px;">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-11">
                                        <div class="form-group">
                                            <div id="camposContainer2">
                                                <div class="campo2 mt-3">
                                                    <div class="row" id="new-products">
                                                        <div class="col-3">
                                                            <label for="">Producto</label>
                                                            <select id="producto" name="campo[]" class="form-select d-inline-block producto2">
                                                                <option value="">Seleccione productos</option>
                                                                @foreach ($products as $product)
                                                                <option value="{{ $product->id }}" data-precio_normal2="{{ $product->precio_normal }}">{{ $product->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <label for="name">Cantidad *</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="campo3[]" class="form-control d-inline-block cantidad2">
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

                                                        <div class="form-group col-3">
                                                            <label for="name">Subtotal *</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="text" name="campo4[]" class="form-control d-inline-block subtotal2" readonly>
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

                                    <div class="col-12 mt-2 mb-2">
                                        <h5 style="color:#783E5D"><strong>Pago</strong> </h5>
                                    </div>

                                    <div class="col-4 ">
                                        <label for="name">¿Agregar envio? *</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio" id="flexRadioNo" value="No"
                                                @if ($cotizacion->envio == 'No') checked @endif>
                                            <label class="form-check-label" for="flexRadioNo">
                                                No
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio" id="flexRadioSi" value="Si"
                                                @if ($cotizacion->envio == 'Si') checked @endif>
                                            <label class="form-check-label" for="flexRadioSi">
                                                Si
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-4 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="toggleFacturaSi" name="factura" value="1" {{ $cotizacion->factura == '1' ? 'checked' : '' }}>

                                            <h4 class="form-check-h4" for="flexCheckDefault">
                                                <p class="" style="display: inline-block;font-size: 20px;padding: 5px;color: #3b8b00;">Si</p> <strong> (¿Factura?)</strong>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="name">Subtotal *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="subtotal_final" name="subtotal_final" type="text" class="form-control"  value="{{ $precio }}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Descuento</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="number" id="descuento_total" name="descuento_total" value="{{ $cotizacion->restante }}">
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="name">Total</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="total_final" name="total_final" type="text" class="form-control"  value="{{ $cotizacion->total }}" readonly>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn close-modal" style="background: #322338; color: #ffff">Guardar</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        $('.producto2').select2();
        const productos = @json($cotizacion_productos);
        let clienteData = null;

        function updateTotal() {
            let total = 0;

            document.querySelectorAll('.subtotal').forEach(subtotalElement => {
                const subtotalValue = parseFloat(subtotalElement.value.replace('$', '').replace(',', '')) || 0;
                total += subtotalValue;
            });

            document.querySelectorAll('.subtotal2').forEach(subtotalElement => {
                const subtotalValue = parseFloat(subtotalElement.value.replace('$', '').replace(',', '')) || 0;
                total += subtotalValue;
            });

            document.getElementById('subtotal_final').value = `$${total.toFixed(2)}`;

            const descuentoInput = document.getElementById('descuento_total');
            let descuentoPorcentaje = parseFloat(descuentoInput.value) || 0;

            let totalConDescuento = total - (total * (descuentoPorcentaje / 100));

            const facturaCheckbox = document.getElementById('toggleFacturaSi');
            if (facturaCheckbox.checked) {
                totalConDescuento += totalConDescuento * 0.16;
            }

            const envioCheckbox = document.querySelector('input[name="envio"]:checked');
            let costoEnvio = 0;

            if (envioCheckbox && envioCheckbox.value === 'Si') {
                if (clienteData && clienteData.status === 'activo') {
                    if (clienteData.membresia === 'Cosmos') {
                        costoEnvio = total >= 1500 ? 90 : 126;
                    } else if (clienteData.membresia === 'Estelar') {
                        costoEnvio = total >= 2500 ? 0 : 90;
                    }
                } else {
                    costoEnvio = 180; // Si el cliente no tiene membresía o no está activa, el costo de envío es 180
                }
            }

            totalConDescuento += costoEnvio;

            document.getElementById('total_final').value = `$${totalConDescuento.toFixed(2)}`;
        }

        function updateSubtotalExistente(id) {
            const cantidad = parseFloat(document.getElementById(`cantidad_${id}`).value) || 0;
            const descuento = parseFloat(document.getElementById(`descuento_${id}`).value) || 0;
            const precio_unitario = parseFloat(document.getElementById(`precio_unitario_${id}`).value) || 0;

            const subtotalSinDescuento = cantidad * precio_unitario;
            const descuentoMonto = (subtotalSinDescuento * descuento) / 100;
            const subtotalConDescuento = subtotalSinDescuento - descuentoMonto;

            document.getElementById(`subtotal_${id}`).value = `$${subtotalConDescuento.toFixed(2)}`;

            updateTotal();
        }

        productos.forEach(producto => {
            const cantidadInput = document.getElementById(`cantidad_${producto.id}`);
            const descuentoInput = document.getElementById(`descuento_${producto.id}`);
            const eliminarBtn = document.querySelector(`.eliminarCampo3[data-id="${producto.id}"]`);

            if (cantidadInput) {
                cantidadInput.addEventListener('input', () => updateSubtotalExistente(producto.id));
            }

            if (descuentoInput) {
                descuentoInput.addEventListener('input', () => updateSubtotalExistente(producto.id));
            }

            if (eliminarBtn) {
                eliminarBtn.addEventListener('click', () => eliminarProducto(producto.id));
            }
        });

        function eliminarProducto(productoId) {
            const productoDiv = document.querySelector(`.campo3[data-id="${productoId}"]`);

            if (productoDiv) {
                productoDiv.remove();
                updateTotal();
            }
        }

        document.getElementById('descuento_total').addEventListener('input', updateTotal);
        document.getElementById('toggleFacturaSi').addEventListener('change', updateTotal);

        document.querySelectorAll('input[name="envio"]').forEach(radio => {
            radio.addEventListener('change', updateTotal);
        });

        updateTotal();

        const camposContainer2 = document.getElementById('camposContainer2');

        document.getElementById('agregarCampo2').addEventListener('click', function() {
            const nuevoCampo = crearNuevoCampo();
            camposContainer2.appendChild(nuevoCampo);
            asignarEventos(nuevoCampo);
        });

        function crearNuevoCampo() {
            const campoTemplate = document.querySelector('.campo2');
            const nuevoCampo = campoTemplate.cloneNode(true);
            nuevoCampo.querySelector('.producto2').value = '';
            nuevoCampo.querySelector('.cantidad2').value = '';
            nuevoCampo.querySelector('.descuento_prod').value = '0';
            nuevoCampo.querySelector('.subtotal2').value = '';
            $(nuevoCampo).find('.producto2').removeClass('select2-hidden-accessible').next('.select2').remove();
            $(nuevoCampo).find('.producto2').select2();
            return nuevoCampo;
        }

        function eliminarCampo(campo) {
            campo.remove();
            updateTotal();
        }

        function asignarEventos(campo) {
            const productSelect = campo.querySelector('.producto2');
            const cantidadInput = campo.querySelector('.cantidad2');
            const descuentoInput = campo.querySelector('.descuento_prod');

            productSelect.addEventListener('change', function () {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const precio = parseFloat(selectedOption.dataset.precio_normal2) || 0;
                cantidadInput.value = 1;
                const descuento = parseFloat(descuentoInput.value) || 0;
                const subtotal = precio - (precio * (descuento / 100));
                campo.querySelector('.subtotal2').value = `$${subtotal.toFixed(2)}`;
                updateTotal();
            });

            const eliminarCampoBtn = campo.querySelector('.eliminarCampo');
            eliminarCampoBtn.addEventListener('click', function() {
                eliminarCampo(campo);
            });

            cantidadInput.addEventListener('input', function () {
                actualizarSubtotalNuevo(campo);
            });

            descuentoInput.addEventListener('input', function () {
                actualizarSubtotalNuevo(campo);
            });
        }

        function actualizarSubtotalNuevo(campo) {
            const productSelect = campo.querySelector('.producto2');
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const precio = parseFloat(selectedOption.dataset.precio_normal2) || 0;
            const cantidad = parseFloat(campo.querySelector('.cantidad2').value) || 0;
            const descuento = parseFloat(campo.querySelector('.descuento_prod').value) || 0;
            const subtotal = (precio * cantidad) - ((precio * cantidad) * (descuento / 100));
            campo.querySelector('.subtotal2').value = `$${subtotal.toFixed(2)}`;
            updateTotal();
        }

        document.querySelectorAll('.campo2').forEach(campo => {
            asignarEventos(campo);
        });

        // Obtener datos del cliente
        const clienteId = document.getElementById('id_cliente').value;
        if (clienteId) {
            $.ajax({
                url: '/get-descuento/' + clienteId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    clienteData = data;
                    updateTotal();
                }
            });
        }
    });
</script>
@endsection
