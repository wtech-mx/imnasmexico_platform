<!-- Card Basic Info -->
<div class="card mt-4" id="basic-info">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Crear cotizacion Cosmica
    </a>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
          @include('admin.clientes.perfil.cotizaciones.crear_cosmica')
        </div>
    </div>
</div>
<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Cotizaciones Cosmica</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush" id="datatable-cosmica">
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
                    @foreach ($cotizaciones_cosmica as $nota)
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
                                @if ($nota->estatus_cotizacion == NULL)
                                    <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $nota->id }}" title="Editar Estatus" style="background: #b600e3;">
                                        Pendiente
                                    </a>
                                @else
                                    {{$nota->estatus_cotizacion}}
                                @endif
                             </td>

                            <td>
                                @if($nota->total <= '700')

                                @else
                                    <a class="btn btn-xs" target="_blank"  href="{{ route('cotizacion_cosmica.meli_show', $nota->id) }}"  style="background: #FFE600; color: #ffff">
                                        <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="" style="width: 35px">
                                    </a>
                                @endif

                                <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $nota->id]) }}">
                                    <i class="fa fa-file"></i>
                                </a>

                                <a class="btn btn-sm btn-warning" href="{{ route('cotizacion_cosmica.edit', $nota->id) }}">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>

                                @if(isset($mensajesPorCotizacion[$nota->id]) && $mensajesPorCotizacion[$nota->id] > 0)
                                    <a class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#reporte_{{ $nota->id }}" title="Reporte" style="background: rgb(255, 255, 255); color:black">
                                        <i class="fa fa-commenting"></i>
                                    </a>
                                @else
                                    <a class="btn btn-xs btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#reporte_{{ $nota->id }}" title="Reporte" style="background: rgb(255, 255, 255); color:black">
                                        <i class="fa fa-comment"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @include('admin.cotizacion_cosmica.modal_estatus')
                        @include('admin.clientes.perfil.reporte_cosmica')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('datatable')
    <script>
        const dataTableCosmica = new simpleDatatables.DataTable("#datatable-cosmica", {
            deferRender:true,
            paging: true,
            pageLength: 10
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

                var clienteData = {
                    status: '{{ $distribuidora ? $distribuidora->membresia_estatus : '' }}',
                    membresia: '{{ $distribuidora ? $distribuidora->membresia : '' }}'
                };

                if (clienteData.status === 'Activa') {
                    var membresiaInfo = '';
                    if (clienteData.membresia === 'Cosmos') {
                        $('#descuento').val(40);
                        membresiaInfo = 'Membresía: Cosmos';
                        $('#descuento_prod').prop('disabled', false);
                    } else if (clienteData.membresia === 'Estelar') {
                        $('#descuento').val(60);
                        membresiaInfo = 'Membresía: Estelar';
                        $('#descuento_prod').prop('disabled', false);
                    }
                    $('#membresia-info').text(membresiaInfo);
                }

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

                    if (clienteData && clienteData.status === 'Activa') {
                        if (clienteData.membresia === 'Cosmos') {
                            costoEnvio = total >= 1500 ? 90 : 126;
                        } else if (clienteData.membresia === 'Estelar') {
                            costoEnvio = total >= 2500 ? 0 : 90;
                        }
                    }

                    var envioCheckbox = document.getElementById('checkboxEnvio');
                    if (envioCheckbox.checked) {
                        if (!clienteData || clienteData.status !== 'Activa') {
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

            // Manejar el cambio de estado del switch
            $('#toggleFactura').change(function () {
                // Mostrar u ocultar el div basado en el estado del switch
                $('#divFactura').toggle();
            });
        });
    </script>
@endsection
