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
          background-color: #1f618d;
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
          border-bottom: 2px solid #1f618d;
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
        background-color: #85c1e9;
        }



    </style>

<body>
    @php
        use Carbon\Carbon;
    @endphp
  <header>
    <h1>Reporte de Ventas Global Tiendita</h1>
    <h2>Tiendita</h2>
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
                    Lunes 01 de enero 2024
                </td>
                <td>
                    Viernes 27 de diciembre 2024
                </td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>
                    <h2 style="text-align: center;">Total de Ventas <img src="https://plataforma.imnasmexico.com/assets/user/icons/money.png" alt="" width="35px"></h2>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <h2><strong> ${{ number_format($totalSum2, 1, '.', ',') }}</strong></h2>
                </th>
            </tr>
        </tbody>
    </table>
    <h2 style="text-align: center;"> <br>Ventas <br></h2>
    <table class="mt-5">
        <thead style="background-color: #1f618d; color: #fff">
            <tr>
                <th>Mes</th>
                <th>Total de Ventas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultado as $mes => $total)
                <tr>
                    <td>{{ $mes }}</td>
                    <td>${{ number_format($total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="page-break-after: always;"></div>

    <table class="mt-5">
        <thead style="background-color: #1f618d; color: #fff">
            <tr>
                <th>10 Productos mas vendidos</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <img src="{{$chart2}}" width="100%">
                </th>
            </tr>
        </tbody>
    </table>

    <table class="mt-5" style="margin-top: 1rem">
        <thead style="background-color: #1f618d; color: #fff">
            <tr>
                <th>10 Productos menos vendidos</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <img src="{{$chart3}}" width="100%">
                </th>
            </tr>
        </tbody>
    </table>

    <div style="page-break-after: always;"></div>
    <h2 style="text-align: center;"> <br>Productos <br></h2>
    <table class="mt-5">
        <thead style="background-color: #1f618d; color: #fff">
            <tr>
                <th>Mes</th>
                <th>Total de Ventas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productosVendidos as $product)
                <tr>
                    <td>{{ $product->producto }}</td>
                    <td>{{ $product->vendidos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>