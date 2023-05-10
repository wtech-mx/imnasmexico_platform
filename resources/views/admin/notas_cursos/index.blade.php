@extends('layouts.app_admin')

@section('template_title')
    Notas Cursos
@endsection
@php
    $fecha = date('Y-m-d');
@endphp
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h3 class="mb-3">Notas Cursos</h3>

                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
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
                                            <th>Cliente</th>
                                            <th>Restante</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @foreach ($notas as $nota)
                                            <tr>

                                                    <td>{{ $nota->id }}</td>
                                                    <td>{{ $nota->User->name }}</td>

                                                    @if ($nota->restante == 0)
                                                    <td> <label class="badge badge-success" style="font-size: 13px;">Pagado</label> </td>
                                                    @elseif ($nota->restante >= 0)
                                                    <td> <label class="badge badge-danger" style="font-size: 15px;">${{ $nota->restante }}</label> </td>
                                                    @else
                                                    <td> <label class="badge badge-danger" style="font-size: 15px;">${{ $nota->restante }}</label> </td>
                                                    @endif
                                                    <td>{{ $nota->fecha }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm" target="_blank"
                                                        href="https://wa.me/52{{$nota->User->phone}}?text=Hola%20{{$nota->User->name}},%20te%20enviamos%20tu%20nota%20el%20d%C3%ADa:%20{{ $nota->fecha }},%20vuelve%20pronto.%0D%0ADa+click+en+el+siguente+enlace%0D%0A%0D%0A{{route('notas.index_user', $nota->id)}}"
                                                        style="background: #00BB2D; color: #ffff">
                                                        <i class="fa fa-whatsapp"></i></a>

                                                            {{-- <a class="btn btn-sm btn-success" href="{{ route('nota.edit',$nota->id) }}"><i class="fa fa-fw fa-edit"></i> </a> --}}
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
    @include('admin.notas_cursos.create')
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>
@endsection


