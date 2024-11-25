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

  <div id="content" style="margin-top: 1rem">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-around">
                <span class="badge rounded-pill" style="background: #e74c3c; color: #f8f8f8">Bajo stock: 0 - 150</span>
                <span class="badge rounded-pill text-dark" style="background: #e7dc3c">Medio stock: 151 - 200</span>
            </div>
        </div>
    </div>

    <table class="table table-bordered border-primary" style="margin-top: 1rem">
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
                        @if ($item->etiqueta_lateral <= 150)
                            <td class="col-3 text-center" style="background-color: #e74c3c; color:#fff">{{ $item->etiqueta_lateral }}</td>
                        @elseif ($item->etiqueta_lateral > 150 && $item->etiqueta_lateral <= 200)
                            <td class="col-3 text-center" style="background-color: #e7dc3c;">{{ $item->etiqueta_lateral }}</td>
                        @endif
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
                        @if ($item->etiqueta_tapa <= 150)
                            <td class="col-3 text-center" style="background-color: #e74c3c; color:#fff">{{ $item->etiqueta_tapa }}</td>
                        @elseif ($item->etiqueta_tapa > 150 && $item->etiqueta_tapa <= 200)
                            <td class="col-3 text-center" style="background-color: #e7dc3c;">{{ $item->etiqueta_tapa }}</td>
                        @endif
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
                        @if ($item->etiqueta_frente <= 150)
                            <td class="col-3 text-center" style="background-color: #e74c3c; color:#fff">{{ $item->etiqueta_frente }}</td>
                        @elseif ($item->etiqueta_frente > 150 && $item->etiqueta_frente <= 200)
                            <td class="col-3 text-center" style="background-color: #e7dc3c;">{{ $item->etiqueta_frente }}</td>
                        @endif
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
                        @if ($item->etiqueta_reversa <= 150)
                            <td class="col-3 text-center" style="background-color: #e74c3c; color:#fff">{{ $item->etiqueta_reversa }}</td>
                        @elseif ($item->etiqueta_reversa > 150 && $item->etiqueta_reversa <= 200)
                            <td class="col-3 text-center" style="background-color: #e7dc3c;">{{ $item->etiqueta_reversa }}</td>
                        @endif
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
