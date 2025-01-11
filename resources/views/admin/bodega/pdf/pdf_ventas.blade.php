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
          height: 120px;
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
        <header>
            <h1>Reporte Ventas</h1>
            <h3>Del: {{$fechaInicioFormateada}} <br> Al: {{$fechaFinFormateada}}</h3>

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
                            <h2><strong> ${{ number_format($totalVendido, 1, '.', ',') }}</strong></h2>
                        </th>
                    </tr>
                </tbody>
            </table>

            <table class="table">
                <thead>
                    <tr style="background: #837e62; color:#fff">
                        <th>Vendido por</th>
                        <th>Total Registros</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultados as $data)
                        <tr>
                            <td>{{ $data['name'] }}</td>
                            <td>{{ $data['total'] }}</td>
                        </tr>
                    @endforeach
                    <tr style="font-weight: bold; background: #ddd;">
                        <td>Total Cotizaciones</td>
                        <td>{{ $totalCotizaciones }}</td>
                    </tr>
                </tbody>
            </table>

            <h3>Ventas NAS</h3>
            <table class="table table-bordered border-primary">
                <thead>
                    <tr style="background: #836262; color:#fff">
                        <th>Folio</th>
                        <th>Cliente</th>
                        <th>Vendido por</th>
                        <th>Total</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($notas_nas as $item)
                        <tr>
                            <td>
                                <h5>{{ $item->folio }}</h5>
                            </td>
                            <td>
                                <h5>
                                    @if ($item->id_usuario == NULL)
                                        {{ $item->nombre }} <br> {{ $item->telefono }}
                                    @else
                                        {{ $item->User->name }}
                                    @endif
                                </h5>
                            </td>
                            <td>
                                @if ($item->Vendido)
                                    {{$item->Vendido->name}}
                                @else
                                    -
                                @endif
                                <h5>

                                </h5>
                            </td>
                            <td><h5>${{ $item->tipo }}</h5></td>
                            <td>
                                <h5>{{$item->estatus_cotizacion}}</h5>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Ventas Cosmica</h3>
            <table class="table table-bordered border-primary">
                <thead>
                    <tr style="background: #322338; color:#fff">
                        <th>Folio</th>
                        <th>Cliente</th>
                        <th>Vendido por</th>
                        <th>Total</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($notas_cosmica as $item)
                        <tr>
                            <td>
                                <h5>{{ $item->folio }}</h5>
                            </td>
                            <td>
                                <h5>
                                    @if ($item->id_usuario == NULL)
                                        {{ $item->nombre }} <br> {{ $item->telefono }}
                                    @else
                                        {{ $item->User->name }}
                                    @endif
                                </h5>
                            </td>
                            <td>
                                @if ($item->Vendido)
                                    {{$item->Vendido->name}}
                                @else
                                    -
                                @endif
                                <h5>

                                </h5>
                            </td>
                            <td><h5>${{ $item->total }}</h5></td>
                            <td>
                                <h5>{{$item->estatus_cotizacion}}</h5>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
