@extends('layouts.app_admin')

@section('template_title')
    {{ $cotizacion->folio }} Cosmica Cotizacion
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
        <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/sweetalert2.css') }}">
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
                        <form method="POST" action="{{ route('cotizacion_cosmica.update', $cotizacion->id) }}" enctype="multipart/form-data" role="form" id="formulario-cotizacion">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <h5>Cotizacion Cosmica #{{ $cotizacion->folio }}</h5>
                                        <h5 style="color:#783E5D"><strong>Datos del cliente</strong> </h5>
                                    </div>
                                    <input id="id_cliente" name="id_cliente" type="hidden" class="form-control" value="{{ $cotizacion->id_usuario }}" >
                                    @if ($cotizacion->id_usuario == NULL)

                                        <div class="form-group col-6">
                                            <label for="name">Nombre *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="25px">
                                                </span>
                                                <input id="name" name="name" type="text" class="form-control" value="{{ $cotizacion->nombre }}" >

                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="name">Telefono *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="25px">
                                                </span>
                                                <input id="telefono" name="telefono" type="number" class="form-control" value="{{ $cotizacion->telefono }}">
                                            </div>
                                        </div>

                                    @else

                                        <div class="form-group col-6">
                                            <label for="name">Nombre *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="25px">
                                                </span>
                                                <input id="name" name="name" type="text" class="form-control" value="{{ $cotizacion->User->name }}" >
                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="name">Correo *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="25px">
                                                </span>
                                                <input id="email" name="email" type="email" class="form-control" value="{{ $cotizacion->User->email }}">
                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="name">Telefono *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="25px">
                                                </span>
                                                <input id="telefono" name="telefono" type="number" class="form-control" value="{{ $cotizacion->User->telefono }}">
                                            </div>
                                        </div>

                                    @endif

                                    <div class="form-group col-6">
                                        <label for="name">Fecha *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="25px">
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
                                        $total_kits = 0;

                                        $kits = [
                                            ['id' => $cotizacion->id_kit, 'cantidad' => $cotizacion->cantidad_kit, 'descuento' => $cotizacion->descuento_kit],
                                            ['id' => $cotizacion->id_kit2, 'cantidad' => $cotizacion->cantidad_kit2, 'descuento' => $cotizacion->descuento_kit2],
                                            ['id' => $cotizacion->id_kit3, 'cantidad' => $cotizacion->cantidad_kit3, 'descuento' => $cotizacion->descuento_kit3],
                                            ['id' => $cotizacion->id_kit4, 'cantidad' => $cotizacion->cantidad_kit4, 'descuento' => $cotizacion->descuento_kit4],
                                            ['id' => $cotizacion->id_kit5, 'cantidad' => $cotizacion->cantidad_kit5, 'descuento' => $cotizacion->descuento_kit5],
                                            ['id' => $cotizacion->id_kit6, 'cantidad' => $cotizacion->cantidad_kit6, 'descuento' => $cotizacion->descuento_kit6],
                                        ];
                                        $precio_kit = 0;
                                    @endphp

                                    @foreach($kits as $index => $kit)
                                        @if($kit['id'])
                                        @php
                                            // 1) Carga el producto-kit
                                            $componentes = $cotizacion_productos->where('num_kit', $kit['id']);
                                            $kit_producto = \App\Models\Products::find($kit['id']);
                                            $precioBase   = $kit_producto->precio_normal ?? 0;
                                            $cantKit      = $kit['cantidad'] ?? 1;
                                            $desctoPct    = $kit['descuento'] ?? 0;

                                            // 2) Subtotal SIN descuento
                                            $subTotalKit = $precioBase * $cantKit;

                                            // 3) Aplica descuento y redondea
                                            $precioKitConDescuento = round(
                                                $subTotalKit * (1 - $desctoPct / 100),
                                                2
                                            );

                                            // 4) Acumula para el total general
                                            $total_kits += $precioKitConDescuento;
                                            $precio = $precio_kit;
                                        @endphp

                                            <div class="row campo_kit" data-kit-id="{{ $kit['id'] }}">
                                                <div class="col-3">
                                                    <label>Kit</label>
                                                    <input type="text" class="form-control" value="{{ $kit_producto->nombre }}" readonly>
                                                </div>

                                                <div class="form-group col-2">
                                                    <label>Cantidad *</label>
                                                    <input type="number" name="cantidad_kit[]" class="form-control cantidad_kit" value="{{ $kit['cantidad'] }}">
                                                </div>

                                                <div class="form-group col-2">
                                                    <label>Descuento *</label>
                                                   <input type="number" name="descuento_kit[]" class="form-control descuento_kit" value="{{ $kit['descuento'] }}" >
                                                </div>

                                                <div class="form-group col-3">
                                                    <label>Subtotal *</label>
                                                    <input type="text" class="form-control subtotal_kit" value="${{ number_format($precioKitConDescuento, 2) }}" readonly>
                                                </div>

                                                <div class="form-group col-2">
                                                    <h4 for="name">Quitar</h4>
                                                    <div class="input-group mb-3">
                                                        <button type="button" class="btn btn-danger btn-sm eliminarKit" data-kit-id="{{ $kit['id'] }}">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>


                                                <div class="col-12 mt-2">
                                                    <p><strong>Incluye:</strong></p>
                                                    <ul>
                                                        @foreach($componentes as $componente)
                                                            <li>({{ $componente->cantidad }}) {{ $componente->Productos->nombre ?? 'Producto' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <!-- Hidden inputs para cálculos JS -->
                                                <input type="hidden" class="precio_unitario_kit" value="{{ $kit_producto->precio_normal }}">
                                            </div>
                                        @endif
                                    @endforeach

                                    @php
                                        $kitsComponentes = $cotizacion_productos->where('kit', 1)->pluck('num_kit')->unique();
                                    @endphp
                                    @foreach ($cotizacion_productos as  $productos)
                                        @if($productos->num_kit == $kit['id'])
                                            <div class="row campo3" data-id="{{ $productos->id }}">
                                                {{-- @php
                                                    if($productos->cantidad != NULL){
                                                        $precio_unitario = $productos->price / $productos->cantidad;
                                                        $precio_format = number_format($productos->price, 0, '.', ',');
                                                        $precio_unitario_format = number_format($precio_unitario, 0, '.', ',');
                                                    }
                                                @endphp --}}

                                                @php
                                                // Saca el precio unitario original desde el producto “padre”
                                                $originalPrecioUnitario = optional($productos->Productos)->precio_normal
                                                                        ?? ($productos->price / $productos->cantidad);
                                                // Sigue mostrando el subtotal con descuento (si quieres mostrarlo igual)
                                                $precio_format = number_format($productos->price, 2, '.', ',');
                                                $precio = $precio_kit;
                                                @endphp

                                                <div class="col-3">
                                                    <label for="">Nombre</label>
                                                    <input type="text"  name="productos[]" class="form-control d-inline-block" value="{{ $productos->producto }}" readonly>
                                                    <p>Precio Catalogo ${{ $originalPrecioUnitario }}.0</p>

                                                </div>

                                                <div class="form-group col-2">
                                                    <label for="cantidad_{{ $productos->id }}">Cantidad *</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="number" id="cantidad_{{ $productos->id }}" name="cantidad[]" class="form-control cantidad" style="width: 65%;" value="{{ $productos->cantidad }}">
                                                    </div>
                                                </div>

                                                <div class="form-group col-2">
                                                    <label for="descuento_{{ $productos->id }}">Descuento *</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="number" id="descuento_{{ $productos->id }}" name="descuento[]" class="form-control descuento" value="{{ $productos->descuento }}">
                                                    </div>
                                                </div>

                                                <div class="form-group col-3">
                                                    <label for="subtotal_{{ $productos->id }}">Subtotal *</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="25px">
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
                                                {{-- <input type="hidden" id="precio_unitario_{{ $productos->id }}" value="{{ $precio_unitario }}"> --}}

                                                <input type="hidden" id="precio_unitario_{{ $productos->id }}" value="{{ $originalPrecioUnitario }}">


                                                @php
                                                    $subtotal = $productos->price;
                                                    $total += $subtotal;
                                                    $precio = $total + $total_kits;
                                                @endphp
                                            </div>
                                        @endif
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
                                                                    <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="25px">
                                                                </span>
                                                                <input type="number" name="campo3[]" class="form-control d-inline-block cantidad2 campo-cantidad">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2">
                                                            <label for="name">Descuento (%)</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="25px">
                                                                </span>
                                                                <input type="number" name="descuento_prod[]" class="form-control d-inline-block descuento_prod" value="0">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-3">
                                                            <label for="name">Subtotal *</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="25px">
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
                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="25px">
                                            </span>
                                            <input id="subtotal_final" name="subtotal_final" type="text" class="form-control"  value="{{ $precio }}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Descuento</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="25px">
                                            </span>
                                            <input class="form-control" type="number" id="descuento_total" name="descuento_total" value="{{ $cotizacion->restante }}">
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="name">Total</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                            </span>
                                            <input id="total_final" name="total_final" type="text" class="form-control"  value="{{ $cotizacion->total }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="costo_envio" name="costo_envio" value="0">

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
<!-- Sweetalert2 -->
<script type="text/javascript" src="{{ asset('assets/ecommerce/js/sweetalert2.all.min.js') }}"></script>
<script>
document.getElementById('formulario-cotizacion').addEventListener('submit', function(e) {
    const productosSeleccionados = document.querySelectorAll('.producto2'); // Productos nuevos seleccionados
    let productoConCantidadInvalida = false;
    let hayProductoSeleccionado = false;

    productosSeleccionados.forEach(producto => {
        const cantidadInput = producto.closest('.campo2').querySelector('input[name="campo3[]"]');
        if (producto.value !== "") { // Solo validar si un producto fue seleccionado
            hayProductoSeleccionado = true;

            if (!cantidadInput || cantidadInput.value.trim() === '' || isNaN(cantidadInput.value) || parseInt(cantidadInput.value) <= 0) {
                productoConCantidadInvalida = true;
            }
        }
    });

    if (hayProductoSeleccionado && productoConCantidadInvalida) {
        e.preventDefault(); // Cancela el envío del formulario
        alert('Por favor, asegúrate de ingresar una cantidad válida para cada producto nuevo seleccionado.');
    }
});


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

            document.querySelectorAll('.subtotal_kit').forEach(el => {
                const value = parseFloat(el.value.replace('$', '').replace(',', '')) || 0;
                total += value;
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

            document.getElementById('costo_envio').value = costoEnvio.toFixed(2);

            totalConDescuento += costoEnvio;

            document.getElementById('total_final').value = `$${totalConDescuento.toFixed(2)}`;
        }

        document.querySelectorAll('.campo_kit').forEach(kit => {
            const cantidadInput = kit.querySelector('.cantidad_kit');
            const descuentoInput = kit.querySelector('.descuento_kit');
            const precioUnitario = parseFloat(kit.querySelector('.precio_unitario_kit').value) || 0;
            const subtotalInput = kit.querySelector('.subtotal_kit');

            function updateKitSubtotal() {
                const cantidad = parseFloat(cantidadInput.value) || 0;
                const descuento = parseFloat(descuentoInput.value) || 0;

                let subtotal = cantidad * precioUnitario;
                subtotal -= (subtotal * (descuento / 100));

                subtotalInput.value = `$${subtotal.toFixed(2)}`;
                updateTotal();
            }

            cantidadInput.addEventListener('input', updateKitSubtotal);
            descuentoInput.addEventListener('input', updateKitSubtotal);
        });

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

            $(productSelect).on('select2:select', function (e) {
                const selectedValue = e.params.data.id;

                let duplicado = false;

                document.querySelectorAll('.producto2').forEach(select => {
                    if (select !== productSelect && select.value === selectedValue) {
                        duplicado = true;
                    }
                });

                if (duplicado) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Producto duplicado',
                        text: 'Este producto ya ha sido seleccionado.',
                    });
                    $(productSelect).val('').trigger('change');
                    campo.querySelector('.subtotal2').value = '';
                    return;
                }

                // Calcular subtotal si no es duplicado
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

        document.querySelectorAll('.eliminarKit').forEach(button => {
            button.addEventListener('click', function () {
                const kitId = this.dataset.kitId;
                const notaId = {{ $cotizacion->id }};

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Se eliminará el kit de la cotización.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#783E5D',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/cotizacion_cosmica/kit/${kitId}/nota/${notaId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.querySelector(`.campo_kit[data-kit-id="${kitId}"]`)?.remove();

                                document.querySelectorAll(`.campo3[data-id]`).forEach(producto => {
                                    const productoDataId = producto.dataset.id;
                                    const productoObj = productos.find(p => p.id == productoDataId);
                                    if (productoObj && productoObj.num_kit == kitId) {
                                        producto.remove();
                                    }
                                });

                                updateTotal();
                                Swal.fire('¡Eliminado!', 'El kit fue eliminado.', 'success');
                            }
                        });
                    }
                });
            });
        });


    });
</script>
@endsection
