<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura # {{ $factura['folio'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
             font-size: 12px;
             margin: 0;
             padding: 0;
             height: 3508px;

         }
        table {
            width: 100%;
             border-collapse: collapse;
             margin-bottom: 15px;
         }
        th, td {
            border: 1px solid #ccc;
             padding: 8px;
             text-align: left;
         }
        .right {
            text-align: right;
         }

        .bold { font-weight: bold;
         }

        .footer { text-align: center;
             font-size: 10px;
             margin-top: 20px;
            }

        .cancelado { color: red;
             font-size: 20px;
             font-weight: bold;
             text-align: center;
         }

        .container {
            width: 750px;
            height: 3508px;
            margin: 0 auto;
            padding: 0;
            overflow: hidden;
        }
        .row {
            width: 100%;
            clear: both;
        }
        [class^="col-"] {
            float: left;
            padding-left: 5px;
            padding-right: 5px;
            box-sizing: border-box;
        }
        .col-1 { width: 3.69%; }  /* 8.33% - 4.64% */
        .col-2 { width: 12.02%; } /* 16.66% - 4.64% */
        .col-3 { width: 21.75%; } /* 25% - 4.64% */
        .col-4 { width: 30.00%; } /* 33.33% - 4.64% */
        .col-5 { width: 37.02%; } /* 41.66% - 4.64% */
        .col-6 { width: 46.49%; } /* 50% - 4.64% */
        .col-7 { width: 53.69%; } /* 58.33% - 4.64% */
        .col-8 { width: 62.70%; } /* 66.66% - 4.64% */
        .col-9 { width: 70.36%; } /* 75% - 4.64% */
        .col-10 { width: 78.69%; } /* 83.33% - 4.64% */
        .col-11 { width: 87.02%; } /* 91.66% - 4.64% */
        .col-12 { width: 96.10%; } /* 100% - 4.64% */

        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: start;
        }
        .border {
            border: 1px solid #000;
        }
        .p-2 {
            padding: 10px;
        }

        .wrap-text {
            word-wrap: break-word;
            white-space: pre-wrap;
            word-break: break-all;
        }

        .text_cadenas{
            font-size: 11px;
        }

        .color_dark{
            color: #000;
        }

        .color_blue{
            color: #2357ac;
        }

    </style>
