<!-- Card Basic Info -->
<div class="card mt-4" id="basic-info">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Crear cotizacion Cosmica
    </a>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
          @include('admin.clientes.perfil.cotizaciones.crear_nas')
        </div>
    </div>
</div>
<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Cotizaciones NAS</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush" id="datatable-nas">
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
                    @foreach ($cotizaciones as $item)
                        <tr>
                            <th>
                                {{ $item->folio }}
                            </th>

                            <th>
                                @php
                                $fecha = $item->fecha;
                                $fecha_timestamp = strtotime($fecha);
                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                @endphp
                                {{$fecha_formateada}}
                            </th>

                             <td> {{$item->total}}</td>

                             <td>
                                @if($item->estatus_cotizacion == null)
                                    <a type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                        Cotizacion
                                    </a>
                                @elseif($item->estatus_cotizacion == 'Pendiente')
                                    <a type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                        Pendiene
                                    </a>
                                @elseif($item->estatus_cotizacion == 'Aprobada')
                                    <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                        Aprobada
                                    </a>
                                @elseif($item->estatus_cotizacion == 'Cancelada')
                                    <a type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                        Cencelada
                                    </a>
                                @else
                                    <a class="btn btn-xs btn-info">
                                        {{$item->estatus_cotizacion}}
                                    </a>
                                @endif
                            </td>

                            <td>
                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('notas_productos.imprimir', ['id' => $item->id]) }}">
                                    <i class="fa fa-file"></i>
                                </a>

                                <a class="btn btn-sm btn-warning" href="{{ route('notas_cotizacion.edit', $item->id) }}">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>

                                @if(isset($mensajesPorCotizacion[$item->id]) && $mensajesPorCotizacion[$item->id] > 0)
                                    <a class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#reporte_{{ $item->id }}" title="Reporte" style="background: rgb(255, 255, 255); color:black">
                                        <i class="fa fa-commenting"></i>
                                    </a>
                                @else
                                    <a class="btn btn-xs btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#reporte_{{ $item->id }}" title="Reporte" style="background: rgb(255, 255, 255); color:black">
                                        <i class="fa fa-comment"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @include('admin.cotizacion.modal_estatus')
                        @include('admin.clientes.perfil.reporte_nas')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('datatable')
    <script>
        const dataTableNas = new simpleDatatables.DataTable("#datatable-nas", {
            searchable: true,
            fixedHeight: false
        });
    </script>
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
