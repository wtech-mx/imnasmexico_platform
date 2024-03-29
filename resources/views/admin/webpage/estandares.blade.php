@extends('layouts.app_admin')

@section('template_title')
    Estandares
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->


            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                    <h3 class="mb-3">Estandares</h3>
                    <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como funciona?
                    </a>
                    @can('usuarios-create')
                    <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_estandar" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        Crear estandar
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
                            <th>Num de estandar</th>
                            <th width="280px">Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($estandares as $estandar)
                    <tr>
                        <td>{{ $estandar->id }}</td>
                        <th><img id="blah" src="{{asset('estandares/'.$estandar->image) }}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                        <td>{{ $estandar->name }}</td>
                        <td>{{ $estandar->num_estandar }}</td>
                        <td>
                            @can('client-edit')
                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_estandar_{{ $estandar->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-edit"></i> </a>
                            @endcan
                        </td>
                    </tr>
                    @include('admin.webpage.modal_estandar_edit')
                    @endforeach

                </table>
            </div>
            @endcan

          </div>
        </div>
      </div>
</div>
@include('admin.webpage.modal_estandar_create')

@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
