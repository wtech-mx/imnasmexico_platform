@extends('layouts.app_admin')

@section('template_title')
    Notas Productos
@endsection

@section('css')
 <!-- Select2  -->
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
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h3 class="mb-3">Notas Productos Del Mes</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                            @can('nota-productos-crear')
                                <a class="btn btn-sm btn-success" href="{{ route('notas_productos.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
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
                                        {{-- <div class="col-3">
                                            <label for="user_id">Seleccionar cliente:</label>
                                            <select class="form-control cliente" name="id_client" id="id_client">
                                                <option selected value="">seleccionar cliente</option>
                                                @foreach($clientes as $client)
                                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="user_id">Seleccionar Telefono:</label>
                                            <select class="form-control phone" name="phone" id="phone">
                                                <option selected value="">seleccionar Telefono</option>
                                                @foreach($clientes as $client)
                                                    <option value="{{ $client->id }}">{{ $client->telefono }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
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
                                        <th>Metodo de Pago</th>
                                        <th>fecha</th>
                                        <th>Descuento</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notas as $nota)
                                        <tr>
                                            <td>{{ $nota->id }}</td>
                                            <td>
                                                @if ($nota->id_usuario == NULL)
                                                    {{ $nota->nombre }} <br> {{ $nota->telefono }}
                                                @else
                                                    {{ $nota->User->name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($nota->tipo_nota == 'Venta Presencial')
                                                    <label class="badge" style="color: #e39b00;background-color: #e3ae0040;">Venta Presencial</label>
                                                @else
                                                    <label class="badge" style="color: #b600e3;background-color: #ae00e340;">Cotización</label>
                                                @endif
                                            </td>
                                            @if ($nota->metodo_pago == "Efectivo")
                                                <td> <label class="badge" style="color: #009ee3;background-color: #009ee340;">Efectivo</label> </td>
                                            @elseif ($nota->metodo_pago == "Tarjeta Credito/debito")
                                                <td> <label class="badge" style="color: #746AB0;background-color: #746ab061;">Tarjeta Credito/debito</label> </td>
                                            @elseif ($nota->metodo_pago == "Transferencia")
                                                <td> <label class="badge" style="color: #746AB0;background-color: #746ab061;">Transferencia</label> </td>
                                            @endif
                                            <td>
                                                @php
                                                $fecha = $nota->fecha;
                                                $fecha_timestamp = strtotime($fecha);
                                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                @endphp
                                                {{$fecha_formateada}}
                                            </td>
                                            <td>
                                                  - {{ $nota->restante }}  %

                                            </td>
                                            <td>{{ $nota->total }}</td>
                                            <td>
                                                @can('nota-productos-editar')
                                                    <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_nota_{{ $nota->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                        <i class="fa fa-fw fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @php
                                                    $total = 0;$totalCantidad = 0;
                                                @endphp
                                                @can('nota-productos-whats')
                                                    @if ($nota->tipo_nota == 'Venta Presencial')
                                                    <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $nota->id_usuario ? $nota->User->telefono : $nota->telefono }}&text=Venta%20presencial%0A--------------------------------%0A%0ANumero%20de%20Orden%20%20%20%20%3A%20%20{{ $nota->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php $total = 0; foreach ($nota->ProductosNotasId as $productos) { echo $productos->producto . "%20$" . number_format($productos->price, 2, '.', ',') . "%20%20x%20" . $productos->cantidad . "%0A";} @endphp--------------------------------%0A%0ADetalles%3A%20%0ADescuento%3A%20{{ $nota->restante }}%0ASubtotal%3A%20${{ $total_formateado = number_format($nota->tipo, 2, '.', ',') }}%0ATotal%3A%20${{ $total_formateado = number_format($nota->total, 2, '.', ',') }}%0A">
                                                            <i class="fa fa-whatsapp"></i>
                                                        </a>
                                                    @else
                                                    <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $nota->id_usuario ? $nota->User->telefono : $nota->telefono }}&text=Cotizacion%20NAS%0A--------------------------------%0A%0ANumero%20de%20Cotizacion%20%20%20%20%3A%20%20{{ $nota->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php $total = 0; foreach ($nota->ProductosNotasId as $productos) { echo $productos->producto . "%20$" . number_format($productos->price, 2, '.', ',') . "%20%20x%20" . $productos->cantidad . "%0A";} @endphp--------------------------------%0A%0ADetalles%3A%20%0ADescuento%3A%20{{ $nota->restante }}%0ASubtotal%3A%20${{ $total_formateado = number_format($nota->tipo, 2, '.', ',') }}%0ATotal%3A%20${{ $total_formateado = number_format($nota->total, 2, '.', ',') }}%0A">
                                                        <i class="fa fa-whatsapp"></i>
                                                    </a>
                                                    @endif
                                                @endcan
                                                <form action="{{ route('notas.eliminar', ['id' => $nota->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta nota?')">Eliminar Nota</button>
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
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.cliente').select2();
    });

    $(document).ready(function() {
        $('.administradores').select2();
    });

    $(document).ready(function() {
        $('.phone').select2();
    });
</script>
<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
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


