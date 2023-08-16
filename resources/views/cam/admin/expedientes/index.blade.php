@extends('layouts.app_admin')

@section('template_title')
Expedientes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Expedientes</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                            @can('cursos-create')
                            <a class="btn btn-sm btn-success" href="{{ route('view.expediente') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
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
                                            <th>No</th>
                                            <th>Img</th>
                                            <th>Nombre</th>
                                            <th>fecha inicio</th>
                                            <th>fecha final</th>
                                            <th>modalidad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td>11</td>
                                                <th>Espinosa Verplancken Sheila Dayanna</th>

                                                <td>Evaluador Ind.</td>
                                                <td>
                                                    <label class="badge badge-sm" style="color: #009ee3;background-color: #009ee340;">Fase 2</label>
                                                </td>
                                                <td>
                                                    15/07/2023
                                                </td>

                                                <td>
                                                    @can('cursos-edit')
                                                        <a class="btn btn-sm btn-success" href="#" title="Editar"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <th>Espinosa   Dayanna</th>

                                                <td>Evaluador Ind.</td>
                                                <td>
                                                    <label class="badge badge-sm" style="color: #746AB0;background-color: #746ab061;">Fase 3</label>
                                                </td>
                                                <td>
                                                    15/07/2023
                                                </td>

                                                <td>
                                                    @can('cursos-edit')
                                                        <a class="btn btn-sm btn-success" href="#" title="Editar"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @endcan
                                                </td>
                                            </tr>
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
