@extends('layouts.app_admin')

@section('template_title')
    Envios
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">

                    <h3 class="mb-3">Envios</h3>

                    <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como funciona?
                    </a>

                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Orden</th>
                            <th>Estatus</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($envios as $envio)
                    <tr>
                        <td>{{ $envio->id }}</td>
                        <td>{{ $envio->User->name }}</td>
                        <td>{{ $envio->User->telefono }}</td>
                        <td>{{ $envio->User->email }}</td>
                        <td>
                            # {{ $envio->Orders->id }}
                        </td>
                        <td>
                            {{ $envio->estatus }}
                        </td>
                        <td>
                            @php
                                 $precio = number_format($envio->Orders->pago, 2, '.', ',');
                            @endphp
                            $ {{ $precio }}
                        </td>
                        <td>
                            @can('envios-edit')
                                <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_envios_{{ $envio->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                    @include('admin.envios.modal_envios')
                    @endforeach
                </table>
            </div>
          </div>
        </div>
      </div>
</div>

@endsection
@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
