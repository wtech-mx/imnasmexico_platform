<!doctype html>
<html lang="en">
    <title>#{{ $nota->folio }}</title>
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

    @if ($nota->id_usuario == NULL)
        <label style="font-size: 20px"><b>Sin numero del cliente</b></label>
    @else
        <label style="font-size: 20px"><b>Numero de cliente: </b>A{{ $nota->User->id }}</label>
    @endif

    <div class="text-center">
        @if ($nota->id_kit != NULL && $nota->id_kit2 == NULL)
            <h3>{{$nota->Kit->nombre}}</h3>
        @endif
        @if ($nota->id_kit2 != NULL)
            <h3>Compra de kits:</h3>
            <ul>
                <li>{{$nota->Kit->nombre}}</li>
                @if ($nota->id_kit2 != NULL)
                    <li>{{$nota->Kit2->nombre}}</li>
                @endif
                @if ($nota->id_kit3 != NULL)
                    <li>{{$nota->Kit3->nombre}}</li>
                @endif
                @if ($nota->id_kit4 != NULL)
                    <li>{{$nota->Kit4->nombre}}</li>
                @endif
                @if ($nota->id_kit5 != NULL)
                    <li>{{$nota->Kit5->nombre}}</li>
                @endif
                @if ($nota->id_kit6 != NULL)
                    <li>{{$nota->Kit6->nombre}}</li>
                @endif
            </ul>
        @endif
    </div>

    <table class="table table-bordered border-primary">
        <thead class="text-center" style="background-color: #836262; color: #fff">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Descuento</th>
                <th>P.Unit</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($nota_productos as $nota_producto)
                <tr>
                    <td>
                        <img src="{{ $nota_producto->Productos->imagenes }}" alt="" style="width: 60px"><br>
                        {{ $nota_producto->Productos->nombre }} <br>
                        <p style="">Precio Real Catalogo: ${{ $nota_producto->Productos->precio_normal }}.0</p>
                    </td>
                    <td>
                        {{ $nota_producto->cantidad }}
                    </td>
                    <td>
                        {{ $nota_producto->descuento }}%
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
                        @if($nota_producto->restante == '0' || $nota_producto->restante == NULL)
                            ${{ $unit }}
                        @else
                            Descuento {{ $nota_producto->restante }}% <br>
                           <del> ${{ $nota_producto->Productos->precio_normal }} </del> <br>
                           <b> ${{ $unit }} </b>

                        @endif

                    </td>
                    @php
                        $subtotal = $unit * $nota_producto->cantidad;
                    @endphp
                    <td>
                        ${{ number_format($subtotal, 1, '.', ',') }}
                    </td>
                </tr>
           @endforeach
        </tbody>
        <tfoot >
            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
              <td style="text-align: right"><b>Subtotal</b> </td>
              <td>${{ number_format($nota->tipo, 1, '.', ',') }}</td>
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
              <td><b>${{ number_format($nota->total, 1, '.', ',') }}</b> </td>
            </tr>
        </tfoot>
    </table>

    @if ($nota->nota != NULL)
        <h2>Comentario</h2>
        <p>{{ $nota->nota }}</p>
    @endif

    @if ($nota->monto != NULL)
        <h2>Pago</h2>
        <b for="">Metodo de Pago:</b> {{ $nota->metodo_pago }} <br>
        <b for="">Monto:</b> ${{ number_format($nota->monto, 1, '.', ',') }} <br>
    @endif

    @if ($nota->monto2 != NULL)
        <b for="">Metodo de Pago:</b> {{ $nota->metodo_pago2 }} <br>
        <b for="">Monto:</b> ${{ number_format($nota->monto2, 1, '.', ',') }} <br>
    @endif

    @if ($nota->factura == '1')
        <h2>Datos de Factura</h2>
        <b for="">Razon Social:</b> {{ $nota->razon_social }} <br>
        <b for="">RFC:</b> {{ $nota->rfc }} <br>
        <b for="">CFDI:</b> {{ $nota->cfdi }} <br>
        <b for="">Correo Factura:</b> {{ $nota->correo_fac }} <br>
        <b for="">Telefono Factura:</b> {{ $nota->telefono_fac }} <br>
        <b for="">Dirección:</b> {{ $nota->direccion_fac }}<br>
    @endif


  </div>
</body>
</html>
