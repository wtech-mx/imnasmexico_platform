@extends('layouts.app_admin')

@section('template_title')
    Edit Bundle
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
                        <form method="POST" action="{{ route('bundle.update', $cotizacion->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-12 mt-2 mb-3">
                                        <h2 style="color:#836262"><strong>Editar Bundle Products</strong> </h2>
                                    </div>

                                    <div class="form-group col-6">
                                        <h4 for="name">Nombre Paquete/kit *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/firma-digital.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="nombre" name="nombre" type="text" class="form-control"  value="{{$cotizacion->nombre}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <h4 for="name">Fecha de Finalizacion*</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="fecha_fin" name="fecha_fin" type="date" class="form-control" value="{{$cotizacion->fecha_fin}}" >
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <h4 for="name">Imagen de portada*</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="foto" name="foto" type="file" class="form-control">
                                        </div>

                                        @if ($cotizacion->imagenes == NULL)
                                            <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 50px; height: 50px;"/>
                                        @else
                                            <img id="blah" src="{{asset('products/'.$cotizacion->imagenes) }}" alt="Imagen" style="width: 50px; height: 50px;"/>
                                        @endif

                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/clic.png')}}" alt="" width="30px" >
                                            </span>
                                            <select name="categoria" id="categoria" class="form-select" >
                                                <option selected value="{{$cotizacion->categoria}}">{{$cotizacion->categoria}}</option>
                                                <option value="NAS">NAS</option>
                                                <option value="Cosmica">Cosmica</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12 mt-2">
                                        <h5 style="color:#836262"><strong>Productos Selecionados</strong> </h5>
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

                                            <div class="col-4">
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

                                            <div class="form-group col-4">
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
                                        <h5 class="mt-2">Seleciona mas productos </h5>
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
                                                        <div class="col-5">
                                                            <label for="">Producto</label>
                                                            <select id="producto" name="campo[]" class="form-select d-inline-block producto2">
                                                                <option value="">Seleccione productos</option>
                                                                @foreach ($products as $product)
                                                                <option value="{{ $product->nombre }}" data-precio_normal2="{{ $product->precio_normal }}">{{ $product->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-3">
                                                            <label for="name">Cantidad *</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="campo3[]" class="form-control d-inline-block cantidad2">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2" style="display: none">
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

                                                        <div class="form-group col-1">
                                                            <h4 for="name">-</h4>
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
                                        <label for="name">Total</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="total_final" name="total_final" type="text" class="form-control"  value="{{ $cotizacion->precio_normal }}" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Comentario/nota</label>
                                            <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3">{{ $cotizacion->descripcion }}</textarea>
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
        const productoDiv = document.querySelector(`.campo3[data-id="${productoId}"]`);

        if (productoDiv) {
            productoDiv.remove();
        }
        updateTotal(); // Actualizar total tras eliminar
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

        document.getElementById('subtotal_final').value = `$${total.toFixed(2)}`;
        document.getElementById('total_final').value = `$${total.toFixed(2)}`;
    }
</script>





@endsection
