@extends('layouts.app_admin')

@section('template_title')
    Listas de Cursos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">


                            <h3 class="mb-3">Listas de Cursos</h3>

                            <a class="btn btn-sm btn-success" href="{{ route('cursos.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i> Agregar </a>

                        </div>
                    </div>
                    <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                        @foreach ($tickets as $ticket)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="#pills-home{{$ticket->id}}" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab{{$ticket->id}}">
                                    <i class="ni ni-folder-17 text-sm me-2"></i> {{$ticket->nombre}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($tickets as $ticket)
                            <div class="tab-pane fade show" id="pills-home{{$ticket->id}}" role="tabpanel" aria-labelledby="pills-home-tab{{$ticket->id}}">
                                <div class="card-body">
                                    <h5>{{$ticket->nombre}}</h5>
                                    <div class="table-responsive">
                                        <table class="table table-flush" id="datatable-search-{{$ticket->id}}">
                                            <thead class="thead">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nombre</th>
                                                    <th>Correo</th>
                                                    <th>Telefono</th>
                                                    <th>Fecha</th>

                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ordenes as $orden)
                                                    @if ($orden->id_tickets == $ticket->id && $orden->Orders->estatus == '1')
                                                        <tr>
                                                            <td>{{ $orden->id }}</td>

                                                            <td>{{ $orden->User->name }}</td>
                                                            <td>{{ $orden->User->email }}</td>
                                                            <td>{{ $orden->User->telefono }}</td>
                                                            <td>{{ $orden->Orders->fecha }}</td>

                                                            <td>

                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('datatable')

<script>

    @foreach ($tickets as $ticket)
    const dataTableSearch{{$ticket->id}} = new simpleDatatables.DataTable("#datatable-search-{{$ticket->id}}", {
      searchable: true,
      fixedHeight: false,
      buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    @endforeach
</script>

@endsection
