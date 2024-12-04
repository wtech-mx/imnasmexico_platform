@extends('layouts.app_registro')

@section('template_title')
    Nosotros
@endsection

@section('section_pag')

    <section id="nosotros" class="row separador_section">

        <div class="col-12">
            <h2 class="titulo_custom_registro">Acerca de <br> <strong>Registro Nacional</strong></h2>
            <p style="position: relative">
                <img src="{{ asset('assets/user/icons/Documentos-RN_1.webp') }}" alt="" class="img_acerca_de" >
            </p>
        </div>

        <div class="col-12">
            <p class="texto_pag2 mt-4">
                El Registro Nacional IMNAS Mexico (RIM) , Certificadora Nacional Notariada,
                es una iniciativa respaldada por la <strong>Secretaría del Trabajo y Previsión Social (STPS)</strong> y el <strong>Registro Nacional</strong> ,
                diseñada para garantizar que los profesionales y centros educativos cumplan con los más altos estándares de calidad a nivel nacional.
                Nuestra plataforma, cuenta con una base de datos centralizada y accesible donde se almacenan todos los registros emitidos por nuestra entidad.
            </p>
            <h3 class="titulo_custom mt-4 mb-4">Nuestro objetivo</h3>
            <p class="texto_pag2">
                Con el respaldo de autoridades oficiales, nuestro objetivo es impulsar la profesionalización y
                certificación laboral en México, ofreciendo validez y reconocimiento formal para fortalecer el
                desarrollo profesional en diversos sectores.
            </p>
        </div>

        <div class="col-12 col-md-12 col-lg-6 my-auto">
            <p class="">
                <img src="{{ asset('assets/user/icons/computer.webp') }}" alt="" class="img_contenedor" >
            </p>
        </div>

        <div class="col-12 col-md-12 col-lg-6">
            <h3  class="titulo_custom3 right_text mb-3">¿Cómo funciona?</h3>
            <h4  class="titulo_custom4 right_text mt-3">1. Emisión de Documentos:</h4>
            <p class="texto_pag2 right_text">
                Cada certificado emitido por IMNAS incluye un código QR único
            </p>

            <h4  class="titulo_custom4 mt-3 text-left">2. Verificación:</h4>
            <p class="texto_pag2">
                Al escanear este código QR con cualquier dispositivo móvil,
                se accede directamente al Registro Nacional de Certificación IMNAS.
            </p>

            <h4  class="titulo_custom4 right_text mt-3">3. Autenticidad:</h4>
            <p class="texto_pag2 right_text">
                La página de verificación mostrará los detalles del
                documento, confirmando su autenticidad y validación por
                parte de IMNAS.
            </p>

            <h4  class="titulo_custom4 mt-3">4. Búsqueda Manual:</h4>
            <p class="texto_pag2">
                Además del escaneo del QR,
                también puedes ingresar el código de certificación en nuestro sitio web
                para verificar la validez del documento.
            </p>
        </div>

        <div class="col-12 col-md-12 col-lg-6 my-auto order-2 order-lg-1">
            <h3  class="titulo_custom4">
                Registro Nacional y <br> su importancia
            </h3>
            <p class="texto_pag2">
                El Registro Nacional de Certificación IMNAS
                asegura que cada documento emitido bajo
                nuestro aval es genuino y ha sido otorgado de acuerdo
                con los más altos estándares educativos.
                Esto protege tanto a los titulares de los certificados
                como a las instituciones que confían en estas acreditaciones,
                asegurando la integridad del proceso de certificación.
            </p>
        </div>


        <div class="col-12 col-md-12 col-lg-6 my-auto order-1 order-lg-2">
            <img src="{{ asset('assets/user/icons/diploma-c_sello.webp') }}" alt="" class="img_contenedor" >
        </div>

        <div class="col-12 col-md-12 col-lg-6 my-auto">
            <img src="{{ asset('assets/user/icons/mundial.webp') }}" alt="" class="img_contenedor" >
        </div>

        <div class="col-12 col-md-12 col-lg-6 my-auto">
            <p class="texto_pag2 container_text" style="margin: 0!important;">
                Gracias a nuestro sistema, garantizamos que los certificados emitidos sean reconocidos a nivel nacional e internacional,
                brindando una herramienta poderosa para todos aquellos

            </p>
            <p class="texto_pag2 container_text">
                <img src="{{ asset('assets/user/icons/mundi-birrete.webp') }}" alt="" class="img_contenedor_text" >
                que buscan la validación de sus competencias  y
                habilidades  en un entorno  cada vez más exigente y globalizado.
            </p>
        </div>

    </section>

@endsection
