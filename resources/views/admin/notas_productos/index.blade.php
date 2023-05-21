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

                            <h3 class="mb-3">Notas Productos</h3>

                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_notas_productos" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
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
                                        {{-- <th>Productos</th> --}}
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
                                            <td>{{ $nota->User->name }}</td>
                                            {{-- <td>
                                                <a type="button" class="btn btn-sm bg-gradient-dark" data-bs-toggle="modal" data-bs-target="#productos_nota_{{ $nota->id }}" >
                                                    <i class="fa fa-fw fa-eye"></i>
                                                </a>
                                            </td> --}}
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
                                                <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_nota_{{ $nota->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </a>

                                                @php
                                                    $total = 0;$totalCantidad = 0;
                                                @endphp
                                                <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $nota->User->telefono }}&text=Nueva%20orden%20%0A--------------------------------%0A%0ANumero%20de%20Orden%20%20%20%20%3A%20%20{{ $nota->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0AEmail%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $nota->User->email }}%0ATelefono%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $nota->User->telefono }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php foreach ($nota->ProductosNotasId as $productos) { $precio = $productos->price; $cantidad = $productos->cantidad; $subtotal = $precio * $cantidad; $total += $subtotal; $precio = number_format($total, 2, '.', ','); echo $productos->producto . "%20$" . $productos->price . ".0%20%20x%20" . $productos->cantidad . "%0A"; } @endphp--------------------------------%0A%0ATipo de descuento%3A%20{{ $nota->tipo }}%0ADescuento%3A%20{{ $nota->restante }}%0ASubtotal%3A%20${{ $precio }}%0ATotal%3A%20${{$total_formateado = number_format($nota->total, 2, '.', ',')}}%0A">
                                                    <i class="fa fa-whatsapp"></i>
                                                </a>
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
    @include('admin.notas_productos.modal_create')
@endsection

@section('datatable')
<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });

    document.addEventListener('DOMContentLoaded', function() {
        var agregarCampoBtn = document.getElementById('agregarCampo');
        var camposContainer = document.getElementById('camposContainer');
        var campoExistente = camposContainer.querySelector('.campo');
        var totalInput = document.getElementById('total');
        var descuentoInput = document.getElementById('descuento');
        var totalDescuentoInput = document.getElementById('totalDescuento');

        agregarCampoBtn.addEventListener('click', function() {
            var nuevoCampo = campoExistente.cloneNode(true);
            camposContainer.appendChild(nuevoCampo);

            // Limpiar los valores en el nuevo campo
            nuevoCampo.querySelector('.producto').value = '';
            nuevoCampo.querySelector('.cantidad').value = '';

            // Asignar los eventos a los nuevos campos
            nuevoCampo.querySelector('.producto').addEventListener('change', actualizarSubtotal);
            nuevoCampo.querySelector('.cantidad').addEventListener('input', actualizarSubtotal);
        });

        camposContainer.addEventListener('change', function(event) {
            if (event.target.classList.contains('producto') || event.target.classList.contains('cantidad')) {
            actualizarSubtotal();
            }
        });

        function actualizarSubtotal() {
            var camposProductos = camposContainer.querySelectorAll('.campo .producto');
            var camposCantidades = camposContainer.querySelectorAll('.campo .cantidad');
            var subtotales = camposContainer.querySelectorAll('.campo .subtotal');
            var total = 0;

            for (var i = 0; i < camposProductos.length; i++) {
                var producto = camposProductos[i];
                var cantidad = camposCantidades[i];
                var subtotal = subtotales[i];

                var precio = parseFloat(producto.options[producto.selectedIndex].getAttribute('data-precio_normal'));
                var cantidadValor = parseInt(cantidad.value);

                var subtotalValor = isNaN(precio) || isNaN(cantidadValor) ? 0 : precio * cantidadValor;
                subtotal.value = subtotalValor.toFixed(2);

                total += subtotalValor;
            }
            totalInput.value = total.toFixed(2);
                console.log('totsl', total);

            // Calcular el descuento
            var descuento = parseFloat(descuentoInput.value);
            var totalDescuento = total - (total * (descuento / 100));
            totalDescuentoInput.value = totalDescuento.toFixed(2);
        }

        descuentoInput.addEventListener('keyup', function() {
            var descuento = parseFloat(descuentoInput.value);
            var total = parseFloat(totalInput.value);
            var totalDescuento = total - (total * (descuento / 100));
            totalDescuentoInput.value = totalDescuento.toFixed(2);
        });
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


