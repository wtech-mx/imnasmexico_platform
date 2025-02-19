<!-- Card Basic Info -->
<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Compras</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush" id="datatable-tiendita">
                <thead class="thead">
                    <tr>
                        <th>Folio</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                        <tr>
                            <th>
                                {{ $compra->folio }}
                            </th>

                            <th>
                                @php
                                $fecha = $compra->fecha;
                                $fecha_timestamp = strtotime($fecha);
                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                @endphp
                                {{$fecha_formateada}}
                            </th>

                             <td> {{$compra->total}}</td>

                            <td>
                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('notas_productos.imprimir', ['id' => $compra->id]) }}">
                                    <i class="fa fa-file"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('datatable')
    <script>
        const dataTableTiendita = new simpleDatatables.DataTable("#datatable-tiendita", {
            deferRender:true,
            paging: true,
            pageLength: 10
        });
    </script>
@endsection
