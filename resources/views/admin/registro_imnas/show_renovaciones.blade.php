@extends('layouts.app_admin')

@section('template_title')
    Renovaciones IMNAS
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Renovaciones IMNAS</h3>

                            <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                ¿Como fucniona?
                            </a>

                            <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#renovar" title="Editar Estatus" style="background: #b600e3;">
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
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registros_imnas as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->fecha }}</td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#pagos_{{ $item->id }}">
                                                        Ver
                                                    </a>
                                                </td>
                                            </tr>

                                            @include('admin.registro_imnas.modal_pagos')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        @include('admin.registro_imnas.renovar')
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
