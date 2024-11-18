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
    <h1>Envases bajo stock
    </h1>
    <h2>Laboratorio
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

  <div id="content" style="margin-top: 3rem">
    <table class="table table-bordered border-primary">
        <thead style="background-color: #322338; color: #fff">
            <tr>
                <th>Nombre</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($envases_vencer as $envase_vencer)
                <tr>
                    <td>
                        <b>{{ $envase_vencer->envase }}</b> <br>
                        {{ $envase_vencer->descripcion }} <br> <br>
                        <b>Productos:</b>
                        <ul>
                            @foreach ($envases_productos as $envase_producto)
                                @if ($envase_producto->id_envase == $envase_vencer->id)
                                    <li>
                                        {{ $envase_producto->Product->nombre }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        {{ $envase_vencer->conteo }}
                    </td>
                </tr>
           @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
