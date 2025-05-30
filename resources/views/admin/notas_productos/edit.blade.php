@extends('layouts.app_admin')

@section('template_title')
    Notas Venta Edit
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
                        <form method="POST" action="{{ route('notas_productos.update', $cotizacion->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <h5 style="color:#836262"><strong>Datos del cliente</strong> </h5>
                                    </div>

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
                                        <h5 style="color:#836262"><strong>Productos Selecionados</strong> </h5>
                                    </div>

                                    @php
                                        $total = 0;
                                        $totalCantidad = 0;
                                    @endphp

                                    @foreach ($cotizacion_productos as  $productos)
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
                                                        <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="number" id="cantidad_{{ $productos->id }}" name="cantidad[]" class="form-control cantidad" style="width: 65%;" value="{{ $productos->cantidad }}">
                                                </div>
                                            </div>

                                            <div class="form-group col-2">
                                                <label for="descuento_{{ $productos->id }}">Descuento *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
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
                                                <label>&nbsp;</label>
                                                <div class="input-group mb-3">
                                                    <button type="button"
                                                            class="btn btn-danger btn-sm eliminarCampo3"
                                                            data-id="{{ $productos->id }}">
                                                    <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- Campo oculto para el precio unitario -->
                                            {{-- <input type="hidden" id="precio_unitario_{{ $productos->id }}" value="{{ $precio_unitario }}"> --}}
                                            <input type="hidden" id="precio_unitario_{{ $productos->id }}" value="{{ $originalPrecioUnitario }}">

                                            @php
                                                $subtotal = $productos->price;
                                                $total += $subtotal;
                                                $precio = $total;
                                            @endphp
                                        </div>
                                    @endforeach
                                    {{-- <div class="col-6 mt-2">
                                        <h5 style="color:#836262"><strong>Total</strong> </h5>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <h4 style="color:#836262"><strong>${{ $precio }}</strong> </h4>
                                    </div> --}}

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
                                                                <option value="{{ $product->nombre }}" data-precio_normal2="{{ $product->precio_normal }}">{{ $product->nombre }}</option>
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

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Metodo de pago</label>
                                            <select class="form-select" name="metodo_pago" id="metodo_pago">
                                                <option value="{{ $cotizacion->metodo_pago }}">{{ $cotizacion->metodo_pago }}</option>
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
                                            <input class="form-control" type="text" id="monto" name="monto" value="{{ $cotizacion->monto }}">
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="name">Foto Pago</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="file" id="foto_pago2" name="foto_pago2" value="{{ $cotizacion->foto_pago2 }}">
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="name">Metodo de pago 2</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/payment.png') }}" alt="" width="35px">
                                            </span>
                                            <select class="form-select" name="metodo_pago2" id="metodo_pago2">
                                                <option value="{{ $cotizacion->metodo_pago2 }}">{{ $cotizacion->metodo_pago2 }}</option>
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
                                            <input class="form-control" type="text" id="monto2" name="monto2" value="{{ $cotizacion->monto2 }}">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Comentario/nota</label>
                                            <textarea class="form-control" name="nota" id="nota" cols="30" rows="3">{{ $cotizacion->nota }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="name">Foto Pago</label>
                                        <div class="form-group">
                                            @if ($cotizacion->foto_pago2 == NULL)
                                                <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 250px; height: 300px;"/>
                                            @else
                                                <img id="blah" src="{{asset('pagos/'.$cotizacion->foto_pago2) }}" alt="Imagen" style="width: 250px; height: 300px;"/>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div id="deletedInputs"></div>
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
    $('.producto2').select2();
    const productos = @json($cotizacion_productos);

    productos.forEach(producto => {
        const cantidadInput = document.getElementById(`cantidad_${producto.id}`);
        const descuentoInput = document.getElementById(`descuento_${producto.id}`);
        const eliminarBtn = document.querySelector(`.eliminarCampo3[data-id="${producto.id}"]`);

        // Asignar eventos a los inputs de cantidad y descuento
        if (cantidadInput) {
            cantidadInput.addEventListener('input', () => updateSubtotalExistente(producto.id));
        }

        if (descuentoInput) {
            descuentoInput.addEventListener('input', () => updateSubtotalExistente(producto.id));
        }

        // Evento para eliminar producto
        if (eliminarBtn) {
            eliminarBtn.addEventListener('click', () => eliminarProducto(producto.id));
        }
    });

    // Función para actualizar subtotal de productos existentes
    function updateSubtotalExistente(productId) {
        const cantidadInput = document.getElementById(`cantidad_${productId}`);
        const descuentoInput = document.getElementById(`descuento_${productId}`);
        const precioUnitario = parseFloat(document.getElementById(`precio_unitario_${productId}`).value) || 0;

        const cantidad = parseFloat(cantidadInput.value) || 0;
        const descuento = parseFloat(descuentoInput.value) || 0;

        // Calcular el subtotal
        const subtotal = (precioUnitario * cantidad) - ((precioUnitario * cantidad) * (descuento / 100));
        document.getElementById(`subtotal_${productId}`).value = `$${subtotal.toFixed(2)}`;

        // Llamar a updateTotal para recalcular el total general
        updateTotal();
    }

    // Función para eliminar producto
    function eliminarProducto(productoId) {
        // 1) Agrega un input oculto dentro de #deletedInputs
        const input = document.createElement('input');
        input.type  = 'hidden';
        input.name  = 'deleted_productos[]';
        input.value = productoId;
        document.getElementById('deletedInputs').appendChild(input);

        // 2) Remueve la fila del DOM
        const fila = document.querySelector(`.campo3[data-id="${productoId}"]`);
        if (fila) fila.remove();

        // 3) Recalcula totales
        updateTotal();
    }
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const camposContainer2 = document.getElementById('camposContainer2');

        // Asignar eventos a los campos existentes, incluyendo el primero por defecto
        document.querySelectorAll('.campo2').forEach(campo => {
            asignarEventos(campo);
        });

        // Añadir campo de producto
        document.getElementById('agregarCampo2').addEventListener('click', function() {
            const nuevoCampo = crearNuevoCampo();
            camposContainer2.appendChild(nuevoCampo);
            asignarEventos(nuevoCampo);
        });

        function crearNuevoCampo() {
            const campoTemplate = document.querySelector('.campo2');
            const nuevoCampo = campoTemplate.cloneNode(true);

            // Limpia los valores de los inputs en el nuevo campo
            nuevoCampo.querySelector('.producto2').value = '';
            nuevoCampo.querySelector('.cantidad2').value = '';
            nuevoCampo.querySelector('.descuento_prod').value = '0';
            nuevoCampo.querySelector('.subtotal2').value = '';

            // Eliminar la clase 'select2-hidden-accessible' y el contenedor generado por select2 antes de clonar
            $(nuevoCampo).find('.producto2').removeClass('select2-hidden-accessible').next('.select2').remove();

            // Inicializar select2 después de clonar
            $(nuevoCampo).find('.producto2').select2();

            return nuevoCampo;
        }

        function eliminarCampo(campo) {
            campo.remove();
            updateTotal();  // Actualizar el total después de eliminar un campo
        }

        function asignarEventos(campo) {
            const productSelect = campo.querySelector('.producto2');
            const cantidadInput = campo.querySelector('.cantidad2');
            const descuentoInput = campo.querySelector('.descuento_prod');

            // Asignar evento de eliminación al botón correspondiente
            const eliminarCampoBtn = campo.querySelector('.eliminarCampo');
            eliminarCampoBtn.addEventListener('click', function() {
                eliminarCampo(campo);
            });

            productSelect.addEventListener('change', function () {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const precio = parseFloat(selectedOption.dataset.precio_normal2) || 0;
                cantidadInput.value = 1;
                const descuento = parseFloat(descuentoInput.value) || 0;
                const subtotal = precio - (precio * (descuento / 100));
                campo.querySelector('.subtotal2').value = `$${subtotal.toFixed(2)}`;
                updateTotal();
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

    });

    function updateTotal() {
        let total = 0;

        // Sumar subtotales de productos existentes
        const subtotalesExistentes = document.querySelectorAll('.subtotal');
        subtotalesExistentes.forEach(subtotalElement => {
            const subtotalValue = parseFloat(subtotalElement.value.replace('$', '').replace(',', '')) || 0;
            total += subtotalValue;
        });

        // Sumar subtotales de nuevos productos
        const subtotalesNuevos = document.querySelectorAll('.subtotal2');
        subtotalesNuevos.forEach(subtotalElement => {
            const subtotalValue = parseFloat(subtotalElement.value.replace('$', '').replace(',', '')) || 0;
            total += subtotalValue;
        });

        // Actualizar el subtotal final
        document.getElementById('subtotal_final').value = `$${total.toFixed(2)}`;

        // Obtener el valor del descuento
        const descuentoInput = document.getElementById('descuento_total');
        const descuentoPorcentaje = parseFloat(descuentoInput.value) || 0;

        // Calcular el total final con el descuento
        const totalConDescuento = total - (total * (descuentoPorcentaje / 100));

        // Actualizar el total final
        document.getElementById('total_final').value = `$${totalConDescuento.toFixed(2)}`;
    }

    // Escuchar cambios en el input de descuento
    document.getElementById('descuento_total').addEventListener('input', updateTotal);

    // Llamar a la función para calcular inicialmente
    updateTotal();

    document.querySelectorAll('.eliminarCampo3').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            eliminarProducto(id);
        });
    });
</script>





@endsection
