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
        header {
            position: fixed;
            left: 0px;
            top: -160px;
            right: 0px;
            height: 100px;
            color: #fff;
            text-align: center;
        }
        .header-cotizacion {
            background-color: #0560776c;
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
        }

        td, th {
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #F7EAED;
        }
        .table-cotizacion {
            background-color: #783E5D;
            color: #F7EAED;
        }

        .table-distribuidora {
            background-color: #322338;
            color: #F7EAED;
        }
  </style>
<body>
  <header class="header-cotizacion">
    <h1>Historial vendidos</h1>
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

  <table class="table table-flush" id="datatable-search">
        <thead class="thead-light">
            <tr>
                <th colspan="2">#</th>
                <th colspan="2">IMG</th>
                <th colspan="2">Nombre</th>
            </tr>
        </thead>

        @foreach ($HistorialVendidos as $productoId => $ventas)
            <tr style="background-color: #0560776c">
                <td colspan="2"><h5>{{ $productoId }}</h5></td>
                <td colspan="2">
                    <img id="blah" src="{{ $ventas->first()->Products->imagenes }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                </td>
                <td colspan="2">
                <h5>{{ $ventas->first()->Products->nombre }}</h5>
                </td>
            </tr>

            @foreach ($ventas->groupBy(function($venta) {
                return \Carbon\Carbon::parse($venta->created_at)->format('d \d\e F \d\e\l Y');
            }) as $fecha => $ventasPorFecha)
                <tr class="text-center">
                    <td colspan="6" style="background-color: #d9edf7;">
                    <h5>{{ $fecha }}</h5>
                    </td>
                </tr>
                <tr class="text-center">
                    <th colspan="2">stock viejo</th>
                    <th colspan="3">cantidad restado</th>
                    <th colspan="2">stock actual</th>
                </tr>
                @foreach ($ventasPorFecha as $venta)
                    <tr class="text-center">
                        <td colspan="2">{{ $venta->stock_viejo }}</td>
                        <td colspan="3">{{ $venta->cantidad_restado }}</td>
                        <td colspan="2">{{ $venta->stock_actual }}</td>
                    </tr>
                @endforeach
            @endforeach
        @endforeach
    </table>
  </div>
</body>
</html>
