@extends('layouts.app_admin')

@section('template_title')
    Cursos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>


                            <h3 class="mb-3">Mercado Pago</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                        </div>
                    </div>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                            Pagos
                          </button>
                          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                            Compras
                          </button>
                        </div>
                      </nav>

                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="text-center">
                                            <tr class="tr_checkout">
                                              <th >Num. Pedido</th>
                                              <th>Correo</th>
                                              <th >Monto</th>
                                              <th >Curso</th>
                                              <th >Fecha</th>
                                              <th >Recibo MP</th>
                                            </tr>
                                          </thead>
                                        <tbody>
                                            @foreach ($pagos as $pago)
                                                <tr>
                                                    <td>{{ $pago->id }}</td>
                                                    @if ($pago->payer == null)
                                                        <td>/</td>
                                                    @else
                                                        <td>{{$pago->payer->email}}</td>
                                                    @endif
                                                    <td>${{ $pago->transaction_amount }}</td>
                                                    <td>
                                                        @php
                                                            $words = explode(' ', $pago->description );
                                                            $chunks = array_chunk($words, 3);
                                                            foreach ($chunks as $chunk) {
                                                                echo implode(' ', $chunk) . '<br>';
                                                            }
                                                        @endphp
                                                    </td>
                                                    <td>
                                                        @php
                                                            $fecha = $pago->date_approved;
                                                            // Convertir a una marca de tiempo Unix
                                                            $timestamp = strtotime($fecha);
                                                            // Formatear la fecha
                                                            $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                                                            // Formatear la hora
                                                            $hora_formateada = date('h:i A', $timestamp);
                                                            // Combinar fecha y hora con salto de línea
                                                            $fecha_hora_formateada = $fecha_formateada . '<br>a las ' . $hora_formateada;
                                                        @endphp
                                                        {!! $fecha_hora_formateada !!}
                                                    </td>
                                                    <td>
                                                        @if(empty($pago->payer->email))

                                                        @else
                                                            <a href="{{ route('mercado.pago_recibo',$pago->id) }}" target="_blank" class="btn btn-primary btn-sm">
                                                                Recibo
                                                            </a>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="text-center">
                                            <tr class="tr_checkout">
                                              <th >Num. Pedido</th>
                                              <th>Correo</th>
                                              <th >Monto</th>
                                              <th >Curso</th>
                                              <th >Fecha</th>
                                              <th >Recibo MP</th>
                                            </tr>
                                          </thead>
                                        <tbody>
                                            @foreach ($comprasSinEmail as $pago)
                                                <tr>
                                                    <td>{{ $pago->id }}</td>
                                                    @if ($pago->payer == null)
                                                        <td>/</td>
                                                    @else
                                                        <td>{{$pago->payer->email}}</td>
                                                    @endif
                                                    <td>${{ $pago->transaction_amount }}</td>
                                                    <td>
                                                        @php
                                                            $words = explode(' ', $pago->description );
                                                            $chunks = array_chunk($words, 3);
                                                            foreach ($chunks as $chunk) {
                                                                echo implode(' ', $chunk) . '<br>';
                                                            }
                                                        @endphp
                                                    </td>
                                                    <td>
                                                        @php
                                                            $fecha = $pago->date_approved;
                                                            // Convertir a una marca de tiempo Unix
                                                            $timestamp = strtotime($fecha);
                                                            // Formatear la fecha
                                                            $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                                                            // Formatear la hora
                                                            $hora_formateada = date('h:i A', $timestamp);
                                                            // Combinar fecha y hora con salto de línea
                                                            $fecha_hora_formateada = $fecha_formateada . '<br>a las ' . $hora_formateada;
                                                        @endphp
                                                        {!! $fecha_hora_formateada !!}
                                                    </td>
                                                    <td>
                                                        @if(empty($pago->payer->email))

                                                        @else
                                                            <a href="{{ route('mercado.pago_recibo',$pago->id) }}" target="_blank" class="btn btn-primary btn-sm">
                                                                Recibo
                                                            </a>
                                                        @endif
                                                    </td>

                                                </tr>
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
