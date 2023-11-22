@extends('layouts.app_admin')

@section('template_title')
    Recursos
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

                    <h3 class="mb-3">Biblioteca</h3>

                        <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                            ¿Como fucniona?
                        </a>

                        <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_recurso" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            <i class="fa fa-fw fa-edit"></i> Crear
                        </a>
                </div>
            </div>

            <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                <form action="{{ route('advance_recursos.buscador') }}" method="GET" >
                    <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                        <h5>Filtro</h5>
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-control cliente" name="nombre" id="nombre">
                                        <option selected value="">seleccionar carpeta</option>
                                        @foreach($recursos_buscador as $recurso)
                                            <option value="{{ $recurso->nombre }}">{{ $recurso->nombre }} - {{ $recurso->tipo }}</option>
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

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @if(Route::currentRouteName() != 'recursos.index')
                        @foreach ($recursos as $recurso)
                        <tr>
                            <td>{{ $recurso->id }}</td>
                            <th>{{ $recurso->nombre }}</th>
                            @if ($recurso->tipo == "Online")
                                <td> <label class="badge badge-sm" style="color: #009ee3;background-color: #009ee340;">Online</label> </td>
                            @else
                                <td> <label class="badge badge-sm" style="color: #746AB0;background-color: #746ab061;">Presencial</label> </td>
                            @endif
                            <td>
                                <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#edit_recurso{{ $recurso->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @include('admin.recursos.edit')
                        @endforeach
                    @endif
                </table>
            </div>
          </div>
        </div>
      </div>
</div>
@include('admin.recursos.create')
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
</script>

@endsection
