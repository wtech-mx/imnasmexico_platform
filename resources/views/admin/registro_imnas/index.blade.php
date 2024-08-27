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

                            <h3 class="mb-3">Registros IMNAS</h3>

                            <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                ¿Como fucniona?
                            </a>

                            <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#registro_imnas" title="Editar Estatus" style="background: #b600e3;">
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
                                            <th>Doc Pendientes</th>

                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registros_imnas as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    <a href=" {{ route('clientes.imnas', $item->User->code) }} " target="_blank" rel="noopener noreferrer" style="text-decoration: revert;color: blue;">
                                                        {{ $item->User->name }}
                                                    </a><br>
                                                    <p>{{ $item->User->telefono }}</p>
                                                    <p>{{ $item->User->email }}</p>
                                                    <p>{{ $item->User->escuela }}</p>

                                                </td>
                                                <td>-</td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#registro_imnas_edit_{{ $item->id }}">
                                                        Editar
                                                    </a>

                                                    <a class="btn btn-sm btn-info" href="{{ route('show_cliente.imnas', $item->User->code) }}" target="_blank">
                                                        Afiliaciones
                                                    </a>

                                                    <a class="btn btn-sm btn-succes" href="{{ route('contrato.edit', $item->User->code) }}" target="_blank">
                                                        Formato
                                                    </a>

                                                    <a class="btn btn-sm btn-success" href="{{ route('contrato_afiliacion.edit', $item->id) }}" target="_blank">
                                                        Contraro
                                                    </a>
                                                </td>
                                            </tr>

                                            @include('admin.registro_imnas.modal_edit')

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.registro_imnas.crear')

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
