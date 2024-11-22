@extends('layouts.app_admin')

@section('template_title')
    Bodega Entregados
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h2 class="mb-3">Notas ventas del Mes</h2>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-around">
                                <span class="badge rounded-pill text-dark" style="background: #F5ECE4">NAS Tienda Online</span>
                                <span class="badge rounded-pill text-white" style="background: #6ec7d1a3">NAS Tiendita</span>
                                <span class="badge rounded-pill text-white" style="background: #836262a3">NAS Cotizaciones Aprobadas</span>
                                <span class="badge rounded-pill text-white" style="background: #D486D6">Cosmica Cotizaciones Aprobadas</span>
                                <span class="badge rounded-pill text-white" style="background: #80486B">Cosmica Tienda Online</span>
                                <span class="badge rounded-pill text-white" style="background: #EE96BA">Paradisus</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a href="{{ route('index_preparacion.bodega') }}" class="nav-link {{ request()->routeIs('index_preparacion.bodega') ? 'active' : '' }}">
                                        En preparación <img src="{{ asset('assets/cam/box.png') }}" alt="" width="35px">
                                        <span class="badge rounded-pill bg-danger">{{ $cantidad_preparacion ?? 0 }}</span>
                                    </a>
                                    <a href="{{ route('index_preparados.bodega') }}" class="nav-link {{ request()->routeIs('index_preparados.bodega') ? 'active' : '' }}">
                                        Preparados <img src="{{ asset('assets/cam/package.png') }}" alt="" width="35px">
                                    </a>
                                    <a href="{{ route('index_enviados.bodega') }}" class="nav-link {{ request()->routeIs('index_enviados.bodega') ? 'active' : '' }}">
                                        Enviados <img src="{{ asset('assets/cam/delivery.png') }}" alt="" width="35px">
                                    </a>
                                    <a href="{{ route('index_entregados.bodega') }}" class="nav-link {{ request()->routeIs('index_entregados.bodega') ? 'active' : '' }}">
                                        Entregados <img src="{{ asset('assets/cam/delivery.png') }}" alt="" width="35px">
                                    </a>
                                    <a href="{{ route('index_canceladas.bodega') }}" class="nav-link {{ request()->routeIs('index_canceladas.bodega') ? 'active' : '' }}">
                                        Canceladas <img src="{{ asset('assets/cam/cerrar.png') }}" alt="" width="35px">
                                    </a>
                                </div>
                            </nav>

                              <div class="tab-content" id="nav-tabContent">

                                <table class="table table-flush" id="datatable-search4">

                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Estatus</th>
                                                <th>fecha Aprobada</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($notas_presencial_cancelada as $item)
                                                <tr style="background: #6ec7d1a3">
                                                    <td>
                                                        <h5>
                                                            @if ($item->folio == null)
                                                                {{ $item->id }}
                                                            @else
                                                                {{ $item->folio }}
                                                            @endif
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            @if ($item->id_usuario == NULL)
                                                                {{ $item->nombre }} <br> {{ $item->telefono }}
                                                            @else
                                                                {{ $item->User->name }}
                                                            @endif
                                                        </h5>
                                                    </td>

                                                    <td>
                                                        Pedido Tiendita
                                                    </td>

                                                    <td>
                                                        <h5>
                                                            {{ \Carbon\Carbon::parse($item->fecha_preparacion)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                        </tbody>
                                </table>

                              </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('datatable')

<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>


<script type="text/javascript">

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch3 = new simpleDatatables.DataTable("#datatable-search3", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch4 = new simpleDatatables.DataTable("#datatable-search4", {
        searchable: true,
        fixedHeight: false
    });


// Seleccionar todos los botones de envío
document.querySelectorAll('[id^="submitButtonEstatus"]').forEach(function(button) {
    button.addEventListener('click', function(event) {
        // Evitar múltiples clics
        event.preventDefault();

        // Obtener el ID del botón y su spinner correspondiente
        const id = this.id.replace('submitButtonEstatus', ''); // Obtener el ID del producto
        const spinner = document.getElementById('spinner' + id);

        // Deshabilitar el botón y mostrar el spinner
        this.disabled = true;
        spinner.classList.remove('d-none');

        // Enviar el formulario
        this.form.submit();
    });
});


</script>

@endsection


