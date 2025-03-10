<!-- Card Basic Info -->
<div class="card mt-4" id="basic-info">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Crear Nota venta
    </a>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
          @include('admin.clientes.perfil.cotizaciones.crear_tiendita')
        </div>
    </div>
</div>
<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Compras</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush" id="datatable-tiendita">
                <thead class="thead">
                    <tr>
                        <th>Folio</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $nota)
                        <tr>
                            <th>
                                {{ $nota->folio }}
                            </th>

                            <th>
                                @php
                                $fecha = $nota->fecha;
                                $fecha_timestamp = strtotime($fecha);
                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                @endphp
                                {{$fecha_formateada}}
                            </th>

                             <td> {{$nota->total}}</td>
                             <td>
                                @if ($nota->estatus_cotizacion == 'Cancelar')
                                    Cancelada
                                @else
                                    @if ($nota->estatus_cotizacion ==  'Aprobada')
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#estatusModal{{$nota->id}}">
                                            <label class="badge" style="color: #e39b00;background-color: #e3ae0040;">Venta Presencial</label><br>
                                            Pendiente de entregar
                                        </a>
                                    @else
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#estatusModal{{$nota->id}}">
                                        <label class="badge" style="color: #e39b00;background-color: #e3ae0040;">Venta Presencial</label><br>
                                        Entregado
                                    </a>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('notas_productos.imprimir', ['id' => $nota->id]) }}">
                                    <i class="fa fa-file"></i>
                                </a>
                            </td>
                        </tr>
                        @include('admin.notas_productos.modal_estatus')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('datatable')
    <script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        const dataTableTiendita = new simpleDatatables.DataTable("#datatable-tiendita", {
            deferRender:true,
            paging: true,
            pageLength: 10
        });
    </script>
    <script>

        document.getElementById('myForm').addEventListener('submit', function (e) {
            const idClient = document.getElementById('id_client').value;
            const name = document.getElementById('name').value;
            const telefono = document.getElementById('telefono').value;

            // Referencia al botón de guardar
            const saveButton = document.getElementById('saveButton');

            // Validar las condiciones
            if (!idClient && (!name || !telefono)) {
                e.preventDefault(); // Evita el envío del formulario
                alert('Debe seleccionar un cliente o ingresar los datos de un nuevo cliente.');
                saveButton.disabled = false; // Asegura que el botón se habilite si no se cumplen las validaciones
                saveButton.innerHTML = 'Guardar'; // Restaura el texto original
                return;
            }

            // Deshabilita el botón si las validaciones se pasan
            saveButton.disabled = true;
            saveButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...';

        });


        document.addEventListener('DOMContentLoaded', function() {
            var agregarCampoBtn = document.getElementById('agregarCampo');
            var camposContainer = document.getElementById('camposContainer');
            var campoExistente = camposContainer.querySelector('.campo');
            campoExistente.querySelector('.cantidad').value = '';
            var totalInput = document.getElementById('total');
            var descuentoInput = document.getElementById('descuento');
            var totalDescuentoInput = document.getElementById('totalDescuento');

            $(document).ready(function() {
                $('.cliente').select2();

                var clienteData = null;
                $('#id_client').on('change', function() {
                var clienteId = $(this).val();

                if (clienteId) {
                    $.ajax({
                        url: '/admin/notas/ventas/get-descuento/' + clienteId,
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

            // $('#myForm').on('submit', function() {
            //     // Deshabilita el botón al enviar el formulario
            //     $('#saveButton').prop('disabled', true);
            // });

            $(document).on('keydown', function(event) {
                // Detecta si la tecla presionada es Enter (keyCode 13)
                if (event.key === 'Enter') {
                    event.preventDefault(); // Evita el envío del formulario
                }
            });
        });
    </script>
@endsection
