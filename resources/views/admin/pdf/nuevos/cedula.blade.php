<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cédula de Identidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .certificate {
            background-size: contain;
            padding: 0px;
            font-family: 'Arial', sans-serif;
        }

        .certificate h1, .certificate h2, .certificate h3 {
            font-weight: bold;
            color: #06485E;
        }

        .photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 3px solid #06485E;
            margin: 20px auto;
            overflow: hidden;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .signatures img {
            width: 100px;
        }

        .qr-code img {
            width: 100px;
        }

        .footer-text {
            font-size: 14px;
            color: #333;
        }
    </style>

@php
    $domain = request()->getHost();
    $basePath = ($domain == 'plataforma.imnasmexico.com')
            ? 'https://plataforma.imnasmexico.com/documentos_nuevos/cedula/'
            : 'documentos_nuevos/cedula/';
@endphp

</head>
<body>
    <div class="certificate container-fluid text-center" style="background: url('{{ $basePath . 'fondo.png'}}') no-repeat center center;">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}"  class="img-fluid" style="width: 100px;">
                    <img src="am360-logo.png" class="img-fluid" style="width: 100px;">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}"  class="img-fluid" style="width: 100px;">
                </div>
                <h1 class="mt-4">CÉDULA DE IDENTIDAD</h1>
                <h2 class="mt-3">JUANA DE ALARCÓN</h2>
                <h3>EN LA ESPECIALIDAD DE</h3>
                <h2>COSMIATRÍA Y COSMETOLOGÍA</h2>
                <p class="mt-3">
                    En virtud de haber concluido satisfactoriamente con los créditos honoríficos requeridos
                    con respecto al plan vigente. Con fundamento en los estatutos institucionales del
                    Instituto Mexicano Naturales Ain Spa.
                </p>
                <div class="mt-4">
                    <span class="fw-bold">FOLIO</span>
                    <h3>CFC000918771</h3>
                </div>
                <div class="photo">
                    <img src="juana-foto.png" alt="Foto de Juana de Alarcón">
                </div>
                <div class="row mt-4 signatures">
                    <div class="col-4">
                        <p>JUAN PABLO SOTO</p>
                        <p>COMITÉ DICTAMINADOR RNIMNAS</p>
                        <img src="firma1.png" alt="Firma 1">
                    </div>
                    <div class="col-4">
                        <p>LIC. CARLA RIZO FLORES</p>
                        <p>DIRECTORA GENERAL IMNAS</p>
                        <img src="firma2.png" alt="Firma 2">
                    </div>
                    <div class="col-4">
                        <p>LIC. MA. LUISA FLORES</p>
                        <p>EMISOR DE CERTIFICADOS RNIMNAS</p>
                        <img src="firma3.png" alt="Firma 3">
                    </div>
                </div>
                <div class="qr-code mt-4">
                    <img src="qr-code.png" alt="Código QR">
                </div>
                <p class="mt-4 footer-text">
                    Expedido en la Ciudad de México, día 10 de noviembre de 2024.<br>
                    LA AUTENTICIDAD DEL PRESENTE DOCUMENTO PUEDE SER VERIFICADA ESCANEANDO EL QR.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
