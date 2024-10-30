@extends('layouts.app_admin')

@section('template_title')
    Registro IMNAS Especialidad
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Registros IMNAS Especialidad</h3>

                            <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                ¿Como fucniona?
                            </a>
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Especialidad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($especialidades as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->especialidad }}</td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#registro_imnas_temario_{{ $item->id }}">
                                                        Ver
                                                    </a>
                                                </td>
                                            </tr>

                                            @include('admin.registro_imnas.modal_temario')

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

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

@endsection
