@extends('layouts.app_admin')

@section('template_title')
Notas CAM
@endsection
@php
    $fecha = date('d-m-Y');
@endphp
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
                            @include('cam.notas.crear')
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
                                            <tr>
                                                <td>11</td>
                                                <th>Verplancken Sheila</th>

                                                <td>Centro Evaluación</td>
                                                <td>
                                                    <label class="badge badge-sm" style="color: #009ee3;background-color: #009ee340;">Mercado Pago</label>
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
                                                    <label class="badge badge-sm" style="color: #746AB0;background-color: #746ab061;">Efectivo</label>
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
<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection