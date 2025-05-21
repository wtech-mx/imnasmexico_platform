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
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #F7EAED;
        }
  </style>
<body>
  <header>
    <h1>Folio #{{$nota->id }}
    </h1>
    <h2>Instituto Mexicano Naturales AIN SPA
    </h2>
    <p><img src="https://lh3.googleusercontent.com/d/1KpzCr4lID6U5foSXsNtQ4pXklupFAGz3=w800?authuser=0" alt="" style="width:100px;"></p>
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
    <table class="table text-center table-bordered border-primary">
        <thead >
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
           <tr>
            <td>
                {{ $nota->User->name }}
            </td>
            <td>
                {{ $nota->User->email }}
            </td>
            <td>
                {{ $nota->User->telefono }}
            </td>
            <td>
                {{ $nota->fecha }}
            </td>
           </tr>
        </tbody>
    </table>

    <table class="table table-bordered border-primary">
        <thead class="text-center" style="background-color: #836262; color: #fff">
            <tr>
                <th>Nombre</th>
                <th>Modalidad</th>
                <th>Fecha Curso</th>
                <th>P. Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($orden_ticket as $nota_producto)
                <tr>
                    <td>
                        @if ($nota_producto->cantidad == NULL)
                            <b> 1</b>
                        @else
                            <b> {{$nota_producto->cantidad}}</b>
                        @endif
                        {{ $nota_producto->CursosTickets->nombre }}
                    </td>
                    <td>
                        @if ($nota_producto->id_curso == 647)
                            -
                        @else
                            {{ $nota_producto->CursosTickets->Cursos->modalidad }}
                        @endif
                    </td>
                    <td>
                        @php
                        $fecha = $nota_producto->CursosTickets->Cursos->fecha_inicial;
                        $fecha_timestamp = strtotime($fecha);
                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                        @endphp
                        @if ($nota_producto->id_curso == 647)
                            -
                        @else
                            {{$fecha_formateada}}
                        @endif
                    </td>
                    <td>
                        ${{ $nota_producto->CursosTickets->precio }}
                    </td>
                    <td>
                        @php
                            if ($nota_producto->cantidad == NULL) {
                                $cantidad = 1;
                            }else{
                                $cantidad = $nota_producto->cantidad;
                            }

                            $subtotal = $nota_producto->CursosTickets->precio * $cantidad;
                        @endphp
                        ${{ $subtotal }}
                    </td>
                </tr>
           @endforeach
        </tbody>
        <tfoot >
            @php
                // 1) Subtotal: precio × cantidad de cada línea
                $subtotal = $orden_ticket->sum(function($item){
                    return $item->CursosTickets->precio * $item->cantidad;
                });

                // 2) IVA al 16%
                $iva = $subtotal * 0.16;

                // 3) Total con IVA
                $totalIva = $subtotal + $iva;
            @endphp
            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right"><b>Subtotal</b> </td>
                <td>${{ number_format($subtotal, 2) }}</td>
            </tr>
            <tr style="background-color: #ffffff;">
                @if ($nota->factura == 1)
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right"><b>IVA</b> </td>
                    <td>${{ number_format($iva, 2) }}</td>
                @endif
            </tr>
            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
                <td></td>
              <td style="text-align: right"><b>Total</b> </td>
              <td>${{ number_format($totalIva, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <h2>Pago</h2>
    <b for="">Metodo de Pago:</b> {{ $nota->forma_pago }} <br>
    <b for="">Monto:</b> ${{ number_format($nota->pago, 1, '.', ',') }} <br>

    @if ($nota->pago2 != NULL)
        <h2>Pago 2</h2>
        <b for="">Metodo de Pago 2:</b> {{ $nota->forma_pago2 }} <br>
        <b for="">Monto 2:</b> ${{ number_format($nota->pago2, 1, '.', ',') }} <br>
    @endif
  </div>
</body>
</html>
