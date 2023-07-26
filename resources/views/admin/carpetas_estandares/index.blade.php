@extends('layouts.app_admin')

@section('template_title')
    Carpetas Estandares
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">


                            <h3 class="mb-3">Carpetas Estandares</h3>

                            @can('carpeta-estandares-create')
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                </a>
                            @endcan

                        </div>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Num de Archivos</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carpetas as $carpeta)
                                            <tr>
                                                <td>{{ $carpeta->nombre }}</td>
                                                <td>{{ $carpeta->CarpetaDocumentosEstandares->count()}}</td>
                                                <td>
                                                    @can('carpeta-estandares-edit')
                                                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_carpeta_{{ $carpeta->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                            <i class="fa fa-fw fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            @include('admin.carpetas_estandares.modal_edit')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

@include('admin.carpetas_estandares.create')
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
