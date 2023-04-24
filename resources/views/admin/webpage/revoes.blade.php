@extends('layouts.app_admin')

@section('template_title')
    Revoes
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->


            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">RVOES</h3>

                    @can('usuarios-create')
                    <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_revoe" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        Crear Revoe
                    </a>
                    @endcan

                </div>
            </div>

            @can('usuarios-create')
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Num de Revoe</th>
                            <th width="280px">Acciones</th>
                        </tr>
                    </thead>

                    @foreach ($revoes as $revoe)
                    <tr>
                        <td>{{ $revoe->id }}</td>
                        <th><img id="blah" src="{{asset('revoes/'.$revoe->image) }}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                        <td>{{ $revoe->name }}</td>
                        <td>{{ $revoe->num_revoe }}</td>
                        <td>
                            @can('client-edit')
                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_revoe_{{ $revoe->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i>
                            </a>
                            @endcan
                        </td>
                    </tr>

                    @include('admin.webpage.modal_revoe_edit')

                    @endforeach

                </table>
                </div>
            @endcan

          </div>
        </div>
      </div>
</div>

@include('admin.webpage.modal_revoe_create')

@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
