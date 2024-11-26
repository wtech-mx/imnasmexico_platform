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
  @php
      use App\Models\Products;
  @endphp
<body>
  <header class="header-cotizacion">
    <h1>Historial Productos Faltantes</h1>
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

    <h3>NAS</h3>
    <table class="table" id="datatable-search">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>IMG</th>
                <th>Nombre</th>
                <th>Cantidad</th>
            </tr>
        </thead>

        @foreach ($productos_agrupados  as $productoId)
            @php
                $producto = Products::where('nombre', $productoId['producto'])->first();
            @endphp
            @if ($producto)
                <tr style="background-color: #0560776c">
                    <td><h5>{{ $producto->sku }}</h5></td>
                    <td>
                        <img id="blah" src="{{ $producto->imagenes }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                    </td>
                    <td><h5>{{ $producto->nombre }}</h5></td>
                    <td>{{ $productoId['total_cantidad']  }}</td>
                </tr>
            @endif
        @endforeach
    </table>

  </div>
</body>
</html>
