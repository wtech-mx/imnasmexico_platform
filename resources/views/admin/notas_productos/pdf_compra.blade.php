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
            color: #fff;
            text-align: center;
        }
        .header-cotizacion {
            background-color: #836262;
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
        .table-cotizacion {
            background-color: #836262;
            color: #F7EAED;
        }

        .table-distribuidora {
            background-color: #836262;
            color: #F7EAED;
        }
  </style>
<body>
  <header class="header-cotizacion">
    <h1>Compra Tienda en Linea TN{{$nota->id}}</h1>
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
    <table class="table text-center table-bordered border-primary" >
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
                @php
                $fecha = $nota->fecha;
                $fecha_timestamp = strtotime($fecha);
                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                @endphp
                {{ $fecha_formateada }}
            </td>
           </tr>
        </tbody>
    </table>

    <table class="table table-bordered border-primary">
        <thead class="text-center table-cotizacion">
            <tr>
                <th>Imagen</th>
                <th>Cantidad</th>
                <th>Producto</th>
                <th>P.Unit</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($nota_productos as $nota_producto)
                <tr>
                    <td>
                        <img src="{{ $nota_producto->Producto->imagenes }}" alt="" style="width: 60px">
                     </td>
                    <td>
                        {{ $nota_producto->cantidad }}
                    </td>
                    <td>
                        {{ $nota_producto->Producto->nombre }}
                    </td>
                    <td>
                        ${{ $nota_producto->precio }}
                    </td>
                    @php
                        $subtotal = $nota_producto->precio * $nota_producto->cantidad;
                    @endphp
                    <td>
                        ${{ $subtotal }}
                    </td>
                </tr>
           @endforeach
        </tbody>
        <tfoot >
            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
                <td></td>
              <td style="text-align: right"><b>Subtotal</b> </td>
              <td>${{ $nota->pago }}</td>
            </tr>
            @if ($nota->envio == 'Si')
                <tr style="background-color: #ffffff;">
                    <td></td>
                    <td></td>
                    <td></td>
                <td style="text-align: right"><b>Envío</b> </td>
                <td>${{$nota->dinero_recibido}}</td>
                </tr>
            @endif
            @if ($nota->factura == '1')
                <tr style="background-color: #ffffff;">
                    <td></td>
                    <td></td>
                    <td></td>
                <td style="text-align: right"><b>IVA por Factura</b> </td>
                <td>16%</td>
                </tr>
            @endif
            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
                <td></td>
              <td style="text-align: right"><b>Total</b> </td>
              <td><b>${{ $nota->pago }}</b> </td>
            </tr>
        </tfoot>
    </table>

    @if ($nota->factura == '1')
        <h2>Datos de Factura</h2>
        <b for="">Razon Social:</b> {{ $nota->razon_social }} <br>
        <b for="">RFC:</b> {{ $nota->rfc }} <br>
        <b for="">CFDI:</b> {{ $nota->cfdi }} <br>
        <b for="">Correo Factura:</b> {{ $nota->correo_fac }} <br>
        <b for="">Telefono Factura:</b> {{ $nota->telefono_fac }} <br>
        <b for="">Dirección:</b> {{ $nota->direccion_fac }}<br>
    @endif

        <table style="width:100%" style="background: #836262;margin-top:6rem;">
        <tr style="background: #836262">
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <tr style="background: #836262">
          <td></td>
          <th></th>
          <td>
            <p style="text-align: center;color: #fff;font-size: 12px;">
                <strong>Direccion: </strong> <br>
                Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México
            </p>

            <p style="text-align: center;"><span style="color: #f5f5f5;"><span style="font-size: 12px;"> </span></span></p>

          </td>
          <td></td>
        </tr>

      </table>

  </div>
</body>
</html>
