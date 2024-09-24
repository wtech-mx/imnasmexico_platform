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
    <h1>Nota de Remision #@if ($nota->folio == null) {{ $nota->id }} @else {{ $nota->folio }} @endif
    </h1>
    <h2>Naturales AIN SPA
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
                @if ($nota->nombre == NULL)
                    {{ $nota->User->name }}
                @else
                    {{ $nota->nombre }}
                @endif
            </td>
            <td>
                @if ($nota->nombre == NULL)
                    {{ $nota->User->email }}
                @else
                    {{ $nota->correo }}
                @endif
            </td>
            <td>
                @if ($nota->nombre == NULL)
                    {{ $nota->User->telefono }}
                @else
                    {{ $nota->telefono }}
                @endif
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
                <!-- <th>Imagen</th> -->
                <th>Cantidad</th>
                <th>Producto</th>
                <th>P.Unit</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($nota_productos as $nota_producto)
                <tr>
                    @php
                        $producto = DB::table('products')->where('nombre', $nota_producto->producto)->first();
                    @endphp
                    <!-- <td>
                       <img src="{{ $producto->imagenes }}" alt="" style="width: 60px">
                    </td> -->
                    <td>
                        {{ $nota_producto->cantidad }}
                    </td>
                    <td>
                        {{ $nota_producto->producto }}
                    </td>
                    @php
                        if($nota_producto->producto == NULL){
                            $unit = 0;
                        }elseif($nota_producto->cantidad == NULL){
                            $unit = 0;
                        }else{
                            $unit = $nota_producto->price / $nota_producto->cantidad;
                        }
                    @endphp
                    <td>
                        @if($nota_producto->descuento == '0')
                            ${{ $unit }}
                        @else
                            Descuento {{ $nota_producto->descuento }}% <br>
                           <del> ${{ $producto->precio_normal }} </del> <br>
                           <b> ${{ $unit }} </b>
                            
                        @endif
                        
                    </td>
                    @php
                        $subtotal = $unit * $nota_producto->cantidad;
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
              <td style="text-align: right"><b>Subtotal</b> </td>
              <td>${{ $nota->tipo }}</td>
            </tr>
            @if ($nota->restante > 0)
                <tr style="background-color: #ffffff;">
                    <td></td>
                    <td></td>
                <td style="text-align: right"><b>Descuento</b> </td>
                <td>{{ $nota->restante }}%</td>
                </tr>
            @endif
            @if ($nota->envio == 'Si')
                <tr style="background-color: #ffffff;">
                    <td></td>
                    <td></td>
                <td style="text-align: right"><b>Envío</b> </td>
                <td>$250</td>
                </tr>
            @endif
            @if ($nota->factura == '1')
                <tr style="background-color: #ffffff;">
                    <td></td>
                    <td></td>
                <td style="text-align: right"><b>IVA por Factura</b> </td>
                <td>16%</td>
                </tr>
            @endif
            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
              <td style="text-align: right"><b>Total</b> </td>
              <td><b>${{ $nota->total }}</b> </td>
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

    <table style="width:100%" style="background: #a17576;margin-top:6rem;">
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
                <a href="https://api.whatsapp.com/send?phone=525545365893" target="_blank" >
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
{{-- <p style="text-align: center;"><span style="color: #f5f5f5;"><span style="font-size: 12px;">Si tiene alguna pregunta, envíe un correo electrónico a imnascenter@naturalesainspa.com</span></span></p> --}}
          </td>
          <td></td>
        </tr>

      </table>

  </div>
</body>
</html>
