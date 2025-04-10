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
    <h1>Etiquetas bajo stock
    </h1>
    <h2>Laboratorio NAS
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
        <thead style="background-color: #836262; color: #fff">
            <tr>
                <th>Nombre</th>
                <th>Lateral</th>
                <th>Tapa</th>
                <th>Frente</th>
                <th>Reversa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $grupo)
                @php
                    $producto = $grupo->first(); // Tomamos el producto base del grupo
                @endphp

                @if (
                    ($producto->estatus_lateral == '1' && $producto->etiqueta_lateral <= 200) ||
                    ($producto->estatus_tapa == '1' && $producto->etiqueta_tapa <= 200) ||
                    ($producto->estatus_frente == '1' && $producto->etiqueta_frente <= 200) ||
                    ($producto->estatus_reversa == '1' && $producto->etiqueta_reversa <= 200)
                )
                    <tr>
                        <td class="col-6">
                            <b> {{ $producto->nombre }} </b>
                        </td>
                        @if ($producto->estatus_lateral == '1' && $producto->etiqueta_lateral <= 200)
                                @php $cantidad = $producto->etiqueta_lateral; @endphp
                            <td style="background-color: {{ $cantidad <= 150 ? '#e74c3c' : '#e7dc3c' }}; color:#fff">
                                {{ $cantidad }}
                            </td>
                        @endif
                        @if ($producto->estatus_tapa == '1' && $producto->etiqueta_tapa <= 200)
                                @php $cantidad = $producto->etiqueta_tapa; @endphp
                            <td style="background-color: {{ $cantidad <= 150 ? '#e74c3c' : '#e7dc3c' }}; color:#fff">
                                {{ $cantidad }}
                            </td>
                        @endif
                        @if ($producto->estatus_frente == '1' && $producto->etiqueta_frente <= 200)
                                @php $cantidad = $producto->etiqueta_frente; @endphp
                            <td style="background-color: {{ $cantidad <= 150 ? '#e74c3c' : '#e7dc3c' }}; color:#fff">
                                {{ $cantidad }}
                            </td>
                        @endif
                        @if ($producto->estatus_reversa == '1' && $producto->etiqueta_reversa <= 200)
                                @php $cantidad = $producto->etiqueta_reversa; @endphp
                            <td style="background-color: {{ $cantidad <= 150 ? '#e74c3c' : '#e7dc3c' }}; color:#fff">
                                {{ $cantidad }}
                            </td>
                        @endif
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
