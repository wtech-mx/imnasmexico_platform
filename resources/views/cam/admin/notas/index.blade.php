@extends('layouts.app_admin')

@section('template_title')
Notas CAM
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Notas CAM</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                            @can('cursos-create')
                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Crear
                            </a>
                            @endcan
                            @include('cam.admin.notas.crear')
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Metodo Pago</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notas_cam as $nota_cam)
                                            <tr>
                                                <td>{{$nota_cam->id}}</td>
                                                <td><a href="{{ route('expediente.edit', $nota_cam->id) }}">{{$nota_cam->Cliente->name}}</a>
                                                <td>
                                                    @if ($nota_cam->Cliente->cliente == '4')
                                                        <label class="badge badge-sm" style="color: #009ee3;background-color: #009ee340;">Centro Evaluación</label>
                                                    @else
                                                        <label class="badge badge-sm" style="color: #746AB0;background-color: #746ab061;">Evaluador Independiente</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$nota_cam->metodo_pago}}
                                                    @if ($nota_cam->metodo_pago2 != NULL)
                                                        - {{$nota_cam->metodo_pago2}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $fecha = $nota_cam->created_at;
                                                        // Convertir a una marca de tiempo Unix
                                                        $timestamp = strtotime($fecha);
                                                        // Formatear la fecha
                                                        $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                                                        // Formatear la hora
                                                        $hora_formateada = date('h:i A', $timestamp);
                                                        // Combinar fecha y hora
                                                        $fecha_hora_formateada = $fecha_formateada . ' a las ' . $hora_formateada;
                                                    @endphp
                                                    {{ $fecha_hora_formateada}}
                                                </td>
                                            </tr>
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
<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>


<script>
    document.getElementById('tipo').addEventListener('change', function() {
        var membresiaContainer = document.getElementById('membresiaContainer');

        if (this.value === 'Centro Evaluación') {
            membresiaContainer.style.display = 'block';
        } else {
            membresiaContainer.style.display = 'none';
        }
    });
</script>

<script>
    document.getElementById('metodo_pago').addEventListener('change', function() {
        var fotoContainer = document.getElementById('fotoContainer');

        if (this.value === 'Transferencia') {
            fotoContainer.style.display = 'block';
        } else {
            fotoContainer.style.display = 'none';
        }
    });

    document.getElementById('metodo_pago2').addEventListener('change', function() {
        var fotoContainer2 = document.getElementById('fotoContainer2');

        if (this.value === 'Transferencia') {
            fotoContainer2.style.display = 'block';
        } else {
            fotoContainer2.style.display = 'none';
        }
    });
</script>
@endsection
