@extends('layouts.app_admin')

@section('template_title')
    Usuarios
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->


            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Usuarios</h3>
                    <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como funciona?
                    </a>
                    @can('usuarios-create')
                    <a class="btn" href="{{ route('users.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">Crear usuario</a>
                    @endcan

                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                        <th>No</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Roles</th>
                        <th width="280px">Acciones</th>
                        </tr>
                    </thead>

                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->telefono }}</td>
                            <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                            </td>

                            <td>
                                @can('usuarios-edit')
                                <a class="btn btn-sm btn-success" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                @endcan
                                {{-- @can('usuarios-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display: contents;']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm ',]) !!}
                                {!! Form::close() !!}
                                @endcan --}}
                            </td>

                        </tr>
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
