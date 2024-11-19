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
    <h1>Etiquetas bajo stock
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
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($etiqueta_lateral as $item)
                    <tr>
                        <td class="col-6">
                            <b> {{ $item->nombre }} </b>
                        </td>
                        <td class="col-3 text-center" style="background-color: #e74c3c; color:#fff">
                                {{ $item->etiqueta_lateral }}
                        </td>
                        <td class="col-3 text-center">
                            Lateral
                        </td>
                    </tr>
                @endforeach
                @foreach ($etiqueta_tapa as $item)
                    <tr>
                        <td class="col-6">
                            <b> {{ $item->nombre }} </b>
                        </td>
                        <td class="col-3 text-center" style="background-color: #e74c3c; color:#fff">
                            {{ $item->etiqueta_tapa }}
                        </td>
                        <td class="col-3 text-center">
                            Tapa
                        </td>
                    </tr>
                @endforeach
                @foreach ($etiqueta_frente as $item)
                    <tr>
                        <td class="col-6">
                            <b> {{ $item->nombre }} </b>
                        </td>
                        <td class="col-3 text-center" style="background-color: #e74c3c; color:#fff">
                            {{ $item->etiqueta_frente }}
                        </td>
                        <td class="col-3 text-center">
                            Frente
                        </td>
                    </tr>
                @endforeach
                @foreach ($etiqueta_reversa as $item)
                    <tr>
                        <td class="col-6">
                            <b> {{ $item->nombre }} </b>
                        </td>
                        <td class="col-3 text-center" style="background-color: #e74c3c; color:#fff">
                            {{ $item->etiqueta_reversa }}
                        </td>
                        <td class="col-3 text-center">
                            Reversa
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
