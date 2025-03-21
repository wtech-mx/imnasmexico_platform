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
          background-color: #322338;
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
          border-bottom: 2px solid #322338;
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
    <h1>Reporte de Expo</h1>
    <h2>Cosmica</h2>
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
    <table style="">
        <thead style="background-color: #783E5D; color: #fff">
            <tr>
                <th># Ventas: <img src="https://plataforma.imnasmexico.com/assets/user/icons/carrito-de-compras.webp" alt="" width="35px"> </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <h3> <strong> {{ count($notas) }}</strong></h3>
                </th>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>
                    <h2 style="text-align: center;">Total de Ventas <img src="https://plataforma.imnasmexico.com/assets/user/icons/bolsa-de-dinero.png" alt="" width="35px"></h2>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <h2><strong> ${{ number_format($total, 1, '.', ',') }}</strong></h2>
                </th>
            </tr>
        </tbody>
    </table>


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
            @foreach ($notas as $cotizacion)
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
  </div>
</body>
</html>
