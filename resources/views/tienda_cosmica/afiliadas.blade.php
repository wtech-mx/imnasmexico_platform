@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Sobre Nosotros
@endsection

@section('body_custom')
    bg_afiliado
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/ecommerce_afiliados.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="row">

    <div class="col-6">
        <h3 class="sutittle_conoce text-center mt-5">CONONCE NUESTRA </h3>
        <h2 class="sutittle_red text-center">RED DE EXPERTAS</h2>
        <p class="text-center">
            <img class="text-center img_logo" src="{{ asset('cosmika/logo_2.png') }}" alt="">
        </p>
        <p class="text-center parrafo_about">
            <strong>1° - Confianza y Calidad:</strong><br>
            Solo las distribuidoras autorizadas ofrecen productos
            genuinos y garantizados. <br><br>
            <strong>2° - Atención Personalizada:</strong><br>
            Disfruta de un servicio cercano, con asesoramiento experto y
            recomendaciones hechas a medida. <br><br>
            <strong>3° - Disponibilidad Local:</strong><br>
            Encuentra nuestros productos en tu zona, sin complicaciones
            ni demoras. <br><br>
            <strong>
                Encuentra tu distribuidora más cercana y descubre la
                diferencia de comprar con la confianza que solo Cosmica
                pueden ofrecer. ¡Estamos aquí para servirte mejor!
            </strong>
        </p>
    </div>

    <div class="col-6">
        <h2 class="text-center subtittle_general mt-5">NUESTRA <strong>casa</strong></h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235.20941626014303!2d-99.14291371736127!3d19.39724932469279!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses-419!2smx!4v1737330151620!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <p class="text-center direccion">
            Castilla 136, Álamos, <br>
            Benito Juárez,03400 ,CDMX
        </p>
    </div>

</div>

<div class="row">
    <div class="col-6">
        <h2 class="text-center subtittle_general mt-5">RED DE EXPERTAS
            <strong>Certificadas</strong>
        </h2>
    </div>
</div>

@endsection

@section('js')

@endsection


