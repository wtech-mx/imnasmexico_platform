@extends('layouts.app_registro')

@section('template_title')
    Afiliate
@endsection


@section('section_pag')

<section id="afiliate" class="row">

    <div class="col-12 col-md-12 col-lg-6 my-auto">
        <h2 class="titulo_custom_registro">Afiliación<br> <strong>Registro IMNAS</strong></h2>
        <p class="texto_pag2 mt-4">
            Entendemos la importancia de ofrecer programas educativos de calidad que no solo eduquen,
             sino que también ofrezcan un reconocimiento oficial a tus alumnos. Es por eso que hemos creado <strong>Registro IMNAS,
            avalado por la STPS e IMNAS</strong>, para brindarte respaldo y valor curricular.
        </p>
    </div>

    <div class="col-12 col-md-12 col-lg-6 my-auto">
        <img src="{{ asset('assets/user/icons/todos-docs.webp') }}" alt="" class="img_contenedor" >
    </div>

    <div class="col-6">
        <h2 class="titulo_custom_registro"> <strong>Beneficios de la</strong> <br> afiliación</h2>
    </div>

    <div class="col-6"></div>


    <div class="col-6">
        <p class="text-center">
            <img src="{{ asset('assets/user/icons/reconocimiento.webp') }}" alt="" class="img_icon" >
        </p>
        <h4  class="titulo_custom4 mt-3 text-center">Reconocimiento oficial</h4>
        <p class="texto_pag2">
            Todos los documentos emitidos cuentan con validez nacional,
            respaldados por Registro IMNAS y la STPS,
            cumpliendo con los más altos estándares educativos y laborales.
        </p>
    </div>

    <div class="col-6">
        <p class="text-center">
            <img src="{{ asset('assets/user/icons/Portabilidad.webp') }}" alt="" class="img_icon" >
        </p>
        <h4  class="titulo_custom4 mt-3 text-center">Portabilidad</h4>
        <p class="texto_pag2">
            Ofrecemos <strong>documentos</strong> en formatos <strong>físicos</strong> y <strong>digitales</strong>,
            facilitando su manejo y verificación en cualquier lugar
        </p>
    </div>

    <div class="col-6">
        <p class="text-center">
            <img src="{{ asset('assets/user/icons/empleo.webp') }}" alt="" class="img_icon" >
        </p>
        <h4  class="titulo_custom4 mt-3 text-center">Incremento en oportunidades <br> laborales</h4>
        <p class="texto_pag2">
            Según datos del INEGI, los profesionales certificados tienen un <strong>30% más de probabilidades de acceder a mejores empleos.</strong>
        </p>
    </div>

    <div class="col-6">
        <p class="text-center">
            <img src="{{ asset('assets/user/icons/aumento.webp') }}" alt="" class="img_icon" >
        </p>
        <h4  class="titulo_custom4 mt-3 text-center">Aumento salarial</h4>
        <p class="texto_pag2">
            Estudios internacionales muestran que las certificaciones pueden incrementar el salario hasta un 15%,
             marcando la diferencia en el mercado laboral.
        </p>
    </div>

    <div class="col-6 my-auto">
        <img src="{{ asset('assets/user/icons/qr_imagen.png') }}" alt="" class="img_contenedor" >
    </div>

    <div class="col-6">
        <p class="text-center">
            <img src="{{ asset('assets/user/icons/alianza.webp') }}" alt="" class="img_icon" >
        </p>
        <h4  class="titulo_custom4 mt-3 text-center">Credibilidad profesional</h4>
        <p class="texto_pag2">
            Mejora tu perfil ante empleadores, colaboradores y alumnos,
            posicionándote como un <strong>profesional altamente preparado.</strong>
        </p>
    </div>


</section>

@endsection
