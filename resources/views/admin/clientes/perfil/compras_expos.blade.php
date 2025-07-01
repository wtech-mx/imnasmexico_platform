<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Compras Expo</h5>
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
                    @foreach ($cotizaciones_cosmica as $nota)
                        <tr>
                            <th>
                                {{ $nota->folio }}
                            </th>

                            <th>
                                @php
                                $fecha = $nota->fecha;
                                $fecha_timestamp = strtotime($fecha);
                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                @endphp
                                {{$fecha_formateada}}
                            </th>

                             <th> {{$nota->total}}</th>
                             <th>
                                @if ($nota->estatus_cotizacion == NULL)
                                    <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $nota->id }}" title="Editar Estatus" style="background: #b600e3;">
                                        Pendiente
                                    </a>
                                @else
                                    {{$nota->estatus_cotizacion}}
                                @endif
                             </th>

                            <th>
                                @if($nota->total <= '700')

                                @else
                                    <a class="btn btn-xs" target="_blank"  href="{{ route('cotizacion_cosmica.meli_show', $nota->id) }}"  style="background: #FFE600; color: #ffff">
                                        <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="" style="width: 35px">
                                    </a>
                                @endif

                                <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $nota->id]) }}">
                                    <i class="fa fa-file"></i>
                                </a>

                                <a class="btn btn-sm btn-warning" href="{{ route('cotizacion_cosmica.edit', $nota->id) }}">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>

                                @if ($nota->metodo_pago == 'Contra Entrega')
                                    <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$nota->id}}" style="background: #e6ab2d; color: #ffff">
                                        <i class="fa fa-truck"></i>
                                    </a>
                                @else
                                    <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$nota->doc_guia) }}" download="{{asset('pago_fuera/'.$nota->doc_guia) }}" style="background: #e6ab2d;">
                                        <i class="fa fa-truck"></i>
                                    </a>
                                @endif

                                @if(isset($mensajesPorCotizacion[$nota->id]) && $mensajesPorCotizacion[$nota->id] > 0)
                                    <a class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#reporte_{{ $nota->id }}" title="Reporte" style="background: rgb(255, 255, 255); color:black">
                                        <i class="fa fa-commenting"></i>
                                    </a>
                                @else
                                    <a class="btn btn-xs btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#reporte_{{ $nota->id }}" title="Reporte" style="background: rgb(255, 255, 255); color:black">
                                        <i class="fa fa-comment"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @include('admin.cotizacion_cosmica.modal_estatus')
                        @include('admin.clientes.perfil.reporte_cosmica')
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
