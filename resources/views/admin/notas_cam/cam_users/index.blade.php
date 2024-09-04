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

                            <h3 class="mb-3">Notas cam</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff">Regresar </a>

                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleNuevoModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                </a>

                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notas_cam as $nota_cam)
                                            <tr>
                                                <th>{{$nota_cam->Cliente->name}}</th>
                                                <th>
                                                    @if ($nota_cam->tipo == 'Centro Evaluación')
                                                        <label class="badge badge-sm" style="color: #009ee3;background-color: #009ee340;">Centro Evaluación</label>
                                                    @else
                                                        <label class="badge badge-sm" style="color: #746AB0;background-color: #746ab061;">Evaluador Independiente</label>
                                                    @endif
                                                </th>
                                                <td>
                                                    <a target="_blank" class="btn btn-xs btn-primary" href="{{ route('edit_independiente.citas', $nota_cam->Cliente->code) }}" >
                                                        Citas
                                                    </a>

                                                    <a target="_blank" class="btn btn-xs btn-danger" href="{{ route('edit_independiente.contrato', $nota_cam->Cliente->code) }}" >
                                                        Contrato
                                                    </a>

                                                    <a target="_blank" class="btn btn-xs btn-warning" href="{{ route('edit_independiente.carta', $nota_cam->Cliente->code) }}" >
                                                        Carta
                                                    </a>

                                                    <a target="_blank" class="btn btn-xs btn-success" href="{{ route('edit_independiente.formato', $nota_cam->Cliente->code) }}" >
                                                        Formato
                                                    </a>

                                                    <a target="_blank" class="btn btn-xs btn-dark" href="{{ route('edit_independiente.programa', $nota_cam->Cliente->code) }}" >
                                                        CHECK LIST
                                                    </a>

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
    @include('admin.notas_cam.cam_users.create')
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });

    var selectTipo = document.getElementById('tipo');
    var opcionesCentro = document.getElementById('opcionesCentro');
    var razonContainer = document.getElementById('razonContainer');
    var inputCosto = document.getElementById('costo');
    // Agrega un evento de cambio al select de tipo
    selectTipo.addEventListener('change', function() {
        var opcionSeleccionada = selectTipo.value;
        if (opcionSeleccionada === 'Evaluador Independiente') {
            opcionesCentro.style.display = 'none';
            razonContainer.style.display = 'none';
            inputCosto.value = costoEvaluador;
        } else {
            opcionesCentro.style.display = 'block';
            razonContainer.style.display = 'block';
        }
    });
</script>

@endsection
