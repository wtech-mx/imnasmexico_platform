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
  <header>
    <h1>Reporte Expo</h1>
    <h2>{{ \Carbon\Carbon::parse($fechaInicio)
     ->isoFormat('dddd D MMMM YYYY') }}</h2>
  </header>

  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
               Fecha: {{ date('d/n/y', strtotime($fechaInicio)) }}
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
    <table class="table text-center table-bordered border-primary" >
        <thead >
            <tr>
                <th>Efectivo</th>
                <th>Tarjeta</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
           <tr>
            <td>${{ number_format($totalEfectivo, 2) }}</td>
            <td>${{ number_format($totalTarjeta, 2) }}</td>
            <td>${{ number_format($totalVentas, 2) }}</td>
           </tr>
        </tbody>
    </table>

    <h2 style="text-align: center;"> <br>Ventas <br></h2>
        <table class="table table-striped mt-2">
          <thead class="thead-light">
            <tr>
              <th>Personal</th>
              <th class="text-end">Total Vendido</th>
            </tr>
          </thead>
          <tbody>
            @forelse($ventasPorAdmin as $row)
              <tr>
                <td>{{ $row->admin_name }}</td>
                <td class="text-end">${{ number_format($row->total_ventas, 2) }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="2" class="text-center">No hay ventas en ese rango de fechas</td>
              </tr>
            @endforelse
          </tbody>
        </table>

  </div>
</body>
</html>
