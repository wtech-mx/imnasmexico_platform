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
                                            <th>Fecha Emisión</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($expedientes as $expediente)
                                                <tr>
                                                    <td>{{$expediente->Nota->id}}</td>
                                                    <th>{{$expediente->Nota->Cliente->name}}</th>

                                                    <td>{{$expediente->Nota->tipo}}</td>
                                                    <td>
                                                        @php
                                                            $fecha = $expediente->created_at;
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

                                                    <td>
                                                        <a class="btn btn-sm btn-success" href="{{ route('expediente.edit', $expediente->Nota->id) }}" title="Editar"><i class="fa fa-fw fa-edit"></i> </a>
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
