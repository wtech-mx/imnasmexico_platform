@extends('layouts.app_admin')

@section('template_title')
    Reporte Mes
@endsection

@section('content')
<style>
    .grafica_syle{
        width: 30px;
        margin-left: 10px;
        border-radius: 9px;
        font-variant: diagonal-fractions;
        display: inline-block;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="mb-3">Reporte Mensual</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-center mb-3">Total del Mes</h4>
                            <h5 class="text-center">
                                <b>${{ $totalPagadoFormateado }}</b>

                            </h5>
                            <div class="d-flex justify-content-center mt-3">
                                <form method="POST" action="{{ route('reporte_mes.store') }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff"> Enviar Reporte</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-center mb-3">Grafica</h4>
                                <div class="d-flex justify-content-evenly">
                                    @php
                                        $totalPagadoFormattedMP = number_format($totalPagadoMP, 2, '.', ',');
                                        $totalPagadoFormattedST = number_format($totalPagadoST, 2, '.', ',');
                                        $totalPagadoFormattedEX = number_format($totalPagadoExt, 2, '.', ',');
                                        $totalPagadoFormattedNota = number_format($totalPagadoNota, 2, '.', ',');
                                    @endphp
                                    <h6>MP:<div class="grafica_syle" style="background: #2152ff;">-</div></br>$ {{ $totalPagadoFormattedMP }}</h6>
                                    <h6>Stripe:<div class="grafica_syle" style="background: #3A416F;">-</div></br>$ {{ $totalPagadoFormattedST }}</h6>
                                    <h6>Externo:<div class="grafica_syle" style="background: #f53939;">-</div></br>$ {{ $totalPagadoFormattedEX }}</h6>
                                    <h6>Notas:<div class="grafica_syle" style="background: #17c1e8;">-</div></br>$ {{ $totalPagadoFormattedNota }}</h6>
                                </div>
                                <div class="chart">
                                    <canvas id="doughnut-chart" class="chart-canvas" height="300"></canvas>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="d-flex justify-content-center mt-5">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="tickets-tab" data-bs-toggle="tab" data-bs-target="#tickets-tab-pane" type="button" role="tab" aria-controls="tickets-tab-pane" aria-selected="true">
                            Tickets
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-tab-pane" type="button" role="tab" aria-controls="orders-tab-pane" aria-selected="false">
                            Ordenes
                          </button>
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="tickets-tab-pane" role="tabpanel" aria-labelledby="tickets-tab" tabindex="0">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-3">Tickets vendidos</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="text-center">
                                    <tr class="tr_checkout">
                                    <th >Nombre</th>
                                    <th >Personas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cursosComprados as $curso)
                                        <tr>
                                            <td>{{ $curso['nombre'] }}</td>
                                            <td>{{ $curso['total'] }} personas</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="orders-tab-pane" role="tabpanel" aria-labelledby="orders-tab" tabindex="0">

                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-3">Ordenes Mes</h3>
                            </div>
                        </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-flush" id="datatable-search2">
                                        <thead class="text-center">
                                            <tr class="tr_checkout">
                                              <th >Num. Pedido</th>
                                              <th >Cliente</th>
                                              <th >Fecha de Compra</th>
                                              <th >Total</th>
                                              <th>Forma de Pago</th>
                                              <th>Estado</th>
                                              <th>Acciones</th>
                                            </tr>
                                          </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->User->name }}</td>
                                                    <td>{{ $order->fecha }}</td>
                                                    <td>{{ $order->pago }}</td>
                                                    <td>{{ $order->forma_pago }}</td>
                                                    <td>
                                                        @if ($order->estatus == '1')
                                                            Completado
                                                        @else
                                                            En espera
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a class="btn btn-sm btn-success" href="{{ route('pagos.edit_pago',$order->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
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
<script src="{{asset('assets/admin/js/plugins/chartjs.min.js')}}"></script>
<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });

    // Doughnut chart
    var ctx3 = document.getElementById("doughnut-chart").getContext("2d");

    new Chart(ctx3, {
      type: "doughnut",
      data: {
        labels: ["Mercado Pago", "Stipe", "Externo", "Nota"],
        datasets: [{
          label: "Projects",
          weight: 9,
          cutout: 60,
          tension: 0.9,
          pointRadius: 2,
          borderWidth: 2,
          backgroundColor: ["#2152ff", "#3A416F", "#f53939", "#17c1e8"],
          data: [{{ $totalPagadoMP }}, {{ $totalPagadoST }}, {{ $totalPagadoExt }}, {{ $totalPagadoNota }}],
          fill: false
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false,
            }
          },
        },
      },
    });
</script>

@endsection
