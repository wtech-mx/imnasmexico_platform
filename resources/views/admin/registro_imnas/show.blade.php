@extends('layouts.app_admin')

@section('template_title')
    Registro IMNAS
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3"> {{$cliente->name}} </h3>


                            @can('cursos-create')
                                <a class="btn btn-sm btn-success" href="{{ route('cursos.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-edit"></i> Crear
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
                                            <th>Comentario</th>
                                            <th>Folio</th>
                                            <th>Guia</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registros_imnas as $registro_imnas)
                                            <tr>
                                                <td>
                                                    <p>
                                                        @if ($registro_imnas->nombre == NULL)
                                                            Sin registro
                                                        @else
                                                            {{ $registro_imnas->nombre }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td><p>{{ $registro_imnas->comentario_cliente }}</p></td>
                                                <td><p>{{ $registro_imnas->folio }}</p></td>
                                                <td><p>{{ $registro_imnas->num_guia }}</p></td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_imnas_documentos_{{ $registro_imnas->id }}">
                                                        <i class="fa fa-file"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#edit_guia_{{ $registro_imnas->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('admin.registro_imnas.modal_documento')
                                            @include('admin.registro_imnas.edit')
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
