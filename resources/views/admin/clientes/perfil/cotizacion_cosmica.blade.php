<!-- Card Basic Info -->
<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Cotizaciones Cosmica</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush" id="datatable-cosmica">
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
                    @foreach ($cotizaciones_cosmica as $item)
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
                                @if ($item->estatus_cotizacion == NULL)
                                    <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $item->id }}" title="Editar Estatus" style="background: #b600e3;">
                                        Pendiente
                                    </a>
                                @else
                                    {{$item->estatus_cotizacion}}
                                @endif
                             </td>

                            <td>
                                @if($item->total <= '700')

                                @else
                                    <a class="btn btn-xs" target="_blank"  href="{{ route('cotizacion_cosmica.meli_show', $item->id) }}"  style="background: #FFE600; color: #ffff">
                                        <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="" style="width: 35px">
                                    </a>
                                @endif

                                <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $item->id]) }}">
                                    <i class="fa fa-file"></i>
                                </a>

                                @can('nota-productos-editar')
                                    <a class="btn btn-sm btn-warning" href="{{ route('cotizacion_cosmica.edit', $item->id) }}">
                                        <i class="fa fa-fw fa-edit"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                        @include('admin.cotizacion_cosmica.modal_estatus')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('datatable')
    <script>
        const dataTableCosmica = new simpleDatatables.DataTable("#datatable-cosmica", {
            deferRender:true,
            paging: true,
            pageLength: 10
        });
    </script>
@endsection
