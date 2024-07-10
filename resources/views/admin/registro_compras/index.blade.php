@extends('layouts.app_admin')

@section('template_title')
    Registro Compras
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">
                            <h3 class="mb-3">Registros Compras</h3>

                            <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                ¿Como fucniona?
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
                                            <th>Telefono</th>
                                            <th>Monto</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registros_imnas as $registro_imnas)
                                            <tr>
                                                <td>{{ $registro_imnas->id }}</td>
                                                <td>
                                                    <a href=" {{ route('perfil.show', $registro_imnas->User->id) }} " target="_blank" rel="noopener noreferrer" style="text-decoration: revert;color: blue;">{{ $registro_imnas->User->name }}</a><br>
                                                    <p>{{ $registro_imnas->User->telefono }}</p>
                                                    <p>{{ $registro_imnas->User->email }}</p>
                                                </td>
                                                <td>-</td>
                                                <td>
                                                    <a class="btn btn-sm btn-info" href="{{ route('show_cliente.imnas', $registro_imnas->User->code) }}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
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

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

@endsection
