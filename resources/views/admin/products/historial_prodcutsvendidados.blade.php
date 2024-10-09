@extends('layouts.app_admin')

@section('template_title')
    Products
@endsection
@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
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

                    <h3 class="mb-3">Products Historial Vendidos</h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>

                   <!-- <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Importar Products</button>
                    </form>-->
                    @can('productos-create')
                        <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_product" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            <i class="fa fa-fw fa-edit"></i> Crear
                        </a>
                    @endcan

                </div>
            </div>


            <div class="table-responsive p-4">
                        <table class="table table-flush" id="datatable-search">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>stock_viejo</th>
                                    <th>Restado</th>
                                    <th>stock actual</th>
                                    <th>Id Venta</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>

                            @foreach ($HistorialVendidos as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>

                                    <th>
                                        <img id="blah" src="{{$item->Products->imagenes}}" alt="Imagen" style="width: 60px; height: 60px;"/> <br>
                                            @php
                                                $words = explode(' ', $item->Products->nombre);
                                                $chunks = array_chunk($words, 2);
                                                foreach ($chunks as $chunk) {
                                                    echo implode(' ', $chunk) . '<br>';
                                                }
                                            @endphp
                                    </th>

                                    <td>
                                        {{ $item->stock_viejo }}
                                    </td>

                                    <td>
                                        {{ $item->cantidad_restado }}
                                    </td>

                                    <td>
                                        {{ $item->stock_actual }}
                                    </td>

                                    <td>
                                        COTIZACION NAS: <strong style="color:#B09B9B"> {{ $item->id_cotizacion_nas }} </strong><br>
                                        COTIZACION COSMICA: <strong style="color:#D486D6"> {{ $item->id_cotizacion_cosmica }} </strong> <br>
                                        VENTA NAS: <strong style="color:#A2DBE2"> {{ $item->id_venta_nas }} </strong> <br>
                                        PARADISUS: <strong style="color:#EE96BA"> {{ $item->id_paradisus }} </strong> <br>
                                        NAS ONLINE: <strong style="color:#F5ECE4"> {{ $item->id_nas_online }} </strong> <br>
                                        COMSICA ONLINE: <strong style="color:#80486B"> {{ $item->id_cosmica_online }} </strong> <br>
                                    </td>

                                    <td>
                                        @php
                                            $fecha = $item->created_at;
                                            $fecha_timestamp = strtotime($fecha);
                                            $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                        @endphp
                                        <h5>
                                            {{$fecha_formateada}}
                                        </h5>
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
