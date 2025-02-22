@extends('layouts.app_admin')

@section('template_title')
    Crear kit
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
                        <form id="myForm" method="POST" action="{{ route('bundle.store') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="modal-body">
                                <div class="row">

                                    <div class="form-group col-6">
                                        <h4 for="name">Nombre Paquete/kit *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/firma-digital.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="nombre" name="nombre" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <h4 for="name">Fecha de Finalizacion*</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="fecha_fin" name="fecha_fin" type="date" class="form-control" value="{{$fecha}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <h4 for="name">Imagen de portada*</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="foto" name="foto" type="file" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/clic.png')}}" alt="" width="30px" >
                                            </span>
                                            <select name="categoria" id="categoria" class="form-select" required>
                                                <option value="">Seleciona una opcion</option>
                                                <option value="NAS">NAS</option>
                                                <option value="Cosmica">Cosmica</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12 mt-2">
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
                                                        <div class="col-5">
                                                            <h4 for="">Producto</h4>
                                                            <div class="form-group">
                                                                <select name="campo[]" class="form-select d-inline-block producto">
                                                                    <option value="">Seleccione products</option>
                                                                    @foreach ($products as $product)
                                                                    <option value="{{ $product->nombre }}" data-precio_normal="{{ $product->precio_normal }}" data-imagen="{{ $product->imagenes }}">{{ $product->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-3">
                                                            <h4 for="name">Cantidad *</h4>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="campo3[]" class="form-control d-inline-block cantidad" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2" style="display: none">
                                                            <h4 for="name">Descuento (%)</h4>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="descuento_prod[]" class="form-control d-inline-block descuento_prod" value="0">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-3">
                                                            <h4 for="name">Subtotal *</h4>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="text" name="campo4[]" class="form-control d-inline-block subtotal" readonly>
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
                                            <input class="form-control" type="text" id="totalDescuento" name="totalDescuento" >
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <h4 for="name">Comentario de promocion /kit</h4>
                                            <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn close-modal" id="saveButton" style="background: {{$configuracion->color_boton_save}}; color: #ffff; font-size: 17px;">Guardar</button>
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
        campoExistente.querySelector('.cantidad').value = '';
        var totalInput = document.getElementById('total');
        var descuentoInput = document.getElementById('descuento');
        var totalDescuentoInput = document.getElementById('totalDescuento');

        $(document).ready(function() {

            function formatProduct(producto) {
                if (!producto.id) {
                    return producto.text;
                }

                // Obtener la URL de la imagen desde el atributo data-imagen
                var imgUrl = $(producto.element).data('imagen');

                // Crear la estructura HTML para mostrar la imagen junto con el nombre del producto
                var $producto = $(
                    '<span><img src="' + imgUrl + '" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 10px;" />' + producto.text + '</span>'
                );
                return $producto;
            }

            // Inicializar Select2 con plantillas personalizadas
            $('.producto').select2({
                templateResult: formatProduct,  // Formateo del producto con imagen
                templateSelection: formatProduct,
                escapeMarkup: function(m) { return m; }
            });


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
            $('#agregarCampo').on('click', function() {
            // Clonar el campo existente
            var campoExistente = $('.campo').first(); // Selecciona el primer campo como base para clonar
            var nuevoCampo = campoExistente.clone();

            // Eliminar los elementos select2 previos generados
            nuevoCampo.find('.select2').remove(); // Elimina los contenedores internos de Select2

            // Limpiar los valores de los campos recién agregados
            nuevoCampo.find('.producto').val('').trigger('change'); // Limpiar select2
            nuevoCampo.find('.cantidad').val('');
            nuevoCampo.find('.descuento_prod').val('0');
            nuevoCampo.find('.subtotal').val('0.00');

            // Eliminar la instancia select2 previa y reinicializar con un nuevo ID único
            nuevoCampo.find('.producto').select2('destroy'); // Destruye la instancia select2 anterior
            nuevoCampo.find('.producto').attr('id', 'producto_' + Math.random().toString(36).substr(2, 9)); // Asigna un nuevo ID único

            // Volver a inicializar select2 después de clonar
            nuevoCampo.find('.producto').select2({
                templateResult: formatProduct,
                templateSelection: formatProduct,
                escapeMarkup: function(m) { return m; }
            });

            // Asociar eventos al nuevo campo de cantidad y descuento
            var cantidadInput = nuevoCampo.find('.cantidad')[0];
            var descuentoInput = nuevoCampo.find('.descuento_prod')[0];
            var productoInput = nuevoCampo.find('.producto')[0];
            asociarEventosCampos(cantidadInput, descuentoInput, productoInput);

            // Agregar evento para eliminar el nuevo campo
            nuevoCampo.find('.eliminarCampo').on('click', function() {
                eliminarCampo(nuevoCampo);
            });

            // Agregar el nuevo campo al contenedor
            $('#camposContainer').append(nuevoCampo);

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

        }

        // Llamar a la función inicialmente para establecer el valor inicial
        actualizarSubtotal();

        descuentoInput.addEventListener('keyup', function() {
            var descuento = parseFloat(descuentoInput.value);
            var total = parseFloat(totalInput.value);
            var totalDescuento = total - (total * (descuento / 100));
            totalDescuentoInput.value = totalDescuento.toFixed(2);
        });
    });


</script>
@endsection
