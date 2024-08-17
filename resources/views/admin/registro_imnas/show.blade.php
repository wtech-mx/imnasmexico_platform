@extends('layouts.app_admin')

@section('template_title')
    R Registro IMNAS
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h3 class="mb-3"> {{$cliente->name}} </h3>
                        <h5 class="mb-3"> {{$cliente->telefono}} </h5>
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
                                            <th>Especialidad</th>
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
                                                <td>{{ $registro_imnas->nom_curso }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modal_imnas_documentos_{{ $registro_imnas->id }}">
                                                        <i class="fa fa-file"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#edit_guia_{{ $registro_imnas->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a type="button" class="btn btn-sm btn-success" href='https://api.whatsapp.com/send?phone={{ $cliente->telefono }}&text=Hola,%20te%20informamos%20que%20tus%20documentos%20ya%20est%C3%A1n%20listos%20y%20han%20sido%20enviados%20por%20paqueter%C3%ADa.%20Puedes%20rastrear%20tu%20env%C3%ADo%20utilizando%20el%20n%C3%BAmero%20de%20gu%C3%ADa:%20{{ $registro_imnas->num_guia }}.%20Si%20tienes%20alguna%20pregunta%20o%20necesitas%20m%C3%A1s%20informaci%C3%B3n,%20no%20dudes%20en%20contactarnos.' style="color: #ffffff" target="_blank">
                                                        <i class="fa fa-whatsapp"></i>
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
