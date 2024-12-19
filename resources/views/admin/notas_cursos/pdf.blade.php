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
    <h1>Nota de Remision Curso #{{$nota->id }}
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
                <th>Curso</th>
                <th>Modalidad</th>
                <th>Fecha</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($nota_productos as $nota_producto)
                <tr>
                    <td>
                        {{ $nota_producto->CursosTickets->nombre }}
                    </td>
                    <td>
                        {{ $nota_producto->CursosTickets->Cursos->modalidad }}
                    </td>
                    <td>
                        @php
                        $fecha = $nota_producto->CursosTickets->Cursos->fecha_inicial;
                        $fecha_timestamp = strtotime($fecha);
                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                        @endphp
                        {{$fecha_formateada}}
                    </td>
                    <td>
                        ${{ $nota_producto->precio }}
                    </td>
                </tr>
           @endforeach
        </tbody>
        <tfoot >
            <tr style="background-color: #ffffff;">
                @if ($nota->factura == 1)
                    <td></td>
                    <td></td>
                    <td style="text-align: right"><b>IVA</b> </td>
                    <td>${{ $nota->total_iva }}</td>
                @endif
            </tr>
            @if ($nota->descuento != NULL)
                <tr style="background-color: #ffffff;">
                    <td></td>
                    <td></td>
                    <td style="text-align: right"><b>Descuento</b> </td>
                    <td>${{ $nota->descuento }}%</td>
                </tr>
            @endif
            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
              <td style="text-align: right"><b>Total</b> </td>
              <td>${{ $nota->total }}</td>
            </tr>
        </tfoot>
    </table>

    @if ($nota->nota != NULL)
        <h2>Comentario</h2>
        <p>{{ $nota->nota }}</p>
    @endif

    <h2>Pago</h2>
    <b for="">Metodo de Pago:</b> {{ $nota_pagos->metodo_pago }} <br>
    <b for="">Monto:</b> ${{ number_format($nota_pagos->monto, 1, '.', ',') }} <br>

    @if ($nota_pagos->monto2 != NULL)
        <h2>Pago 2</h2>
        <b for="">Metodo de Pago 2:</b> {{ $nota_pagos->metodo_pago2 }} <br>
        <b for="">Monto 2:</b> ${{ number_format($nota_pagos->monto2, 1, '.', ',') }} <br>
    @endif

    @if ($nota->factura == '1')
        <h2>Datos de Factura</h2>
        <b for="">Razon Social:</b> {{ $nota->razon_social }} <br>
        <b for="">RFC:</b> {{ $nota->rfc }} <br>
        <b for="">CFDI:</b> {{ $nota->cfdi }} <br>
        <b for="">Correo Factura:</b> {{ $nota->correo }} <br>
        <b for="">Telefono Factura:</b> {{ $nota->telefono }} <br>
        <b for="">Dirección:</b> {{ $nota->direccion }}<br>
    @endif


    {{-- <table style="width:100%" style="background: #a17576;margin-top:6rem;">
        <tr style="background: #a17576">
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <tr style="background: #a17576">
          <td></td>
          <td>
            <p style="text-align: center;"><strong><span style="color: #f5f5f5; font-size: 20px;">Ponte en contacto</span></strong></p>
            <p style="text-align: center;"><strong><span style="color: #f5f5f5; font-size: 20px;">
                <a href="https://www.facebook.com/naturalesainspa/" target="_blank" >
                    <img src="https://imnasmexico.com/new/wp-content/plugins/woocommerce-email-template-customizer/assets/img/fb-white-blue.png" width="35px">
                </a>
                <a href="https://www.instagram.com/naturalesainspaoficial/?hl=es" target="_blank" >
                    <img src="https://imnasmexico.com/new/wp-content/plugins/woocommerce-email-template-customizer/assets/img/ins-white-color.png" width="35px">
                </a>
                <a href="https://api.whatsapp.com/send?phone=525561672283" target="_blank" >
                    <img src="https://imnasmexico.com/new/wp-content/plugins/woocommerce-email-template-customizer/assets/img/wa-white-color.png" width="35px">
                </a>
                <a href="https://www.tiktok.com/@carla_rizo" target="_blank" >
                    <img src="https://imnasmexico.com/new/wp-content/plugins/woocommerce-email-template-customizer/assets/img/tiktok-white-color.png" width="35px">
                </a>
            </span></strong>
            </p>
            <p style="text-align: center;color: #f5f5f5;font-size: 12px;">
                <strong>Direccion: </strong> <br>
                Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México
            </p>

            <p style="text-align: center;"><span style="color: #f5f5f5;"><span style="font-size: 12px;"> </span></span></p>
            <p style="text-align: center;"><span style="color: #f5f5f5;"><span style="font-size: 12px;">Si tiene alguna pregunta, envíe un correo electrónico a imnascenter@naturalesainspa.com</span></span></p>
          </td>
          <td></td>
        </tr>

      </table> --}}

  </div>
</body>
</html>
