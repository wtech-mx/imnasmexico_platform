@extends('layouts.app_admin')

@section('template_title')
    Clientes
@endsection
@section('css')
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
{{-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> --}}
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
                <table class="table table-flush" id="orden_servicio">
                    <thead class="thead">
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
                            {{-- @can('client-documentos')
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
                            @endcan --}}
                        </td>
                    </tr>
                    {{-- @include('admin.clientes.modal_documentos')
                    @include('admin.clientes.modal_tickets')
                    @include('admin.clientes.modal_view') --}}
                    @endforeach

                </table>
            </div>

          </div>
        </div>
      </div>
</div>
@endsection

@section('datatable')

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

 <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script>
        $(document).ready(function() {
            $('#orden_servicio').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'excel',
                    'pdf',
                    'colvis'
                ],
                responsive: true,
                stateSave: true,

                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                }
            });
        });
</script>

@endsection
