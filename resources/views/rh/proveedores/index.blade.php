@extends('layouts.app_admin')

@section('template_title')
    Proveedores
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a href="{{ route('dashboard') }}" class="btn" style="background: {{$configuracion->color_boton_close}}; color: #ffff; margin-right: 3rem;">
                                Regresar
                            </a>
                            <span id="card_title">
                                Proveedores
                            </span>

                             <div class="float-right">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#proveedores" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-plus"></i>  Crear
                                  </button>
                              </div>
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
                                        <th>RFC</th>
                                        <th>Cuentas Bancarias</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                    <tbody>
                                        @foreach ($proveedores as $proveedor)
                                            <tr>
                                                <td>{{$proveedor->id}}</td>
                                                <td>{{$proveedor->nombre}}</td>
                                                <td>{{$proveedor->telefono}}</td>
                                                <td>{{$proveedor->rfc}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-xs btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cuentasModal{{$proveedor->id}}">
                                                        Ver cuentas registradas <img src="{{ asset('assets/cam/business-card-design.webp') }}" alt="" width="20px">
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editModal{{$proveedor->id}}">
                                                        <img src="{{ asset('assets/cam/editar.webp') }}" alt="" width="20px">Editar Proveedor
                                                    </button>

                                                    <button type="button" class="btn btn-xs btn-outline-success" data-bs-toggle="modal" data-bs-target="#editarModal{{$proveedor->id}}">
                                                        <img src="{{ asset('assets/cam/t credito.png.webp') }}" alt="" width="20px">Cuenta B
                                                    </button>
                                                </td>
                                            </tr>
                                            @include('rh.proveedores.modal_edit')
                                            @include('rh.proveedores.modal_crear_cuenta')
                                            @include('rh.proveedores.modal_cuentas')
                                        @endforeach
                                    </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('rh.proveedores.modal_create')

@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
