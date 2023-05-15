@extends('layouts.app_admin')

@section('template_title')
    Notas Cursos
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

                            <h3 class="mb-3">Notas Cursos</h3>

                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#examplePaquete" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Paquetes
                            </a>

                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
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
                                            <th>Restante</th>
                                            <th>Fecha</th>
                                            <th>Paquete</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @foreach ($notas as $nota)
                                            <tr>

                                                    <td>{{ $nota->id }}</td>
                                                    <td>{{ $nota->User->name }}</td>

                                                    @if ($nota->restante == 0)
                                                    <td> <label class="badge badge-success" style="font-size: 13px;">Pagado</label> </td>
                                                    @elseif ($nota->restante >= 0)
                                                    <td> <label class="badge badge-danger" style="font-size: 15px;">${{ $nota->restante }}</label> </td>
                                                    @else
                                                    <td> <label class="badge badge-danger" style="font-size: 15px;">${{ $nota->restante }}</label> </td>
                                                    @endif
                                                    <td>{{ $nota->fecha }}</td>
                                                    <td>{{ $nota->paquete }}</td>
                                                    <td>
                                                        {{-- <a type="button" class="btn btn-sm" target="_blank"
                                                        href="https://wa.me/52{{$nota->User->phone}}?text=Hola%20{{$nota->User->name}},%20te%20enviamos%20tu%20nota%20el%20d%C3%ADa:%20{{ $nota->fecha }},%20vuelve%20pronto.%0D%0ADa+click+en+el+siguente+enlace%0D%0A%0D%0A{{route('notas.index_user', $nota->id)}}"
                                                        style="background: #00BB2D; color: #ffff">
                                                        <i class="fa fa-whatsapp"></i></a> --}}

                                                        <a type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#examplePago{{$nota->id}}">
                                                            <i class="fa fa-money"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-success" href="{{ route('notas_cursos.edit',$nota->id) }}"><i class="fa fa-eye"></i> </a>
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
    @include('admin.notas_cursos.create')
    @include('admin.notas_cursos.create_paquete')
@endsection

@section('datatable')

<script>

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
    });

    camposContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('eliminarCampo')) {
        var campo = event.target.closest('.campo');
        campo.parentNode.removeChild(campo);
        } else {
        var precios = camposContainer.querySelectorAll('select[name="campo[]"] option:checked');
        var total = 0;

        for (var i = 0; i < precios.length; i++) {
            total += parseFloat(precios[i].getAttribute('data-precio'));
        }

        totalInput.value = total.toFixed(2);

        // Calcular el descuento
        var descuento = parseFloat(descuentoInput.value);
        var totalDescuento = total - (total * (descuento / 100));
        totalDescuentoInput.value = totalDescuento.toFixed(2);
        }
    });

    descuentoInput.addEventListener('keyup', function() {
        var descuento = parseFloat(descuentoInput.value);
        var total = parseFloat(totalInput.value);
        var totalDescuento = total - (total * (descuento / 100));
        totalDescuentoInput.value = totalDescuento.toFixed(2);
    });
    });


</script>

<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>

  <script type="text/javascript">

    $(document).ready(function() {
        $('.cliente').select2();
    });

    $(document).ready(function() {
        $('.cliente2').select2();
    });

  </script>
@endsection

@section('select2')
    <script>
        function updatePrecio(selectElement) {
            var precioInput = selectElement.parentNode.querySelector('input[name="precio[]"]');
            var precio = selectElement.options[selectElement.selectedIndex].getAttribute('data-precio');
            precioInput.value = precio;
        }
    </script>
@endsection
