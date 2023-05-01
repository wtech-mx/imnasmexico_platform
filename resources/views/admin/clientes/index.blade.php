@extends('layouts.app_admin')

@section('template_title')
    Clientes
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Clientes</h3>
                    <form action="{{ route('clientes.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Importar Usuarios</button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>telefono</th>
                            <th>email</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->name }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>
                            <a type="button" class="btn bg-dark" data-bs-toggle="modal" data-bs-target="#modal_documentos{{ $cliente->id }}" style="background: #52BE80; color: #ffff">
                                <i class="fas fa-folder-open"></i>
                            </a>
                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#ticket_cliente_{{ $cliente->id }}" style="background: #52BE80; color: #ffff">
                                <i class="fas fa-ticket-alt"></i>
                            </a>
                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_cliente_{{ $cliente->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @include('admin.clientes.modal_documentos')
                    @include('admin.clientes.modal_tickets')
                    @include('admin.clientes.modal_view')
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
