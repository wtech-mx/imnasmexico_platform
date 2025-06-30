<!doctype html>
<html lang="en">
    <title>{{ $nota->folio }}</title>
<head>
  <style>
        body{
            font-family: sans-serif;
        }
        @page {
            margin: 160px 30px;
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
            margin: 5px 0;
        }
        header h2{
            margin: 0 0 5px 0;
        }
        footer {
            position: fixed;
            left: 0px;
            bottom: 20px;
            right: 0px;
            height: 20px;
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
            padding: 2px;
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

    <table class="table table-bordered border-primary">
        <thead class="text-center {{ $usercosmika == NULL ? 'table-cotizacion' : 'table-distribuidora' }}">
            <tr>
                <th>Codigo Barras</th>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Descuento</th>
                <th>P.Unit</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @php
                $subtotalDescuento = 0; // Inicializar subtotalDescuento con el subtotal de la nota
            @endphp
            @foreach (range(1, 6) as $i)
                @php
                    $kitId = 'id_kit' . ($i == 1 ? '' : $i);
                    $kitCantidad = 'cantidad_kit' . ($i == 1 ? '' : $i);
                    $kitDescuento = 'descuento_kit' . ($i == 1 ? '' : $i);
                @endphp
                @if ($nota->$kitId != NULL)
                    @php
                        $kit = \App\Models\Products::find($nota->$kitId);
                        $cantidad = $nota->$kitCantidad;
                        $unit = $kit->precio_normal;
                        $subtotal = $unit * $cantidad;

                        $Descuento = ($subtotal * $nota->$kitDescuento) / 100; // Aplicar descuento
                        $subtotalDescuento = $subtotal - $Descuento; // Calcular subtotal con descuento
                    @endphp
                    <tr>
                        <td>
                                @if ($kit->sku == NULL)
                                    <b></b>
                                @else
                                    @php
                                        // Si tu SKU viene con guiones bajos y sólo quieres la parte antes del primero:
                                        $codigo = $kit->sku;
                                    @endphp
                                    <img
                                        src="data:image/png;base64,{{
                                        DNS1D::getBarcodePNG(
                                            $codigo,
                                            'C128',
                                            1.1,
                                            30  ,
                                            [0,0,0],
                                            true
                                        )
                                        }}"
                                        alt="Barcode de {{ $codigo }}">
                                @endif
                        </td>
                        <td>
                            @if ($kit->imagenes == NULL)
                                <img id="blah" src="{{asset('cursos/no-image.jpg') }}" style="width:30px; height:30px;"/>
                            @else
                                <img id="blah" src="{{asset('products/'.$kit->imagenes) }}" style="width:30px; height:30px;"/>
                            @endif
                        </td>

                        <td>
                            {{ $kit->nombre }}
                        </td>

                        <td>
                            {{ $cantidad }}
                        </td>

                        <td>
                            {{ $nota->$kitDescuento }}%
                        </td>

                        <td>
                            ${{ $unit }}
                        </td>

                        <td>
                            ${{ $subtotalDescuento }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: left;">
                            <ul>
                                @foreach ($nota_productos->where('kit', 1)->where('num_kit', $nota->$kitId) as $producto)
                                    <li>
                                        {{ $producto->cantidad }} {{ $producto->producto }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endif
            @endforeach

            @foreach ($nota_productos->where('kit', 0) as $producto)
                <tr>

                    <td>
                        @if ($producto->Productos->sku == NULL)
                            <b>SKU no disponible</b>
                        @else
                            @php
                                // Si tu SKU viene con guiones bajos y sólo quieres la parte antes del primero:
                                $codigo = $producto->Productos->sku;
                            @endphp
                            <img
                                src="data:image/png;base64,{{
                                DNS1D::getBarcodePNG(
                                    $codigo,
                                    'C128',
                                    1.1,
                                    30,
                                    [0,0,0],
                                    true
                                )
                                }}"
                                alt="Barcode de {{ $codigo }}">
                        @endif
                    </td>
                    <td>
                        <img id="blah" src="{{$producto->Productos->imagenes}}"  style="width: 60px; height: 60px;"/> <br>
                    </td>

                    <td>
                        <p style="font-size: 12px">{{ $producto->producto }} </p>
                        <p style="font-size:10px">Precio Real Catalogo: ${{ $producto->Productos->precio_normal }}.0</p>

                    </td>
                    <td>
                        <p style="font-size: 12px">{{ $producto->cantidad }}</p>

                    </td>
                    <td>
                        <p style="font-size: 12px">{{ $producto->descuento }}%</p>
                    </td>
                    <td>
                        <p style="font-size: 12px">
                            @if ($producto->total == NULL)
                                ${{$producto->Productos->precio_normal}}
                            @else
                                ${{$producto->price}}
                            @endif
                        </p>
                    </td>
                    <td>
                       <p style="font-size: 12px">
                         @if ($producto->total == NULL)
                                ${{$producto->price}}
                            @else
                                ${{$producto->total}}
                            @endif
                       </p>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot >
            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              <td style="text-align: right"><b>Subtotal</b> </td>
              <td>${{ $nota->subtotal }}</td>
            </tr>
            @if ($nota->restante > 0)
                <tr style="background-color: #ffffff;">
                    <td></td>
                    <td></td>
                    <td></td>
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
                <td></td>
                <td></td>
              <td style="text-align: right"><b>Total</b> </td>
              <td><b>${{ $nota->total }}</b> </td>
            </tr>
        </tfoot>
    </table>

    @if ($nota->monto != NULL)
        <h2>Pago</h2>
        <b for="">Metodo de Pago:</b> {{ $nota->metodo_pago }} <br>
        <b for="">Monto:</b> ${{ $nota->monto }} <br>
    @endif

    @if ($nota->monto2 != NULL)
        <b for="">Metodo de Pago:</b> {{ $nota->metodo_pago2 }} <br>
        <b for="">Monto:</b> ${{ $nota->monto2 }} <br>
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

        <table style="width:100%" style="background: #322338;margin-top:6rem;">
        <tr style="background: #322338">
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <tr style="background: #322338">
          <td></td>
          <td>
            <p style="text-align: center;color: #fff;font-size: 12px;">
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
