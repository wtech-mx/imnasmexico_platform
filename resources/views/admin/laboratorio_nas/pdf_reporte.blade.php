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
            background-color: #836262;
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
            border-bottom: 2px solid #836262;
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
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #F7EAED;
        }
  </style>
<body>
  <header>
    <h1>Reporte Diario Laboratorio NAS
    </h1>
    <h2>{{ $fechaFormateada  }}
    </h2>
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
    <h2>Envases</h2>
    <table class="table table-bordered border-primary">
        <thead style="background-color: #3f2a47; color: #fff">
            <tr>
                <th>Envase</th>
                <th>Stock viejo</th>
                <th>Stock actual</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historial as $item)
                <tr>
                    <td>
                        <b>{{ $item->Envases->envase }}</b> <br>
                        {{ $item->Envases->descripcion }} <br> <br>
                        <b>Productos:</b>
                        <ul>
                            @foreach ($envases_productos as $envase_producto)
                                @if ($envase_producto->id_envase == $item->Envases->id)
                                    <li>
                                        {{ $envase_producto->Product->nombre }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        {{ $item->stock_viejo }}
                    </td>
                    <td>
                        {{ $item->stock_nuevo }}
                    </td>
                </tr>
           @endforeach
        </tbody>
    </table>

    <h2>Granel</h2>
    <table class="table table-bordered border-primary">
        <thead style="background-color: #325168; color: #fff">
            <tr>
                <th>Producto</th>
                <th>Moviemientos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historial_granel as $item)
                <tr>
                    <td>
                        <b>{{ $item->Products->nombre }}</b>
                    </td>
                    <td>
                        {{ $item->stock_laboratorio }}
                    </td>
                </tr>
           @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
