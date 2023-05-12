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
                                        <th>Productos</th>
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
                                            <td>
                                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#productos_nota_{{ $nota->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                    <i class="fa fa-fw fa-eye"></i>
                                                </a>
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
                                                @if ($nota->tipo == "Porcentaje")
                                                   {{ $nota->restante }}  % -
                                                @elseif ($nota->tipo == "Fijo")
                                                ${{ $nota->restante }}.0
                                                @endif

                                            </td>
                                            <td>{{ $nota->total }}</td>
                                            <td>
                                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_nota_{{ $nota->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                    <i class="fa fa-fw fa-edit"></i>
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
    var contadorCampos = 1;

    agregarCampoBtn.addEventListener('click', function() {
        var nuevoCampo = camposContainer.firstElementChild.cloneNode(true);
        actualizarNombresCampos(nuevoCampo);
        camposContainer.appendChild(nuevoCampo);
        contadorCampos++;
    });

    camposContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('eliminarCampo')) {
            var campo = event.target.parentNode.parentNode;
            campo.parentNode.removeChild(campo);
        }
    });

    function actualizarNombresCampos(campo) {
        var camposInput = campo.querySelectorAll('input[name^="campo"]');
        camposInput.forEach(function(input) {
            var nombreCampo = input.getAttribute('name');
            input.setAttribute('name', nombreCampo + contadorCampos);
        });
    }
});

</script>
@endsection


