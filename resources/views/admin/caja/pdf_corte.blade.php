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
    text-align: center;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #8362625e;
    }
  </style>
@php
  $fecha = date('d-m-Y');
  $total_caja = $total_pagos - $total_egresos;
@endphp
<body>
  <header>
    <h1>Reporte de IMNAS</h1>
    <h2>Corte Caja {{ date('d/n/y', strtotime($today)) }}</h2>
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
    <h2 style="text-align: center;">Ventas totales</h2>
    <table class="table text-center">
        <colgroup span="2" width="100"></colgroup>
        <colgroup span="2" width="100"></colgroup>
        <colgroup span="2" width="100"></colgroup>
        <tr>
            <td colspan="2" style="background-color: #836262; color: #fff; border: rgb(255, 255, 255) 1px solid;">Efectivo</td>
            <td colspan="2" style="background-color: #836262; color: #fff; border: rgb(255, 255, 255) 1px solid;">Transferencia</td>
            <td colspan="2" style="background-color: #836262; color: #fff; border: rgb(255, 255, 255) 1px solid;">Tarjeta</td>
        </tr>
        <tr>
            <td style="border: rgb(255, 255, 255) 1px solid;">Curso/Venta</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Total</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Curso/Venta</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Total</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Curso/Venta</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Total</td>
        </tr>
        <tr>
            <td>{{$count_cursos_efectivo}}</td>
            <td>${{$total_pagos_efectivo}}</td>

            <td>{{$count_cursos_trans}}</td>
            <td>${{$total_pagos_trans}}</td>

            <td>{{$count_cursos_tarjeta}}</td>
            <td>${{$total_pagos_tarjeta}}</td>
        </tr>
    </table>

    <h2 style="text-align: center;">Total en Caja</h2>
    <table class="table text-center">
        <thead style="background-color: #836262; color: #fff">
            <tr>
                <th>Saldo Inicial</th>
                <th>Ingreso</th>
                <th>Egreso</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>${{ $caja->monto_inicial }}</td>
                <td>${{ $total_pagos_efectivo }}</td>
                <td>${{ $total_egresos }}</td>
                <td>${{$total_caja}}</td>
            </tr>
        </tbody>
    </table>

    <h2 style="text-align: center;">Ingresos y Egresos Manuales</h2>
    <table class="table text-center">
        <thead style="background-color: #836262; color: #fff">
            <tr>
                <th>ID</th>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($caja_dia as $caja_egreso)
                <tr>
                    <td>#{{ $caja_egreso->id }}</td>
                    <td>{{ $caja_egreso->concepto }}</td>
                    <td>${{ $caja_egreso->egresos }}</td>
                    @if ($caja_egreso->tipo == 'Egreso')
                        <td style="background-color: #ff0808d3; color:#fff">{{ $caja_egreso->tipo }}</td>
                    @else
                        <td style="background-color: #7fff08d3; color:#000000">{{ $caja_egreso->tipo }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Efectivo</h2>
    <table class="table text-center">
        <thead style="background-color: #836262; color: #fff">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Monto</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notas_cursos_efectivo as $nota_curso_efectivo)
                <tr>
                    <td>#{{ $nota_curso_efectivo->Nota->id }}</td>
                    <td>{{ $nota_curso_efectivo->Nota->User->name }}</td>
                    <td>${{ $nota_curso_efectivo->monto }}</td>
                    <td>Curso</td>
                </tr>
            @endforeach
            @foreach ($notas_producto_efectivo as $nota_producto_efectivo)
                <tr>
                    <td>{{ $nota_producto_efectivo->folio }}</td>
                    <td>{{ $nota_producto_efectivo->User->name }}</td>
                    <td>${{ $nota_producto_efectivo->total }}</td>
                    <td>Producto</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Transferencia</h2>
    <table class="table text-center">
        <thead style="background-color: #836262; color: #fff">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Monto</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notas_cursos_trans as $nota_curso_efectivo)
                <tr>
                    <td>#{{ $nota_curso_efectivo->Nota->id }}</td>
                    <td>{{ $nota_curso_efectivo->Nota->User->name }}</td>
                    <td>${{ $nota_curso_efectivo->monto }}</td>
                    <td>Curso</td>
                </tr>
            @endforeach
            @foreach ($notas_producto_trans as $nota_producto_efectivo)
                <tr>
                    <td>{{ $nota_producto_efectivo->folio }}</td>
                    <td>{{ $nota_producto_efectivo->User->name }}</td>
                    <td>${{ $nota_producto_efectivo->total }}</td>
                    <td>Producto</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Tarjeta</h2>
    <table class="table text-center">
        <thead style="background-color: #836262; color: #fff">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Monto</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notas_cursos_tarjeta as $nota_curso_efectivo)
                <tr>
                    <td>#{{ $nota_curso_efectivo->Nota->id }}</td>
                    <td>{{ $nota_curso_efectivo->Nota->User->name }}</td>
                    <td>${{ $nota_curso_efectivo->monto }}</td>
                    <td>Curso</td>
                </tr>
            @endforeach
            @foreach ($notas_producto_tarjeta as $nota_producto_efectivo)
                <tr>
                    <td>{{ $nota_producto_efectivo->folio }}</td>
                    <td>{{ $nota_producto_efectivo->User->name }}</td>
                    <td>${{ $nota_producto_efectivo->total }}</td>
                    <td>Producto</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
