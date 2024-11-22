@extends('layouts.app_admin')

@section('template_title')
    Historial Productos
@endsection
@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                    <h3 class="mb-3">Productos Historial Vendidos</h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>


                </div>
                <div class="col-12">
                    <form class="row mt-3 mb-3" action="{{ route('products_historial.filtro') }}" method="GET" >
                        <div class="col-12">
                            <h6>Filtro</h6>
                        </div>

                        <div class="col-6 col-md-4 col-lg-4 py-3">
                            <label class="form-label tiitle_products">Rango Fecha de</label>
                            <div class="input-group">
                                <span class="input-group-text span_custom_tab" >
                                    <img class="icon_span_tab" src="{{ asset('assets/media/icons/cero.webp') }}" alt="" >
                                </span>
                                <input id="fecha_inicial_de" name="fecha_inicial_de" type="date"  class="form-control input_custom_tab @error('fecha_inicial_de') is-invalid @enderror"  value="{{ old('fecha_inicial_de') }}" autocomplete="" autofocus>
                            </div>
                        </div>

                        <div class="col-6 col-md-4 col-lg-4 py-3">
                            <label class="form-label tiitle_products">hasta </label>
                            <div class="input-group">
                                <span class="input-group-text span_custom_tab" >
                                    <img class="icon_span_tab" src="{{ asset('assets/media/icons/9.webp') }}" alt="" >
                                </span>
                                <input id="fecha_inicial_a" name="fecha_inicial_a" type="date"  class="form-control input_custom_tab @error('fecha_inicial_a') is-invalid @enderror"  value="{{ old('fecha_inicial_a') }}" autocomplete="" autofocus>
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
                    {{-- <a class="btn btn-info" href="{{ route('productsHistorialVendidos.index') }}">
                        Borrar filtro
                    </a> --}}
                    <form class="row mt-3 mb-3" action="{{ route('products_historial.pdf') }}" method="GET" >
                        <div class="col-3">
                            <button class="btn btn-dark" type="submit" style="">Imprimir PDF</button>
                        </div>
                        @if(Route::currentRouteName() != 'productsHistorialVendidos.index')
                            <input type="date" name="fecha_inicial_de" value="{{ request('fecha_inicial_de') }}" style="display: none">
                            <input type="date" name="fecha_inicial_a" value="{{ request('fecha_inicial_a') }}" style="display: none">
                        @else
                            <input type="date" name="fecha_inicial_de" value="{{ date('Y-m-d') }}" style="display: none">
                            <input type="date" name="fecha_inicial_a" value="{{ date('Y-m-d') }}" style="display: none">
                        @endif
                    </form>
                </div>
            </div>


            <div class="table-responsive p-4">
                        <table class="table table-flush" id="datatable-search">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="3">#</th>
                                    <th colspan="3">IMG</th>
                                    <th colspan="3">Nombre</th>
                                </tr>
                            </thead>

                            @foreach ($HistorialVendidos as $productoId => $ventas)
                            <tr style="background-color: #0560776c">
                                <td colspan="3"><h5>{{ $productoId }}</h5></td>
                                <td colspan="3">
                                    <img id="blah" src="{{ $ventas->first()->Products->imagenes }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                </td>
                                <td colspan="3">
                                   <h5>{{ $ventas->first()->Products->nombre }}</h5>
                                </td>
                            </tr>

                            @foreach ($ventas->groupBy(function($venta) {
                                return \Carbon\Carbon::parse($venta->created_at)->format('d \d\e F \d\e\l Y');
                            }) as $fecha => $ventasPorFecha)
                                <tr class="text-center">
                                    <td colspan="9" style="background-color: #d9edf7;">
                                       <h5>{{ $fecha }}</h5>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <th colspan="2">Stock Viejo</th>
                                    <th colspan="1">Cantidad Restado</th>
                                    <th colspan="2">Stock Actual</th>
                                    <th colspan="2">Nota</th>
                                    <th colspan="2">Fecha y hora</th>
                                </tr>

                                @php
                                    $sumaCantidadRestado = 0;
                                @endphp

                                @foreach ($ventasPorFecha as $venta)
                                    @php
                                        $sumaCantidadRestado += $venta->cantidad_restado;
                                    @endphp
                                    <tr class="text-center">
                                        <td colspan="2">{{ $venta->stock_viejo }}</td>
                                        <td colspan="1">{{ $venta->cantidad_restado }}</td>
                                        <td colspan="2">{{ $venta->stock_actual }}</td>
                                        <td colspan="2">
                                            @if ($venta->id_cotizacion_nas != NULL)
                                               Nas: {{ $venta->NotasProductos->folio }}
                                            @elseif ($venta->id_cotizacion_cosmica != NULL)
                                               Cosmica: {{ $venta->NotasProductosCosmica->folio }}
                                            @elseif ($venta->id_venta_nas != NULL)
                                               Tiendita: {{ $venta->NotasProductosVentas->folio }}
                                            @elseif ($venta->id_paradisus != NULL)
                                               Paradisus: {{ $venta->id_paradisus }}
                                            @elseif ($venta->id_nas_online != NULL)
                                               Nas Online: {{ $venta->id_nas_online }}
                                            @elseif ($venta->id_cosmica_online != NULL)
                                               Cosmica Online: {{ $venta->id_cosmica_online }}
                                            @endif


                                        </td>
                                        <td colspan="2">{{ Carbon::parse($venta->created_at)->locale('es')->translatedFormat('d F Y h:i a') }}</td>
                                    </tr>
                                @endforeach

                                <!-- Fila para mostrar la suma de cantidad restado -->
                                <tr class="text-center" style="background-color: #f0f0f0;">
                                    <td colspan="2"><strong>Total Cantidad Restado:</strong></td>
                                    <td colspan="1"><strong>{{ $sumaCantidadRestado }}</strong></td>
                                    <td colspan="6"></td>
                                </tr>
                            @endforeach
                        @endforeach



                        </table>
            </div>


          </div>
        </div>
      </div>
</div>

@endsection

@section('datatable')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

 <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $('#datatable-search').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Imprimir',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'excel',
            'pdf',
            'colvis'
        ],
        responsive: true,
        stateSave: true,

        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });

</script>

@endsection
