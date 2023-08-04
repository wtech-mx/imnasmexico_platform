@extends('layouts.app_admin')

@section('template_title')
    Clientes
@endsection

@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Clientes</h3>
                    {{-- <form action="{{ route('clientes.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Importar Usuarios</button>
                    </form> --}}
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>
                            <a href=" {{ route('perfil.show', $cliente->id) }} " target="_blank" rel="noopener noreferrer" style="text-decoration: revert;color: blue;">
                                {{ $cliente->name }}
                            </a>
                        </td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>
                            @can('client-documentos')
                                <a type="button" class="btn bg-dark" data-bs-toggle="modal" data-bs-target="#modal_documentos{{ $cliente->id }}" style="background: #52BE80; color: #ffff">
                                    <i class="fas fa-folder-open"></i>
                                </a>
                            @endcan
                            @can('client-compras')
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#ticket_cliente_{{ $cliente->id }}" style="background: #52BE80; color: #ffff">
                                    <i class="fas fa-ticket-alt"></i> {{ $cliente->Orders->count()}}
                                </a>
                            @endcan
                            @can('client-edit')
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_cliente_{{ $cliente->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                    @include('admin.clientes.modal_documentos')
                    @include('admin.clientes.modal_tickets')
                    @include('admin.clientes.modal_view')
                    @endforeach

                </table>
            </div>
            {{ $clientes->links('pagination::bootstrap-4') }}
          </div>
        </div>
      </div>
</div>
@endsection

@section('datatable')

<script>
$(document).ready(function() {
    $('#datatable-search').DataTable({
        searching: true,
        pageLength: 150,
        scrollY: '400px', // Ajusta la altura de la tabla según tus necesidades
        scrollCollapse: true,
        // Resto de las opciones y configuraciones que desees agregar
    });
});

</script>

@endsection
