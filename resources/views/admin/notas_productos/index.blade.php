@extends('layouts.app_admin')

@section('template_title')
    Notas Productos
@endsection

@section('css')
 <!-- Select2  -->
 <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
 <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
 @endsection

@php
    $fecha = date('Y-m-d');
@endphp
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h2 class="mb-3">Notas Productos Del Mes</h2>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                            @can('nota-productos-crear')
                                <a class="btn btn-sm btn-success" href="{{ route('notas_productos.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff; font-size: 20px;">
                                    <i class="fa fa-fw fa-edit"></i> Crear
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card">
                        <form action="{{ route('advance_productos.buscador') }}" method="GET" >

                            <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                <h5>Filtro</h5>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="user_id">Seleccionar Usuario:</label>
                                            <select class="form-control administradores" name="administradores" id="administradores">
                                                <option selected value="">seleccionar Usuario</option>
                                                @foreach($administradores as $admin)
                                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <br>
                                            <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Cliente</th>
                                        <th>Tipo</th>
                                        <th>fecha</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notas as $nota)
                                        <tr>
                                            <td>
                                                <h5>
                                                    @if ($nota->folio == null)
                                                        {{ $nota->id }}
                                                    @else
                                                        {{ $nota->folio }}
                                                    @endif
                                                </h5>
                                            </td>
                                            <td>
                                                <h5>
                                                    @if ($nota->id_usuario == NULL)
                                                        {{ $nota->nombre }} <br> {{ $nota->telefono }}
                                                    @else
                                                        {{ $nota->User->name }}
                                                    @endif
                                                </h5>
                                            </td>
                                            <td>
                                                <h5>
                                                    @if ($nota->tipo_nota == 'Venta Presencial')
                                                        <label class="badge" style="color: #e39b00;background-color: #e3ae0040;">Venta Presencial</label>
                                                    @else
                                                        <label class="badge" style="color: #b600e3;background-color: #ae00e340;">Cotización</label>
                                                    @endif
                                                </h5>
                                            </td>
                                            <td>
                                                @php
                                                $fecha = $nota->fecha;
                                                $fecha_timestamp = strtotime($fecha);
                                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                @endphp
                                                <h5>
                                                    {{$fecha_formateada}}
                                                </h5>
                                            </td>
                                            <td><h5>${{ number_format($nota->total, 1, '.', ',') }}</h5></td>
                                            <td>
                                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('notas_productos.imprimir', ['id' => $nota->id]) }}">
                                                    <i class="fa fa-file"></i>
                                                </a>
                                                @php
                                                    $total = 0;$totalCantidad = 0;
                                                @endphp
                                                @can('nota-productos-whats')
                                                    @if ($nota->tipo_nota == 'Venta Presencial')
                                                        <a class="btn btn-xs btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $nota->id_usuario ? $nota->User->telefono : $nota->telefono }}&text=Venta%20presencial%0A--------------------------------%0A%0ANumero%20de%20Orden%20%20%20%20%3A%20%20{{ $nota->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php $total = 0; foreach ($nota->ProductosNotasId as $productos) { echo $productos->producto . "%20$" . number_format($productos->price, 2, '.', ',') . "%20%20x%20" . $productos->cantidad . "%0A";} @endphp--------------------------------%0A%0ADetalles%3A%20%0ASubtotal%3A%20${{ $total_formateado = number_format($nota->tipo, 2, '.', ',') }}{{ $nota->restante > 0 ? '%0A Descuento: '. $nota->restante .'%' : '' }}{{ $nota->envio == 'Si' ? '%0A Envío: $250' : '' }}{{ $nota->factura == 1 ? '%0A Factura: 16% ' : '' }}%0ATotal%3A%20${{ $total_formateado = number_format($nota->total, 2, '.', ',') }}%0A">
                                                                <i class="fa fa-whatsapp"></i>
                                                        </a>
                                                    @else
                                                    <a class="btn btn-xs btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $nota->id_usuario ? $nota->User->telefono : $nota->telefono }}&text=Cotizacion%20NAS%0A--------------------------------%0A%0ANumero%20de%20Cotizacion%20%20%20%20%3A%20%20{{ $nota->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php $total = 0; foreach ($nota->ProductosNotasId as $productos) { echo $productos->producto . "%20$" . number_format($productos->price, 2, '.', ',') . "%20%20x%20" . $productos->cantidad . "%0A";} @endphp--------------------------------%0A%0ADetalles%3A%20%0ASubtotal%3A%20${{ $total_formateado = number_format($nota->tipo, 2, '.', ',') }}{{ $nota->restante > 0 ? '%0A Descuento: '. $nota->restante .'%' : '' }}{{ $nota->envio == 'Si' ? '%0A Envío: $250' : '' }}{{ $nota->factura == 1 ? '%0A Factura: 16%' : '' }}%0ATotal%3A%20${{ $total_formateado = number_format($nota->total, 2, '.', ',') }}%0A">
                                                        <i class="fa fa-whatsapp"></i>
                                                    </a>
                                                    @endif
                                                @endcan
                                                @can('nota-productos-editar')
                                                    <a type="button" class="btn btn-xs bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_nota_{{ $nota->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                        <i class="fa fa-fw fa-edit"></i>
                                                    </a>
                                                @endcan
                                                <form action="{{ route('notas.eliminar', ['id' => $nota->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('¿Estás seguro de que deseas eliminar esta nota?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                        @include('admin.notas_productos.modal_edit')
                                        @include('admin.notas_productos.modal_products')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('datatable')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

 <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function() {
        $('.cliente').select2();
        $('.administradores').select2();
        $('.phone').select2();

        $('#datatable-search').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    text: 'Imprimir',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'excel',
                'pdf',
                'colvis'
            ],
            responsive: true,
            stateSave: true,

            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
            }
        });

    });



