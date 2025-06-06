<!doctype html>
<html lang="en">
    <title>{{ $nota->folio }}</title>
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
            background-color: #322338;
        }

        .header-distribuidora {
            background-color: #783E5D;
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
  <header class="{{ $usercosmika == NULL ? 'header-cotizacion' : 'header-distribuidora' }}">
    <h1>@if ($usercosmika == NULL) Cotización @else Distribuidora @endif
        Cosmica #@if ($nota->folio == null) {{ $nota->id }} @else {{ $nota->folio }} @endif</h1>
    <h3>Que tu piel brille, como las Estrellas en el Cosmos.</h3>

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
    <table class="mt-5">
        <thead style="background-color: #87caa8; color: #fff">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($cotizaciones as $cotizacion)
                <tr>
                    <th>{{$cotizacion->folio}}</th>
                    <th>
                        @if ($cotizacion->id_usuario == NULL)
                            {{ $cotizacion->nombre }} <br> {{ $cotizacion->telefono }}
                        @else
                            {{ $cotizacion->User->name }} <br> {{ $cotizacion->User->telefono }}
                        @endif
                    </th>
                    <th>${{ number_format($cotizacion->total, 1, '.', ',') }}</th>
                    <th>{{ \Carbon\Carbon::parse($cotizacion->fecha)->locale('es')->isoFormat('dddd D [de] MMMM') }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>



  </div>
</body>
</html>
