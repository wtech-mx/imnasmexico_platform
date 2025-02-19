<!-- Card Basic Info -->
<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Cotizaciones NAS</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush" id="datatable-nas">
                <thead class="thead">
                    <tr>
                        <th>Folio</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cotizaciones as $item)
                        <tr>
                            <th>
                                {{ $item->folio }}
                            </th>

                            <th>
                                @php
                                $fecha = $item->fecha;
                                $fecha_timestamp = strtotime($fecha);
                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                @endphp
                                {{$fecha_formateada}}
                            </th>

                             <td> {{$item->total}}</td>

                             <td>
                                @if($item->estatus_cotizacion == null)
                                    <a type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                        Cotizacion
                                    </a>
                                @elseif($item->estatus_cotizacion == 'Pendiente')
                                    <a type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                        Pendiene
                                    </a>
                                @elseif($item->estatus_cotizacion == 'Aprobada')
                                    <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                        Aprobada
                                    </a>
                                @elseif($item->estatus_cotizacion == 'Cancelada')
                                    <a type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                        Cencelada
                                    </a>
                                @else
                                    <a class="btn btn-xs btn-info">
                                        {{$item->estatus_cotizacion}}
                                    </a>
                                @endif
                            </td>

                            <td>
                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('notas_productos.imprimir', ['id' => $item->id]) }}">
                                    <i class="fa fa-file"></i>
                                </a>

                                <a class="btn btn-sm btn-warning" href="{{ route('notas_cotizacion.edit', $item->id) }}">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @include('admin.cotizacion.modal_estatus')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('datatable')
    <script>
        const dataTableNas = new simpleDatatables.DataTable("#datatable-nas", {
            searchable: true,
            fixedHeight: false
        });
    </script>
@endsection
