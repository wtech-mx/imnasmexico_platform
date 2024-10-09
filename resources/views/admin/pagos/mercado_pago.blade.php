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
                                                    <a href="{{ route('mercado.pago_recibo',$pago->id) }}" target="_blank" class="btn btn-primary btn-sm">Recibo</a>
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
