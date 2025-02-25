@extends('layouts.app_admin')

@section('template_title')
    Notas Cursos
@endsection
<style>
    .right-panel {
        position: fixed;
        top: 0;
        right: -900px; /* Oculto inicialmente */
        width: 600px;
        height: 100%;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: right 0.3s ease;
        z-index: 999;
        overflow-y: auto;
    }

    .panel-content {
        padding: 20px;
        /* Estilos adicionales para el contenido del panel */
    }

    .close-btn {
        cursor: pointer;
        padding: 10px;
        background-color: #ddd;
        text-align: center;
        margin-top: 65px;
    }

    .selected-row {
        background-color: #f8d7da !important; /* Color rojo claro */
    }

</style>
@php
    $fecha = date('Y-m-d');
    $fechaHoraActual = new DateTime();
    $fechaHoraActualFormateada = $fechaHoraActual->format('Y-m-d\TH:i');
@endphp
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                            <h3 class="mb-3">Notas Cursos</h3>

                                <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                    ¿Como funciona?
                                </a>

                                <a  class="btn bg-gradient-primary" href="{{ route('notas_cursos.crear') }}">
                                    Crear
                                </a>
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Cliente</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @foreach ($notas as $nota)
                                            @if ($nota->paquete == NULL)
                                                <tr style="background-color: #d51d1d70;">
                                            @else
                                                @if ($nota->Order->estatus == '0')
                                                    <tr style="background-color: #d51d1d70;">
                                                @else
                                                        <tr>
                                                @endif
                                            @endif
                                                    <td>{{ $nota->id }}</td>
                                                    <td>{{ $nota->User->name }}</td>

                                                    <td>
                                                        @php
                                                        $fecha = $nota->fecha;
                                                        $fecha_timestamp = strtotime($fecha);
                                                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                        @endphp
                                                        {{$fecha_formateada}}
                                                    </td>
                                                    <td>
                                                        @if ($nota->paquete != NULL)
                                                            <a class="btn btn-sm btn-warning" href="{{ route('pagos.edit_pago',$nota->paquete) }}" target="_blank">Ver orden</a>
                                                        @endif

                                                        @if ($nota->paquete == NULL)
                                                            <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('notas_cursos.imprimir_canceladas', $nota->id) }}">
                                                                <i class="fa fa-file"></i>
                                                            </a>
                                                        @else
                                                            @if ($nota->Order->estatus == '0')
                                                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('notas_cursos.imprimir_canceladas', $nota->id) }}">
                                                                    <i class="fa fa-file"></i>
                                                                </a>
                                                            @else
                                                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('notas_cursos.imprimir', $nota->id) }}">
                                                                    <i class="fa fa-file"></i>
                                                                </a>
                                                            @endif
                                                        @endif

                                                    </td>
                                                </tr>
                                                @include('admin.notas_cursos.modal_pago')
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>

    @include('admin.notas_cursos.create_paquete')
@endsection

@section('select2')
<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        $('.cliente').select2();

        var agregarCampoBtn = document.getElementById('agregarCampo');
        var camposContainer = document.getElementById('camposContainer');
        var campoExistente = camposContainer.querySelector('.campo');
        var descuentoInput = document.getElementById('descuento');
        var totalInput = document.getElementById('total');
        var totalDescuentoInput = document.getElementById('totalDescuento');

        agregarCampoBtn.addEventListener('click', function() {
            var nuevoCampo = campoExistente.cloneNode(true);

            // Limpiar el select y el input de precio en el nuevo campo
            var nuevoSelect = nuevoCampo.querySelector('select');
            var nuevoPrecioInput = nuevoCampo.querySelector('input[name="precio[]"]');
            nuevoSelect.value = '';
            nuevoPrecioInput.value = '';

            // Agregar el nuevo campo al contenedor
            camposContainer.appendChild(nuevoCampo);
        });

        // Manejar el evento de cambio en el select
        camposContainer.addEventListener('change', function(event) {
            if (event.target.classList.contains('curso')) {
                var select = event.target;
                var precioInput = select.parentNode.querySelector('input[name="precio[]"]');
                var precio = select.options[select.selectedIndex].getAttribute('data-precio');
                precioInput.value = precio || '';
                actualizarTotal();
            }
        });

        // Manejar el evento de cambio en los inputs de precio
        camposContainer.addEventListener('input', function(event) {
            if (event.target.name === 'precio[]') {
                actualizarTotal();
            }
        });

        // Manejar el evento de cambio en el input de descuento
        descuentoInput.addEventListener('input', function() {
            aplicarDescuento();
        });

        // Función para actualizar el total
        function actualizarTotal() {
            var precios = document.querySelectorAll('input[name="precio[]"]');
            var total = 0;

            precios.forEach(function(precioInput) {
                var valor = parseFloat(precioInput.value) || 0;
                total += valor;
            });

            totalInput.value = total.toFixed(2); // Muestra el total con dos decimales
            aplicarDescuento(); // Recalcula el total con descuento aplicado
        }

        // Función para aplicar el descuento y actualizar el totalDescuento
        function aplicarDescuento() {
            var total = parseFloat(totalInput.value) || 0;
            var descuento = parseFloat(descuentoInput.value) || 0;
            var descuentoAmount = (descuento / 100) * total;
            var totalConDescuento = total - descuentoAmount;

            totalDescuentoInput.value = totalConDescuento.toFixed(2); // Muestra el total con descuento aplicado
        }
    });

    function openRightPanel() {
        document.getElementById("rightPanel").style.right = "0";
    }

    function closeRightPanel() {
        document.getElementById("rightPanel").style.right = "-600px";
    }

</script>
@endsection