</script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        var agregarCampoBtn2 = document.getElementById('agregarCampo2');
        var camposContainer2 = document.getElementById('camposContainer2');
        var campoExistente2 = camposContainer2.querySelector('.campo2');

        agregarCampoBtn2.addEventListener('click', function() {
            var nuevoCampo2 = campoExistente2.cloneNode(true);
            camposContainer2.appendChild(nuevoCampo2);

            // Limpiar los valores en el nuevo campo
            nuevoCampo2.querySelector('.producto2').value = '';
            nuevoCampo2.querySelector('.cantidad2').value = '';

            // Asignar los eventos a los nuevos campos
            nuevoCampo2.querySelector('.producto2').addEventListener('change', actualizarSubtotal2);
            nuevoCampo2.querySelector('.cantidad2').addEventListener('input', actualizarSubtotal2);
        });

        camposContainer2.addEventListener('change', function(event) {
            if (event.target.classList.contains('producto2') || event.target.classList.contains('cantidad2')) {
            actualizarSubtotal2();
            }
        });

        function actualizarSubtotal2() {
            var camposProductos2 = camposContainer2.querySelectorAll('.campo2 .producto2');
            var camposCantidades2 = camposContainer2.querySelectorAll('.campo2 .cantidad2');
            var subtotales2 = camposContainer2.querySelectorAll('.campo2 .subtotal2');

            for (var i = 0; i < camposProductos2.length; i++) {
                var producto2 = camposProductos2[i];
                var cantidad2 = camposCantidades2[i];
                var subtotal2 = subtotales2[i];

                var precio2 = parseFloat(producto2.options[producto2.selectedIndex].getAttribute('data-precio_normal2'));
                var cantidadValor2 = parseInt(cantidad2.value);

                var subtotalValor2 = isNaN(precio2) || isNaN(cantidadValor2) ? 0 : precio2 * cantidadValor2;
                subtotal2.value = subtotalValor2.toFixed(2);

            }
        }
    });
</script>
@endsection


