@extends('layouts.app_admin')

@section('template_title')
    Registro Bienvenida
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">
                            <h3 class="mb-3">Registros Bienvenida</h3>

                            <a type="button" class="btn btn-sm bg-danger" data-bs-toggle="modal" data-bs-target="#manual_instrucciones" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                ¿Como fucniona?
                            </a>
                        </div>
                        <div class="col-12">
                            <form class="row mt-3 mb-3" action="{{ route('registro_llegada.buscador') }}" method="GET" >
                                <div class="col-12">
                                    <h6>Filtro</h6>
                                </div>

                                <div class="col-6 col-md-4 col-lg-4 py-3">
                                    <label class="form-label tiitle_products">Fecha</label>
                                    <div class="input-group">
                                        <span class="input-group-text span_custom_tab" >
                                            <img class="icon_span_tab" src="{{ asset('assets/media/icons/cero.webp') }}" alt="" >
                                        </span>
                                        <input id="fecha" name="fecha" type="date"  class="form-control input_custom_tab">
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 col-lg-4 py-3">
                                    <label class="form-label tiitle_products">-</label>
                                    <div class="input-group">
                                        <button class="btn btn_filter" type="submit" style="">Filtrar
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre</th>
                                            <th>Telefono</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(Route::currentRouteName() != 'registro_llegada.index')
                                            @foreach ($compras as $compra)
                                                <tr>
                                                    <td>{{ $compra->id }}</td>
                                                    <td>{{ $compra->nombre }}</td>
                                                    <td>{{ $compra->telefono }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm bg-dark" data-bs-toggle="modal" data-bs-target="#modal{{ $compra->id }}" style="background: #52BE80; color: #ffff">
                                                            <i class="fas fa-folder-open"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('admin.registro_llegada.modal')
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

@endsection
