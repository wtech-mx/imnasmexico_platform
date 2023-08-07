@extends('layouts.app_admin')

@section('template_title')
Generar Documentos
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Generar Documentos </h3>
                    <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        ¿Como fucniona?
                    </a>
                    <a type="button" class="btn btn-sm bg-primary" data-bs-toggle="modal" data-bs-target="#create_manual" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        <i class="fa fa-fw fa-plus"></i> Crear
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($documentos as $item)
                    <tr>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->tipo }}</td>
                        <td>
                            <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#manual_update_{{ $item->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @include('admin.documentos.modal_update')
                    @endforeach
                </table>
            </div>
          </div>
        </div>
      </div>
</div>

@include('admin.documentos.modal_create')

@endsection
@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
