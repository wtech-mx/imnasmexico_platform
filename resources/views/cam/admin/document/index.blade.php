@extends('layouts.app_admin')

@section('template_title')
Documentos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Documentos</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                            @can('cursos-create')
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                </a>
                            @endcan
                            @include('cam.admin.document.crear_carp')

                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nombre</th>
                                            <th>Categoria</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carpeta_docs as $carpeta_doc)
                                            <tr class="text-center">
                                                <td>{{$carpeta_doc->id}}</td>
                                                <th>{{$carpeta_doc->nombre}}</th>
                                                <th>{{$carpeta_doc->categoria}}</th>

                                                <td>
                                                    <a class="btn btn-sm btn-success" href="{{ route('edit.documentos', $carpeta_doc->id) }}" title="Editar"><i class="fa fa-fw fa-edit"></i> </a>
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

@endsection
