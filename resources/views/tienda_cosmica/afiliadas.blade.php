@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Afiliados
@endsection

@section('body_custom')
    bg_afiliado
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/ecommerce_afiliados.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="container">
    <div class="row">

        <div class="col-12 col-sm-6 col-md-6 col-lg-6 ">
            <h3 class="sutittle_conoce text-center mt-5">CONONCE NUESTRA </h3>
            <h2 class="sutittle_red text-center ">RED DE EXPERTAS</h2>
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

        <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-auto">
            <h2 class="text-center subtittle_general mt-5">NUESTRA <strong>casa</strong></h2>
            <iframe class="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235.20941626014303!2d-99.14291371736127!3d19.39724932469279!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses-419!2smx!4v1737330151620!5m2!1ses-419!2smx" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p class="text-center direccion">
                Castilla 136, Álamos, <br>
                Benito Juárez,03400 ,CDMX
            </p>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <h2 class="text-center subtittle_general mt-3 mt-sm-2 mt-md-3 mt-lg-5 mb-3 mb-sm-3 mb-md-3 mb-lg-5">RED DE EXPERTAS
                <strong>Certificadas</strong>
            </h2>
        </div>

        @foreach ($distribuidora as $index => $item)
        @if ($index % 2 == 0)
            <!-- Diseño 1 -->
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <div class="container_lineas_afiliados">
                    <div class="content mb-3 mt-3">
                        <div class="img_container_afiliados mx-auto">
                            <img class="img_grid_afiliados" src="{{ asset('cosmika/estados/' . str_replace(' ', '_', $item->User->state) . '.png') }}" alt="{{ $item->User->state }}">
                        </div>
                    </div>
                </div>

                <div class="container_lineas_afiliados mt-3 mb-3">
                    <div class="content">
                        <div class="img_container_afiliados mx-auto">
                            <img class="img_grid_afiliados" src="{{ asset('cosmika/inicio/ESTRELLAS-DORADAS.png') }}" alt="Protector">
                        </div>
                    </div>
                </div>

                <p class="text-center">
                    <strong>{{ $item->User->name }}</strong> <br>
                    {{ $item->direccion_local }}

                </p>

                <div class="d-flex justify-content-center">
                    <a target="_blank" href="{{ $item->direccion_rs_face }}" class="mt-2 mb-2" style="margin-left: 1rem;">
                        <img src="{{ asset('assets/user/utilidades/facebook.png') }}" style="width:25px">
                    </a>
                    <a target="_blank" href="{{ $item->direccion_rs_insta }}" class="mt-2 mb-2" style="margin-left: 1rem;">
                        <img src="{{ asset('assets/user/utilidades/instagram.png') }}" style="width:25px">
                    </a>
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=521{{ $item->direccion_rs_whats }}&text=Hola" class="mt-2 mb-2" style="margin-left: 1rem;">
                        <img src="{{ asset('assets/user/utilidades/whatsapp.png') }}" style="width:25px">
                    </a>
                </div>
            </div>
        @else
            <!-- Diseño 2 -->
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <div class="container_lineas_afiliados_2">
                    <div class="content mb-3 mt-3">
                        <div class="img_container_afiliados mx-auto">
                            <img class="img_grid_afiliados" src="http://imnasmexico_platform.test/utilidades/logo_negativo.png" alt="Protector">
                        </div>
                    </div>
                </div>

                <div class="container_lineas_afiliados_2 mt-3 mb-3">
                    <div class="content">
                        <div class="img_container_afiliados mx-auto">
                            <img class="img_grid_afiliados" src="{{ asset('cosmika/inicio/ESTRELLAS-DORADAS.png') }}" alt="Protector">
                        </div>
                    </div>
                </div>

                <p class="text-center">
                    <strong>{{ $item->User->name }}</strong> <br>
                    {{ $item->direccion_local }}
                </p>

                <div class="d-flex justify-content-center">
                    <a target="_blank" href="{{ $item->direccion_rs_face }}" class="mt-2 mb-2" style="margin-left: 1rem;">
                        <img src="{{ asset('assets/user/utilidades/facebook.png') }}" style="width:25px">
                    </a>
                    <a target="_blank" href="{{ $item->direccion_rs_insta }}" class="mt-2 mb-2" style="margin-left: 1rem;">
                        <img src="{{ asset('assets/user/utilidades/instagram.png') }}" style="width:25px">
                    </a>
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=521{{ $item->direccion_rs_whats }}&text=Hola" class="mt-2 mb-2" style="margin-left: 1rem;">
                        <img src="{{ asset('assets/user/utilidades/whatsapp.png') }}" style="width:25px">
                    </a>
                </div>
            </div>
        @endif
    @endforeach


        </div>
    </div>
</div>


@endsection

@section('js')

@endsection


