<!doctype html>
<html lang="en">
<head>
    <style>
        body{
          font-family: sans-serif;
        }

        @page {
          margin: 160px 50px;
        }

        header { position: fixed;
          left: 0px;
          top: -160px;
          right: 0px;
          height: 100px;
          background-color: #CA87A6;
          color: #fff;
          text-align: center;
        }

        header h1{
          margin: 10px 0;
        }

        header h2{
          margin: 0 0 10px 0;
        }

        footer {
          position: fixed;
          left: 0px;
          bottom: -50px;
          right: 0px;
          height: 40px;
          border-bottom: 2px solid #CA87A6;
        }

        footer .page:after {
          content: counter(page);
        }

        footer table {
          width: 100%;
        }

        footer p {
          text-align: right;
        }

        footer .izq {
          text-align: left;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            border-radius: 6px;
        }

        td, th {
        text-align: center;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #F7EAED;
        }



    </style>

<body>
    @php
        use Carbon\Carbon;
    @endphp
  <header>
    <h1>Reporte de Ventas</h1>
    <h2>Naturales AIN SPA</h2>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </header>

  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
               Fecha: {{ date('d/n/y', strtotime($today)) }}
            </p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>

  <div id="content">
    <table class="table text-center table-bordered border-primary">
        <thead >
            <tr>
                <th>Rango de fecha De:</th>
                <th>Rango de fecha A:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ \Carbon\Carbon::parse($fechaInicio)->locale('es')->isoFormat('dddd D [de] MMMM') }}
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($fechaFin)->locale('es')->isoFormat('dddd D [de] MMMM') }}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="">
        <thead style="background-color: #CD6155; color: #fff">
            <tr>
                <th># Cotizaciones: <img src="https://plataforma.imnasmexico.com/assets/user/icons/carrito-de-compras.webp" alt="" width="35px"> </th>
                <th># Venta: <img src="https://plataforma.imnasmexico.com/assets/user/icons/order.webp"alt="" width="35px"> </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <h3> <strong> {{ count($cotizaciones) }}</strong></h3>
                </th>

                <th>
                    <h3> <strong> {{ count($ventas) }}</strong></h3>
                </th>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>
                    <h2 style="text-align: center;">Total de Cotizaciones <img src="https://plataforma.imnasmexico.com/assets/user/icons/bolsa-de-dinero.png" alt="" width="35px"></h2>
                </th>

                <th>
                    <h2 style="text-align: center;">Total de Ventas <img src="https://plataforma.imnasmexico.com/assets/user/icons/money.png" alt="" width="35px"></h2>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <h2><strong> ${{ number_format($totalSum, 1, '.', ',') }}</strong></h2>
                </th>
                <th>
                    <h2><strong> ${{ number_format($totalSum2, 1, '.', ',') }}</strong></h2>
                </th>
            </tr>
        </tbody>
    </table>

    <table class="mt-5">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>5 Productos mas cotizados</th>
                <th>5 Productos mas vendidos</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <img src="{{$chart}}" width="100%">
                </th>
                <th>
                    <img src="{{$chart2}}" width="100%">
                </th>
            </tr>
        </tbody>
    </table>

    <table class="mt-5">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Ciudades donde compran</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <img src="{{$chartGrafica }}" width="75%">
                </th>

            </tr>
        </tbody>
    </table>

    <table class="mt-5" style="margin-top: 3rem">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>5 Productos menos cotizados</th>
                <th>5 Productos menos vendidos</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <img src="{{$chart_menoscot}}" width="100%">
                </th>
                <th>
                    <img src="{{$chart_ProductMeno}}" width="100%">
                </th>
            </tr>
        </tbody>
    </table>

    <div style="page-break-after: always;"></div>

    <h2 style="text-align: center;"> <br>Cotizaciones <br></h2>
    <table class="mt-5">
        <thead style="background-color: #87caa8; color: #fff">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Descuento</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($cotizaciones as $cotizacion)
                <tr>
                    <th>{{$cotizacion->folio}}</th>
                    <th>
                        @if ($cotizacion->id_usuario == NULL)
                            {{ $cotizacion->nombre }} <br> {{ $cotizacion->telefono }}
                        @else
                            {{ $cotizacion->User->name }} <br> {{ $cotizacion->User->telefono }}
                        @endif
                    </th>
                    <th>{{$cotizacion->restante}}%</th>
                    <th>${{ number_format($cotizacion->total, 1, '.', ',') }}</th>
                    <th>{{ \Carbon\Carbon::parse($cotizacion->fecha)->locale('es')->isoFormat('dddd D [de] MMMM') }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="page-break-after: always;"></div>
    <h2 style="text-align: center;"> <br>Ventas <br></h2>
    <table class="mt-5">
        <thead style="background-color: #87c5ca; color: #fff">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Descuento</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <th>{{$venta->folio}}</th>
                    <th>
                        @if ($venta->id_usuario == NULL)
                            {{ $venta->nombre }} <br> {{ $venta->telefono }}
                        @else
                            {{ $venta->User->name }} <br> {{ $venta->User->telefono }}
                        @endif
                    </th>
                    <th>{{$venta->restante}}%</th>
                    <th>${{ number_format($venta->total, 1, '.', ',') }}</th>
                    <th>{{ \Carbon\Carbon::parse($venta->fecha)->locale('es')->isoFormat('dddd D [de] MMMM') }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
