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

    <table class="table table-bordered border-primary">
        <thead class="text-center" style="background-color: #836262; color: #fff">
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

                        // 2) Si la nota está facturada, añade 16% de IVA
                        if ($nota->factura == '1' && $kit->categoria == 'Cosmica') {
                            $subtotalDescuento = round($subtotalDescuento * 1.16, 2);
                            $texto = 'Con iva';
                        }else {
                            $texto = '';
                        }
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
                                        1.6,
                                        35,
                                        [0,0,0],
                                        true
                                    )
                                    }}"
                                    alt="Barcode de {{ $codigo }}">
                            @endif
                        </td>
                        <td>
                            @if ($kit->imagenes == NULL)
                                <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 50px; height: 50px;"/>
                            @else
                                <img id="blah" src="{{asset('products/'.$kit->imagenes) }}" alt="Imagen" style="width: 50px; height: 50px;"/>
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
                            {{$texto}} ${{ $subtotalDescuento }}
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
                                    1.6,
                                    35,
                                    [0,0,0],
                                    true
                                )
                                }}"
                                alt="Barcode de {{ $codigo }}">
                        @endif
                    </td>
                    <td>
                        <img id="blah" src="{{$producto->Productos->imagenes}}" alt="Imagen" style="width: 60px; height: 60px;"/> <br>
                    </td>

                    <td>
                        {{ $producto->producto }} <br>
                        <p style="font-size:13px">Precio Real Catalogo: ${{ $producto->Productos->precio_normal }}.0</p>

                    </td>
                    <td>
                        {{ $producto->cantidad }}
                    </td>
                    <td>
                        {{ $producto->descuento }}%
                    </td>
                    <td>
                        @if ($producto->total == NULL)
                            ${{$producto->Productos->precio_normal}}
                        @else
                            ${{$producto->price}}
                        @endif
                    </td>
                    <td>
                        @if ($producto->precio_iva == NULL)
                            ${{$producto->price}}
                        @else
                           Con iva ${{$producto->precio_iva}}
                        @endif
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
              <td style="text-align: right"><b>Subtotal</b> </td>
              @if ($nota->subtotal == NULL)
                <td>${{ number_format($nota->tipo, 1, '.', ',') }}</td>
              @else
                <td>${{ number_format($nota->subtotal, 1, '.', ',') }}</td>
              @endif

            </tr>
            @if ($nota->restante > 0)
                <tr style="background-color: #ffffff;">
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
                <td style="text-align: right"><b>Envío</b> </td>
                <td>$250</td>
                </tr>
            @endif

            <tr style="background-color: #ffffff;">
                <td></td>
                <td></td>
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

  </div>
</body>
</html>
