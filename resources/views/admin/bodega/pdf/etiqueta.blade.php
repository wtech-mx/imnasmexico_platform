<!DOCTYPE html>

<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Etiqueta {{$registro->folio}}</title>
    </head>
    <style>

        * {
            padding: 0px;
            margin: 0px;
        }
        .contenedo_padre{
            width: 188px;
            height: 56px;
            position:absolute;
        }

        .contenedo_padre_uno{
            width: 94px;
            height: 28px;
            position:absolute;
        }

        .contenedo_padre_dos{
            left: 40%;
            width: 94px;
            height: 28px;
            position:absolute;
        }

        .barcode{
            position: relative;
            top: 6px;
            left: 6px;
        }
    </style>
    <body>

            {{-- </div> --}}
            <div class="contenedo_padre_uno">
                @if ($tipo == 'nas')
                    <img class="barcode" src="data:image/png;base64, {!! DNS2D::getBarcodePNG('NP_' . $registro->id, 'QRCODE', 3.5, 3.5) !!}" alt="Código QR">
                    <p>{{$tipo}}</p>
                @else
                    <img class="barcode" src="data:image/png;base64, {!! DNS2D::getBarcodePNG('NC_' . $registro->id, 'QRCODE', 3.5, 3.5) !!}" alt="Código QR">
                    <p>{{$tipo}}</p>
                @endif
                {{-- <p style="font-size: 9px;padding:1px;margin-top:5px;margin-left:8px;">{{ explode('_', $notas_preparacion->id)[0] }}</p> --}}

            </div>

            <div class="contenedo_padre_dos">
                <p style="font-size: 9px;padding:1px;margin-top:5px;margin-left:8px;">Folio: {{ Str::limit($registro->folio, 75) }}</p>
                <p style="font-size: 9px;padding:1px;margin-top:2px;margin-left:8px;">¿Problemas con tu pedido? Contactanos <b>56 3754 0093</b></p>

            </div>
    </body>
</html>