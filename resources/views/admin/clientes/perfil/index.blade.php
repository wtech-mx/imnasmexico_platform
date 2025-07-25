@extends('layouts.app_admin')

@section('template_title')
    Perfil Cliente
@endsection

@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        @if (Route::currentRouteName() == 'peril_cliente.index')
                            <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                <a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #322338; color: #ffffff;">
                                    <i class="fa fa-fw fa-edit"></i> Crear Distribuidora
                                </a>

                                <h5>Filtro</h5>
                                <form action="{{ route('peril_cliente.buscador') }}" method="GET" >
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="user_id">Seleccionar # Cliente:</label>
                                            <select class="form-control id" name="id_clienta" id="id_clienta"></select>
                                        </div>
                                        <div class="col-3">
                                            <label for="user_id">Seleccionar Cliente:</label>
                                            <select class="form-control name" name="name" id="name"></select>
                                        </div>
                                        <div class="col-3">
                                            <label for="user_id">Seleccionar Telefono:</label>
                                            <select class="form-control phone" name="phone" id="phone"></select>
                                        </div>
                                        <div class="col-3">
                                            <br>
                                            <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                <a class="btn btn-sm mb-0 mt-sm-0 mt-1" href="{{route('peril_cliente.index')}}" style="background-color: #F82018; color: #ffffff;">Buscar otro cliente</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
          </div>

          <main class="main-content max-height-vh-100 h-100">
            <div class="container-fluid my-5 py-2">
                <div class="row mb-5">
                    @if(Route::currentRouteName() != 'peril_cliente.index')
                        <div class="col-lg-3">
                            <div class="card position-sticky top-1">
                            <ul class="nav flex-column bg-white border-radius-lg p-3">
                                @if ($tipo == 'Usuario')
                                    <li class="nav-item">
                                    <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.informacion', $cliente->id)}}">
                                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('assets/cam/woman.png') }}"width="30px" >
                                        </div>
                                        <span class="text-sm">Informacion Basica</span>
                                    </a>
                                    </li>
                                @endif
                                @if ($tipo == 'Usuario')
                                    <li class="nav-item pt-2">
                                        <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.cursos', $cliente->id)}}">
                                            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('assets/cam/elearning.png') }}"width="30px" >
                                            </div>
                                            <span class="text-sm">Cursos</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.compras_tiendita', $cliente->telefono)}}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('assets/cam/shopping-cart.png') }}"width="30px" >
                                    </div>
                                    <span class="text-sm">Compras tiendita</span>
                                </a>
                                </li>
                                <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.cotizaciones_nas', $cliente->telefono)}}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <img src="https://lh3.googleusercontent.com/d/1KpzCr4lID6U5foSXsNtQ4pXklupFAGz3=w800?authuser=0"width="50px" >
                                    </div>
                                    <span class="text-sm">Cotizaciones NAS</span>
                                </a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.cotizaciones_cosmica', $cliente->telefono)}}">
                                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('/cosmika/menu/logo.png') }}"width="50px" >
                                        </div>
                                        <span class="text-sm">Cotizaciones Cosmica</span>
                                    </a>
                                </li>
                                @if ($tipo == 'Usuario')
                                    <li class="nav-item pt-2">
                                        <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.compras_expos', $cliente->telefono)}}">
                                            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('/assets/cam/delivery.png') }}"width="40px" >
                                            </div>
                                            <span class="text-sm">Compras expos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item pt-2">
                                        <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.reposicion', $cliente->id)}}">
                                            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('/assets/cam/return.png') }}"width="40px" >
                                            </div>
                                            <span class="text-sm">Reposición</span>
                                        </a>
                                    </li>

                                    <li class="nav-item pt-2">
                                        <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.membresia_cosmica', $cliente->id)}}">
                                            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('assets/cam/membrecia.png') }}"width="30px" >
                                            </div>
                                            <span class="text-sm">Membresia Cosmica</span>
                                        </a>
                                    </li>
                                @endif
                                @if ($tipo == 'Usuario')
                                    <li class="nav-item pt-2">
                                        <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.estandares', $cliente->id)}}">
                                            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('assets/cam/contrato.png') }}"width="30px" >
                                            </div>
                                            <span class="text-sm">Estandares</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            </div>
                        </div>
                    @endif
                  <div class="col-lg-9 mt-lg-0 mt-4">
                    @if (Route::currentRouteName() != 'peril_cliente.index')
                    <div class="card card-body" id="profile">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-auto col-4">
                                <div class="avatar avatar-xl position-relative">
                                    @if ($tipo == 'Usuario')
                                        <img src="{{ asset('assets/cam/medico.png') }}" alt="bruce" class="w-100 border-radius-lg shadow-sm">
                                    @else
                                        <img src="{{ asset('assets/cam/woman.png') }}" alt="bruce" class="w-100 border-radius-lg shadow-sm">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-auto col-8 my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1 font-weight-bolder">
                                        @if ($tipo == 'Usuario')
                                           <a href="{{ route('perfil.show', $cliente->id) }}" target="_blank"> {{$cliente->name}} </a>
                                        @else
                                            {{$cliente->nombre}}
                                        @endif
                                    </h5>
                                    <p class="mb-0 font-weight-bold text-sm">
                                        @if ($tipo == 'Usuario')
                                            {{$cliente->telefono}} <br>
                                            A{{$cliente->id}}
                                        @else
                                            {{$cliente->telefono}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                                @if ($tipo == 'Usuario')
                                    @if ($distribuidora == NULL)
                                        <div class="h-100">
                                            <h4>No tiene membresia</h4>

                                            @if ($cliente->reconocimiento == NULL)
                                                <h4 style="color: #940f0b">No tiene diploma cargado</h4>
                                            @else
                                                <h4 style="color: #7cc00e">Diploma cargado</h4>
                                            @endif
                                        </div>
                                    @else
                                        <div class="h-100">
                                            <h5 class="mb-1 font-weight-bolder">
                                                Membresia: {{$distribuidora->membresia}}
                                            </h5>
                                            @if ($distribuidora->membresia_estatus == 'Activa')
                                                <p class="mb-0 font-weight-bold text-sm" style="color: #358a13">
                                                    {{$distribuidora->membresia_estatus}}
                                                </p>
                                            @else
                                                <p class="mb-0 font-weight-bold text-sm" style="color: #8a3f13">
                                                    {{$distribuidora->membresia_estatus}}
                                                </p>
                                            @endif
                                            @if ($cliente->reconocimiento == NULL)
                                                <h4 style="color: #940f0b">No tiene diploma cargado</h4>
                                            @else
                                                <h4 style="color: #7cc00e">Diploma cargado</h4>
                                            @endif
                                        </div>
                                    @endif
                                @else
                                    <h5>No es alumno</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.buscador' || Route::currentRouteName() == 'peril_cliente.informacion')
                        @if ($tipo == 'Usuario')
                            @include('admin.clientes.perfil.basic_info')
                        @endif
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.cursos')
                        @include('admin.clientes.perfil.cursos')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.compras_tiendita')
                        @include('admin.clientes.perfil.compras')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.cotizaciones_nas')
                        @include('admin.clientes.perfil.cotizacion_nas')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.cotizaciones_cosmica')
                        @include('admin.clientes.perfil.cotizacion_cosmica')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.compras_expos')
                        @include('admin.clientes.perfil.compras_expos')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.reposicion')
                        @include('admin.clientes.perfil.reposicion')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.membresia_cosmica')
                        @include('admin.clientes.perfil.membresia')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.estandares')
                        @include('admin.clientes.perfil.estandares')
                    @endif
                  </div>
                </div>
              </div>
            </main>
        </div>
      </div>
</div>
@include('cosmica.distribuidoras.modal_create')
@endsection

@section('datatable')
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
    searchable: true,
    fixedHeight: false
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.id').select2({
            placeholder: 'Buscar ID',
            ajax: {
                url: '{{ route('peril_cliente.searchId') }}', // Ruta para buscar por ID
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    // Si el usuario escribe "A100", eliminamos la "A" antes de enviar la consulta
                    let searchTerm = params.term;
                    if (searchTerm && searchTerm.startsWith('A')) {
                        searchTerm = searchTerm.substring(1); // Eliminar la "A"
                    }
                    return {
                        q: searchTerm // Enviar el término de búsqueda al backend
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: 'A' + item.id, // Mostrar el ID con "A"
                                id: item.id          // Usar el ID como valor
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('.phone').select2({
            placeholder: 'Buscar Teléfono',
            ajax: {
                url: '{{ route('peril_cliente.searchPhone') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.telefono,
                                id: item.telefono
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('.name').select2({
            placeholder: 'Buscar Nombre',
            ajax: {
                url: '{{ route('peril_cliente.searchName') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.name
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });
</script>

@endsection
