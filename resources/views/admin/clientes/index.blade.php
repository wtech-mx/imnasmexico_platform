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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <form action="{{ route('advance_search.buscador') }}" method="GET" >

                                    <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                        <h5>Filtro</h5>
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="user_id">Seleccionar cliente:</label>
                                                    <select class="form-control cliente" name="id_client" id="id_client">
                                                        <option selected value="">seleccionar cliente</option>
                                                        @foreach($clientes as $client)
                                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="user_id">Seleccionar Telefono:</label>
                                                    <select class="form-control phone" name="phone" id="phone">
                                                        <option selected value="">seleccionar Telefono</option>
                                                        @foreach($clientes as $client)
                                                            <option value="{{ $client->id }}">{{ $client->telefono }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <br>
                                                    <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                                </div>
                                            </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                    <tbody>
                        @if(Route::currentRouteName() != 'clientes_admin.index')
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
                        @endif
                    </tbody>
                </table>
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
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
    searchable: true,
    fixedHeight: false
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.cliente').select2();
    });

    $(document).ready(function() {
        $('.phone').select2();
    });
</script>

@endsection
