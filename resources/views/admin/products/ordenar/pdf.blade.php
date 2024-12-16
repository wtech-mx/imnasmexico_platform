<?php
    // Supongamos que $nota->fecha contiene la fecha en el formato 'Y-m-d'
    $fechaOriginal = $pedido->fecha_enviado;

    // Crear un objeto DateTime a partir de la fecha original
    $date = new DateTime($fechaOriginal);

    // Formatear la fecha al formato deseado (d/m/Y)
    $fechaFormateada = $date->format('d/m/Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orden pedido  #{{ $pedido->id }}</title>
    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 15px;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 0;
            border-collapse: collapse;
        }
        .body_content{
            width: 100%;

        }
        .section {
            padding: 15px 35px;
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .heading {
            color: #7030A0;
        }
        .client-details {
            background-color: #7030A0;
            color: #ffffff;
            font-size: 20px;
            /* width: 650px; */
            width: 100%;
        }
        .details {
            text-align: center;
            padding: 15px 0;
        }
        .image img {
            max-width: 100%;
            vertical-align: middle;
        }
        .no-border {
            border: 0 hidden;
        }
        .center-table {
            margin: 0 auto;
            display: table;
        }

        .terminos{
            font-size: 12px;
            line-height: 1.3;
        }

        .folios{
            font-size: 12px;
            line-height: 1.3;
        }


    </style>
</head>
<body>
    <table class="container" align="center">
        <tbody>
            <tr>
                <td class="section" id="body_content">
                    <div class="image text-left">
                        <img alt="" width="80" src='https://plataforma.imnasmexico.com/assets/user/logotipos/imnas.webp' / style="margin: auto">
                    </div>
                </td>

                <td>
                    <div class="text-item text-right heading" style="padding: 0;margin:0;">
                        <p style="padding: 0;margin:0;"><strong>Pedido para laboratorio</strong></p>
                    </div>
                    <div class="text-item text-right" style="padding: 0;margin:0;">
                        <p class="folios" style="padding: 0;margin:0;">Folio :  #{{ $pedido->id }}</p>
                        <p class="folios" style="padding: 0;margin:0;">Fecha : {{ $fechaFormateada; }}</p>
                        <p class="folios" style="padding: 0;margin:0;">IMNAS</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="container" align="center" style="">
        <thead class="text-center" style="background-color: #836262; color: #000000">
            <tr>
                <th style="border: 1px solid black;border-collapse: collapse;">Producto</th>
                <th style="border: 1px solid black;border-collapse: collapse;">Nombre</th>
                <th style="border: 1px solid black;border-collapse: collapse;">Cantidad <br> Solicitada</th>
                <th style="border: 1px solid black;border-collapse: collapse;">Cantidad <br> Laboratorio</th>
                <th style="border: 1px solid black;border-collapse: collapse;">Cantidad <br> Recibida</th>
                </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($pedido_productos as $item)
                @php
                    $resta_lab = 0;
                    $resta_lab = $item->cantidad_pedido - $item->cantidad_entregada_lab;

                    $date2 = new DateTime($item->updated_at);
                    $fechaFormateada2 = $date->format('d/m/Y');
                @endphp
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse;">
                        <p>
                            @if ($item->Products->imagenes == NULL)
                                <img src="https://plataforma.imnasmexico.com/cursos/no-image.jpg" alt="" width="130px">
                            @else
                                <img src="{{$item->Products->imagenes}}" alt="" width="130px">
                            @endif
                        </p>
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse;">
                        <b> {{ $item->Products->nombre }}</b>
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse;">{{ $item->cantidad_pedido }}</td>
                        @if ($item->cantidad_entregada_lab == 0)
                            <td style="border: 1px solid black;border-collapse: collapse; background:#86ae7e75">
                                Finalizado <br>
                                @if ($item->lab_entrega == NULL)
                                @else
                                    Enviado: {{ $item->lab_entrega }}
                                @endif
                        @else
                            <td style="border: 1px solid black;border-collapse: collapse; background:#ae7e7e75">
                                {{ $item->lab_entrega }}
                        @endif
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse;">{{ $item->cantidad_recibido }}</td>
                </tr>
            @endforeach
    </table>
</body>
</html>