</head>
<body>

    <div class="container">

        <div class="row">
            <div class="col-6 text-left">
                <h2 style="color:red;">
                    <strong>Folio y serie: </strong> {{ $factura['folio'] }}<br><br>
                </h2>
                <p class="color_blue">
                    <img src="{{ asset('archs_graf/Membrete_Fact.png') }}" alt="" style="width: 250px"> <br>
                    <strong class="color_dark">EMISOR: <br> </strong> {{ $factura['emisor']['nombre'] }}<br><br>
                    <strong class="color_dark">RFC: <br> </strong> {{ $factura['emisor']['rfc'] }}<br><br>
                    <strong class="color_dark">LUGAR DE EXPEDICIÓN (CÓDIGO POSTAL): <br> </strong> {{ $factura['receptor']['DomicilioFiscalReceptor'] ?? '' }}<br><br>
                </p>
            </div>

            <div class="col-6 text-left">
                <h3>FACTURA</h3>
                <p class="color_blue" style="position: relative">
                    <img src="{{ asset('archs_graf/LogoSAT.png') }}" alt="" style="width: 120px;position: absolute; right: 0px; top:50px;">

                    <strong class="color_dark">Folio Fiscal (UUID): <br> </strong> {{ $factura['folio'] }}<br><br>
                    <strong class="color_dark">CERTIFICADO SAT: <br> </strong> {{ $factura['certificadoSAT'] }}<br><br>
                    <strong class="color_dark">CERTIFICADO DEL EMISOR: <br> </strong> {{ $factura['certificadoCFDI'] }}<br><br>
                    <strong class="color_dark">FECHA HORA DE EMISIÓN: <br> </strong> {{ $factura['fecha_timbrado'] }}<br><br>
                    <strong class="color_dark">FECHA HORA DE CERTIFICACIÓN: <br> </strong> {{ $factura['fecha_timbrado'] }}<br><br>
                    <strong class="color_dark">RÉGIMEN FISCAL: </strong> {{ $factura['emisor']['RegimenFiscal'] }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-left">
                <p class="color_blue">
                    <strong class="color_dark">RECEPTOR: <br> </strong> {{ $factura['receptor']['nombre'] }}<br><br>
                    <strong class="color_dark">CERTIFICADO SAT: </strong> {{ $factura['certificadoSAT'] }} --
                    <strong class="color_dark">USO CFDI: </strong> {{ $factura['uso_cfdi'] }} --
                    <strong class="color_dark">DOMICILIO: </strong> {{ $factura['receptor']['DomicilioFiscalReceptor'] ?? '--' }} --
                    <strong class="color_dark">REGIMEN FISCAL: </strong> {{ $factura['receptor']['RegimenFiscalReceptor'] ?? '--' }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-left">
                <h3>Conceptos</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Clave Producto</th>
                            <th>ClaUni</th>
                            <th>Cant</th>
                            <th>Unidad</th>
                            <th>Descripción</th>
                            <th class="right">P. Unitario</th>
                            <th>Descuento</th>
                            <th class="right">Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($factura['conceptos'] as $concepto)
                            <tr>
                                <td>{{ $concepto['ClaveProdServ'] }}</td>
                                <td>{{ $concepto['ClaveUnidad'] }}</td>
                                <td class="right">{{ $concepto['cantidad'] }}</td>
                                <td>PZA</td>
                                <td>{{ $concepto['descripcion'] }}</td>
                                <td class="right">${{ number_format($concepto['valorunitario'], 2) }}</td>
                                <td>
                                    @if(! empty($concepto['Descuento']) && $concepto['Descuento'] > 0)
                                        ${{ number_format($concepto['Descuento'], 2) }}
                                    @else
                                        $0.00
                                    @endif
                                </td>
                                <td class="right">${{number_format($concepto['importe'], 2)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-9">
                <p>
                    @php
                        // Total como float
                        $total    = floatval($factura['total']);
                        // Parte entera y centavos
                        $entero   = floor($total);
                        $centavos = round(($total - $entero) * 100);

                        // Formateador en español
                        $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);

                        // Convertir a palabras y pasar a MAYÚSCULAS con mb_strtoupper
                        $palabrasEntero   = mb_strtoupper($fmt->format($entero), 'UTF-8');
                        $palabrasCentavos = mb_strtoupper($fmt->format($centavos), 'UTF-8');
                    @endphp

                <strong>Total con letra:</strong><br>
                {{ $palabrasEntero }} PESOS CON {{ $palabrasCentavos }} CENTAVOS<br><br>


                    <strong>Forma de pago:</strong> {{ $factura['forma_pago'] }}<br>
                    <strong>Método de pago:</strong> {{ $factura['metodo_pago'] }}
                </p>
            </div>

            <div class="col-3 text-left">
                <p>
                    <strong>Subtotal: </strong> ${{ number_format($factura['subtotal'], 2) }}<br>
                    <strong>Descuento: </strong> ${{ number_format($factura['descuento'], 2) }}<br>
                    <strong>IVA: </strong> ${{ number_format($factura['sumaIva'], 2) }}<br>
                    <strong>Total: </strong> ${{ number_format($factura['total'], 2) }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-2 text-left">
                <p class="text-left">
                    <img src="data:image/png;base64,{{ $factura['qr'] }}" width="110" height="110">
                </p>
            </div>

            <div class="col-10 text-left">
                <p class="text-left text_cadenas wrap-text color_blue">
                    <strong class="color_dark">Sello digital del CFDI:</strong><br>
                    {{ $factura['selloCFDI'] }}<br>

                    <strong class="color_dark">Sello del SAT:</strong><br>
                    {{ $factura['selloSAT'] }}<br>

                    <strong class="color_dark">Cadena original del complemento de certificación digital del SAT:</strong><br>
                    {{ $factura['cadena_original'] }}<br>
                </p>
            </div>
        </div>

    </div>

</body>
</html>
