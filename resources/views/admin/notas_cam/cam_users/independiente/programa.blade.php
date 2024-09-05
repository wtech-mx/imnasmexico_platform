<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CHECKLIST del expediente Evaluador Indepedneinte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://paradisus.mx/assets/css/jquery.signature.css">


  </head>
  <body>

    <style>

        body{
            background-color: #fff;
            padding: 30px;
        }

        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{ width: 100% !important; height: auto;}

        .tab-pane{
            padding: 15px 15px 15px 15px;
        }
        .custom_col{

        }
        .icon-bar {
        position: fixed;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        z-index: 10;
        right: 0;
        }

        .icon-bar a {
        display: block;
        text-align: center;
        padding: 16px;
        transition: all 0.3s ease;
        color: white;
        font-size: 20px;
        }

        .icon-bar a:hover {
        background-color: #000;
        }
        .content {
        margin-left: 75px;
        font-size: 30px;
        }

        .facebook {
        background: #D7819D;
        color: white;
        }

        @media only screen and (max-width: 450px) {
            .text-res {
            font-size: 12px
        }
        }

    </style>

    <section class="row">

            <div class="row">
                <div class="col-0 col-md-3 col-lg-3"></div>
                <div class="col-12 col-md-6 col-lg-6">

                    <div class="row">

                        <div class="col-12 mt-4 mb-4">
                            <div class="d-flex justify-content-around">
                                <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/imnas.webp" alt="" style="width: 100px">
                                <p class="text-center mt-4">
                                   <strong> CHECK LIST del expediente <br> para la Acreditación de Centro <br>   de Evaluación</strong>
                                </p>
                                <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/sepconocer.png" alt="" style="width: 100px">
                            </div>
                        </div>

                        <form method="POST" class="row" action="{{ route('independiente.checklist', $cliente->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <table style="border-collapse:collapse;border:none;">
                                <tbody>
                                    <tr>
                                        <td style="width: 5cm;border: 1pt solid windowtext;background: rgb(191, 191, 191);padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><strong><span style="font-size:16px;">Raz&oacute;n Social:</span></strong></p>
                                        </td>
                                        <td style="width: 334.5pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>
                                                <input id="razo_social" name="razo_social" value="{{$cliente->razo_social}}" type="text" class="form-control" placeholder="Ingresar datos" style="border: solid 3px transparent;" >
                                            </p>
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style="font-size:16px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 5cm;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><strong><span style="font-size:16px;">Fecha:</span></strong></p>
                                        </td>
                                        <td style="width: 334.5pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>
                                                <input id="fecha_checklist" name="fecha_checklist" value="{{$cliente->fecha_checklist}}" type="text" class="form-control" placeholder="Ingresar datos" style="border: solid 3px transparent;" >
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 5cm;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><strong><span style="font-size:16px;">Responsable de la entrega</span></strong></p>
                                        </td>
                                        <td style="width: 334.5pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>
                                                <input id="responsable_entrega" name="responsable_entrega" value="{{$cliente->responsable_entrega}}" type="text" class="form-control" placeholder="Ingresar datos" style="border: solid 3px transparent;" >
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 5cm;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><strong><span style="font-size:16px;">Recibe y verifica la entrega</span></strong></p>
                                        </td>
                                        <td style="width: 334.5pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>
                                                <input id="recibe_verifica" name="recibe_verifica" value="{{$cliente->recibe_verifica}}" type="text" class="form-control" placeholder="Ingresar datos" style="border: solid 3px transparent;" >
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                            <table style="width:476.3pt;border-collapse:collapse;border:none;">
                                <tbody>
                                    <tr>
                                        <td colspan="3" style="width:476.3pt;border:solid windowtext 1.0pt;background:#BFBFBF;padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;text-align:center;'><strong>Documentaci&oacute;n Requerida</strong></p>
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;text-align:center;'>&nbsp;</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:391.05pt;border:solid windowtext 1.0pt;border-top:  none;background:#BFBFBF;padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;text-align:center;'><strong>Nombre del Documento</strong></p>
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;text-align:center;'><strong>&nbsp;</strong></p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#BFBFBF;padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;text-align:center;'><strong>S&iacute;</strong></p>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#BFBFBF;padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;text-align:center;'><strong>No</strong></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>
                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>1.-  Solicitud de acreditaci&oacute;n.</span></p>
                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="solicitud" id="solicitud1" {{ $checklist->c1 == 1 ? 'checked' : '' }} value="1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="solicitud" id="solicitud1" {{ $checklist->c1 == 0 ? 'checked' : '' }} value="0">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>
                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>2.-  Contrato de Acreditaci&oacute;n de Evaluador Independiente</span></p>
                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="contrato" id="contrato1" {{ $checklist->c2 == 1 ? 'checked' : '' }} value="1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="contrato" id="contrato1" {{ $checklist->c2 == 0 ? 'checked' : '' }} value="0">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>
                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>3.-  Carta compromiso para Evaluador Independiente</span></p>
                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="carta" id="carta1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="carta" id="carta1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>
                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>4.-  Identificaci&oacute;n Oficial INE VIGENTE del Evaluador Independiente (copia simple)</span></p>
                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="identificacion" id="identificacion1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="identificacion" id="identificacion1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>5.-  CURP del Evaluador Independiente (Copia simple)</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="curp" id="curp1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="curp" id="curp1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>6.-  Logo del Evaluador Independiente</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="logo" id="logo1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="logo" id="logo1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>7.-  Comprobante de domicilio del Evaluador Independiente</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="comproante" id="comproante1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="comproante" id="comproante1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>8.-  Registro de marca IMPI o Carta compromiso de uso de logo</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="registro_marca" id="registro_marca1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="registro_marca" id="registro_marca1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>9.-  Reconocimientos/Constancias profesionales</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reconocimiento" id="reconocimiento1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reconocimiento" id="reconocimiento1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>10.-  Curriculum Vitae CV&nbsp;</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cv" id="cv1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cv" id="cv1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>11.-  Acta de Nacimiento</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="acta" id="acta1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="acta" id="acta1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="width: 476.3pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;text-align:center;'><strong>Debe firmar del Evaluador Independiente</strong></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>
                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>1.- Contrato individual&nbsp;</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_contrato" id="firma_contrato1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_contrato" id="firma_contrato1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>2.- Acuerdo de Confidencialidad.</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_acuerdo" id="firma_acuerdo1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_acuerdo" id="firma_acuerdo1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>3.- Nombramiento</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_nombramiento" id="firma_nombramiento1">
                                            </div>

                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_nombramiento" id="firma_nombramiento1">
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>4.- Listado de equipamiento para el desarrollo de las actividades de evaluaci&oacute;n. (Fotograf&iacute;as).</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_listado" id="firma_listado1">
                                            </div>

                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_listado" id="firma_listado1">
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>5.- Medios de comunicaci&oacute;n.</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_medios" id="firma_medios1">
                                            </div>

                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_medios" id="firma_medios1">
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>6.- Redes sociales&nbsp;</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_redesociales" id="firma_redesociales1">
                                            </div>

                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_redesociales" id="firma_redesociales1">
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <div style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'>

                                                <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;'><span style='font-family:"Arial",sans-serif;'>7.- Lista de Precios Explicita. Precios separados y exhibidos de los Est&aacute;ndares de forma que le candidato los pueda ver y enterarse de ellos, si tiene precios de capacitaciones o alineaciones estar&aacute;n separados de las evaluaciones.</span></p>

                                            </div>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_lista_precios" id="firma_lista_precios1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="firma_lista_precios" id="firma_lista_precios1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="width: 476.3pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;text-align:center;'><strong><span style="background:lightgrey;">Infraestructura</span></strong></p>
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;text-align:center;'><strong><span style="background:lightgrey;">Debe entregar la Entidad de Certificaci&oacute;n y Evaluaci&oacute;n al Evaluador Independiente</span></strong></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>1.- Manuales digitales de la Normatividad, operatividad y funcionalidad del CONOCER&nbsp;</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_manuales" id="entrega_manuales1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_manuales" id="entrega_manuales1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>2.- Reglamento Interno de la Entidad para reglamentar al EI (Dise&ntilde;ado con logos para Evaluador Independiente.)</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_reglamento" id="entrega_reglamento1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_reglamento" id="entrega_reglamento1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>3.- Manual de procedimientos de aseguramiento de la calidad con logos para Evaluador Independiente.</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_manual" id="entrega_manual1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_manual" id="entrega_manual1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>4.- Manual de Procedimientos de Atenci&oacute;n al Cliente Reporte y Graficaci&oacute;n con Logos para Evaluador Independiente.</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_manual_atencion" id="entrega_manual_atencion1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_manual_atencion" id="entrega_manual_atencion1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>5.- Manual del Participante</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_manual_participante" id="entrega_manual_participante1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_manual_participante" id="entrega_manual_participante1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;'>6.- Ligas de Accesos y contrase&ntilde;as al M&oacute;dulo de Evaluaci&oacute;n del CONOCER</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_ligas_accesos" id="entrega_ligas_accesos1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_ligas_accesos" id="entrega_ligas_accesos1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>7.- Ligas de Videos para la formaci&oacute;n de Evaluadores.</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_ligas_video" id="entrega_ligas_video1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_ligas_video" id="entrega_ligas_video1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>8.- Logos diferenciados del CONOCER para cada Entidad de Certificaci&oacute;n y Evaluaci&oacute;n (ECE), Centro de Evaluaci&oacute;n (CE) y Evaluador Independiente (EI)</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_logos" id="entrega_logos1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_logos" id="entrega_logos1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>10.- Especificaciones de las fotograf&iacute;as. Si no tiene las especificaciones correctas acarrea retrasos en las entregas de Certificados.</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_especificaciones" id="entrega_especificaciones1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_especificaciones" id="entrega_especificaciones1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>11.- Papeler&iacute;a proporcionada por la Entidad de Certificaci&oacute;n y Evaluaci&oacute;n con logos para Evaluador Independiente (Diagn&oacute;stico, Plan de Evaluaci&oacute;n, C&eacute;dula de Evaluaci&oacute;n, Encuesta de Satisfacci&oacute;n)</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_papeleria" id="entrega_papeleria1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_papeleria" id="entrega_papeleria1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>12.- Tr&iacute;ptico del protocolo de la evaluaci&oacute;n con datos de la Entidad de Certificaci&oacute;n y Evaluaci&oacute;n (ECE) con logos, direcci&oacute;n de la Entidad de Certificaci&oacute;n y Evaluaci&oacute;n (ECE), as&iacute; como los n&uacute;meros de contacto del CONOCER y tambi&eacute;n los datos de contacto de la Entidad de Certificaci&oacute;n y Evaluaci&oacute;n. La Entidad de Certificaci&oacute;n y Evaluaci&oacute;n proporciona este tr&iacute;ptico.</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_triptico" id="entrega_triptico1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_triptico" id="entrega_triptico1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>13.- Formatos de resoluci&oacute;n de quejas proporcionados por la Entidad de Certificaci&oacute;n y Evaluaci&oacute;n (Colocarlos al lado de Buz&oacute;n de quejas)</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entregas_formatos" id="entregas_formatos1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entregas_formatos" id="entregas_formatos1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 391.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                                            <p style='margin-top:1.0pt;margin-right:0cm;margin-bottom:1.0pt;margin-left:14.2pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'>14.- Formatos Seguimiento de resoluci&oacute;n de quejas proporcionados por la Entidad de Certificaci&oacute;n y Evaluaci&oacute;n (Tenerlos en la papeler&iacute;a del &Aacute;rea del CONOCER de la Entidad de Certificaci&oacute;n y Evaluaci&oacute;n (ECE).</p>
                                        </td>
                                        <td style="width:42.5pt;border-top:none;border-left:none;border-bottom:  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_formatos_seguimientos" id="entrega_formatos_seguimientos1">
                                            </div>
                                        </td>
                                        <td style="width:42.75pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrega_formatos_seguimientos" id="entrega_formatos_seguimientos1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="width: 476.3pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;background: rgb(191, 191, 191);padding: 0cm 5.4pt;height: 17pt;vertical-align: top;">
                                            <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Arial",sans-serif;text-align:center;'><strong>Observaciones:</strong></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="width:476.3pt;border:solid windowtext 1.0pt;border-top:none;background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;">
                                            <textarea  class="form-control" name="" id="" cols="30" rows="3"></textarea>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                            <button type="submit" class="btn btn-sm btn-success">Guardar</button>
                        </form>

                    </div>

                </div>
                <div class="col-0 col-md-3 col-lg-3"></div>
            </div>

    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="https://paradisus.mx/assets/js/jquery.signature.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>

	<script type="text/javascript" class="init">

        $(document).ready(function(){
            $('#example').DataTable();
            $('#historial').DataTable();

            var sig = $('#sig').signature({syncField: '#signed', syncFormat: 'PNG'});
            var sig2 = $('#sig2').signature({syncField: '#signed2', syncFormat: 'PNG'});

            $('#clear').click(function (e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signed").val('');
            });

            $('#clear2').click(function (e) {
                e.preventDefault();
                sig2.signature('clear');
                $("#signed2").val('');
            });


        });

    </script>

  </body>
</html>
