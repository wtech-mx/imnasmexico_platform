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
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #F7EAED;
        }



        .card {
            width: 25%; /* Ancho del card */
            min-width: 300px; /* Mínimo ancho para que sea responsivo */
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            float: right; /* Alinear a la derecha */
            margin-left: 15px; /* Espaciado desde el contenido de la izquierda */
            font-family: Arial, sans-serif;
            margin-top: 10px;
        }

        .card-header {
            background-color: #d7dbdd;
            color: rgb(0, 0, 0);
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            padding: 10px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .row p {
            margin: 0;
            font-size: 14px;
        }

        .fw-bold {
            font-weight: bold;
        }

        .bg-success {
            background-color: #abebc6;
        }

        .text-white {
            color: rgb(0, 0, 0);
        }

        .rounded {
            border-radius: 8px;
        }

        .p-2 {
            padding: 10px;
        }

        .text-end {
            text-align: right;
        }
  </style>
<body>
  <header>
    <h1>Comisiones kits</h1>
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
@php
        $comisionGrupal = 0;
    if ($totalVentas >= 60000 && $totalVentas <= 99999) {
        $comisionGrupal = 1000;
    } elseif ($totalVentas >= 100000 && $totalVentas <= 149999) {
        $comisionGrupal = 2000;
    } elseif ($totalVentas >= 150000) {
        $comisionGrupal = 3000;
    }
@endphp
    <h2 class="text-center">Ventas: <b>${{number_format($totalVentas, 2)}}</b></h2>
    <h3 class="text-center">Comision: <b>${{number_format($comisionGrupal, 2)}}</b></h3>

    <table class="table table-bordered border-primary">
        <thead class="text-center" style="background-color: #322338; color: #fff">
            <tr>
                <th>Folio</th>
                <th>Vendedora</th>
                <th>Subtotal</th>
                <th>Descuento</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody class="text-center">
                @foreach ($notasAprobadasCosmicaComision as $notas)
                    <tr >
                        <td>{{$notas->folio}}</td>
                        <td>{{$notas->Vendido->name}}</td>
                        <td class="form-group col-3">${{number_format($notas->subtotal, 2)}}</td>
                        <td class="form-group col-3">{{$notas->restante}}%</td>
                        <td class="form-group col-3">${{number_format($notas->total, 2)}}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
