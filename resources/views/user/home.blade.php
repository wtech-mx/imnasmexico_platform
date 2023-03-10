@extends('layouts.app_user')

@section('template_title')
    Inicio
@endsection

@section('css_custom')
<link href="{{ asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="primario bg_overley" style="background-image: url('{{ asset('assets/user/utilidades/cosmetologa_bg.jpg')}}')">

    @include('user.components.navbar');

    <div class="row">
        <div class="col-12 col-md-6">
            <h1 class="text-white titulo" style="margin-top: 6rem;">
                Instituto Mexicano <br>
                Naturales Ain Spa
            </h1>
            <p class="text-white parrafo" style="">
                Plataforma número uno de cursos en línea y <br>
                presenciales dedicados a la cosmetología y <br>
                cosmiatría a nivel nacional e internacional.
            </p>
            <div class="d-flex justify-content-start">
                <a class="btn btn-primario me-4">
                    Certificaciones
                </a>
                <a class="btn btn-secundario">
                    Saber mas
                </a>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div id="carouselExample" class="carousel slide">

                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="">
                                <img class="card_image" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" class="card-img-top" alt="...">
                                <div class="card-body card_body_custom">
                                <h5 class="card-title card_modalidad">Presencial</h5>
                                <h3 class="card_titulo">CURSO DE PIEDRAS CALIENTES</h3>
                                <h4 class="card_date">Jueves 16 de Febrero</h4>

                                <a class="btn btn-primario me-3">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            Comprar ahora
                                        </p>
                                        <div class="card_bg_btn ">
                                            <i class="fas fa-cart-plus card_icon_btn"></i>
                                        </div>
                                    </div>
                                </a>

                                <a class="btn btn-secundario me-1">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            Saber mas
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fas fa-plus card_icon_btn_secundario"></i>
                                        </div>
                                    </div>
                                </a>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
            </div>

        </div>
    </div>

</section>


<section class="primario bg_overley" style="background-color:#F5ECE4;">

    <div class="row mt-5">

        <div class="col-6 col-md-3">
            <div class="d-flex justify-content-center">
                <div class="card_certificaciones">
                    <p class="text-center">
                        <img class="img_card_certificaciones" src="{{ asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                    </p>
                </div>
            </div>
            <p class="text-center mt-5 custom-info-logo">
                Son grandes empresas que tienen carácter regional o nacional y que garantizan que hay independencia en las áreas de capacitación, evaluación y certificación.
            </p>
        </div>

        <div class="col-6 col-md-3">
            <div class="d-flex justify-content-center">
                <div class="card_certificaciones">
                    <p class="text-center">
                        <img class="img_card_certificaciones" src="{{ asset('assets/user/logotipos/revoe.png')}}" alt="">
                    </p>
                </div>
            </div>
            <p class="text-center mt-5 custom-info-logo">
                Son grandes empresas que tienen carácter regional o nacional y que garantizan que hay independencia en las áreas de capacitación, evaluación y certificación.
            </p>
        </div>

        <div class="col-6 col-md-3">
            <div class="d-flex justify-content-center">
                <div class="card_certificaciones">
                    <p class="text-center">
                        <img class="img_card_certificaciones" src="{{ asset('assets/user/logotipos/unam.png')}}" alt="">
                    </p>
                </div>
            </div>
            <p class="text-center mt-5 custom-info-logo">
                Son grandes empresas que tienen carácter regional o nacional y que garantizan que hay independencia en las áreas de capacitación, evaluación y certificación.
            </p>
        </div>

        <div class="col-6 col-md-3">
            <div class="d-flex justify-content-center">
                <div class="card_certificaciones">
                    <p class="text-center">
                        <img class="img_card_certificaciones" src="{{ asset('assets/user/logotipos/stps.png')}}" alt="">
                    </p>
                </div>
            </div>
            <p class="text-center mt-5 custom-info-logo">
                Son grandes empresas que tienen carácter regional o nacional y que garantizan que hay independencia en las áreas de capacitación, evaluación y certificación.
            </p>
        </div>

        <div class="col-12 tittle_section2 mb-3">
            <h2 class="titulo_alfa text-center">Materializa tus metas</h2>
            <h3 class="titulo_beta text-center">Da tu primer paso con nosotros</h3>
            <div class="d-flex justify-content-center">
            <h6 class="titulo_delta text-center mt-3">
                Instituto incorporado a la SEP con más de 35 años en el mundo de la belleza, certificando a miles de alumnos desde su comienzo,
                 con residencia en CDMX, ahora a nivel internacional, brindando la mejor educación dermocosmética, basados en el
                 mejor nivel educativo y práctico con educadores profesionales a nivel internacional.
            </h6>
            </div>
        </div>

        <div class="col-12 col-md-6 objetivos_mt">
            <div class="row">
                <div class="col-6">
                    <div class="d-flex justify-content-end">
                        <div class="card_objetivos">
                            <p class="text-center">
                                <img class="img_card_objetivos" src="{{ asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                            </p>
                            <p class="text-center card_title_objetivos">AMAS DE CASA</p>
                            <p class="text-center card_text_objetivos">Aprovecha tu tiempo libre</p>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="d-flex justify-content-start">
                        <div class="card_objetivos">
                            <p class="text-center">
                                <img class="img_card_objetivos" src="{{ asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                            </p>
                            <p class="text-center card_title_objetivos">EMPRENDERORAS</p>
                            <p class="text-center card_text_objetivos">Inicia tu propio Negocio.</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 py-3">
                    <div class="d-flex justify-content-end">
                        <div class="card_objetivos">
                            <p class="text-center">
                                <img class="img_card_objetivos" src="{{ asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                            </p>
                            <p class="text-center card_title_objetivos">ESTUDIANTES DE BELLEZA</p>
                            <p class="text-center card_text_objetivos">Construye una carera profesional.</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 py-3">
                    <div class="d-flex justify-content-start">
                        <div class="card_objetivos">
                            <p class="text-center">
                                <img class="img_card_objetivos" src="{{ asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                            </p>
                            <p class="text-center card_title_objetivos">APASIONADAS POR LA BELLEZA</p>
                            <p class="text-center card_text_objetivos">
                                Ya eres una profesional, ahora
                                estudia tu pasión.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Nuestros Beneficios --}}
        <div class="col-12 col-md-6 objetivosmin_mt">
            <h2 class="titulomin_alfa text-center mb-4">Nuestros Beneficios</h2>

            <div class="row ">
                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{ asset('assets/user/icons/certificado-de-garantia.webp')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        Garantía de estudiar en una escuela avalada por las máximas dependencias gubernamentales.
                    </p>
                </div>

                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{ asset('assets/user/icons/clase.webp')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        Las clases son teórico-demostrativas, donde el profesor realizará el procedimiento con modelo en vivo.
                    </p>
                </div>

                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{ asset('assets/user/icons/documentos.png')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        La documentación que recibirás estará avalada por la SEP o STPS
                    </p>
                </div>

                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{ asset('assets/user/icons/aprender-en-linea.webp')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        Nuestros cursos, talleres, carreras y diplomados quedarán grabados por 72 hrs para que puedas verlos nuevamente.
                    </p>
                </div>

                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{ asset('assets/user/icons/cuaderno.webp')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        Recibirás material de apoyo de acuerdo a tu clase como: ponencia módulo por modulo, fichas técnicas, libros digitales, grabación de la clase, catálogos y más.
                    </p>
                </div>

                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{ asset('assets/user/icons/aprender-en-linea-1.webp')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        Nuestros cursos, talleres, carreras y diplomados van dirigidos a personas sin conocimiento que quieran prepararse desde 0 o que cuentan con conocimiento y experiencia previa.
                    </p>
                </div>
            </div>

        </div>
</section>

{{-- slide de cursos --}}
<section>
    <div class="bgimg-1" style="height: 500px;background-image: url('{{ asset('assets/user/utilidades/spa.jpg')}}')">

    </div>
</section>

{{--Laboratorio --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row">
        <div class="col-12 col-md-6">
            <h2 class="titulomin_alfa text-left mb-4" style="margin-left: 30px;">Laboratorio Naturales Ain Spa</h2>
            <p class="text-left text_beneficios mb-4">
                El Instituto Mexicano Naturales Ain Spa es un Instituto incorporado a la SEP
                y STPS, también es una Entidad de Certificación y Evaluación SEP Conocer.   <br><br>

                Contamos con más de 35 años en el mundo de la belleza y salud,<br>
                 preparando y certificando a alumnos a nivel nacional e internacional.
            </p>
            <div class="row">
                <div class="col-3" style="">
                    <div class="d-flex justify-content-center">
                        <div class="rounded_lab">
                            <p class="text-center">
                                <img class="img_rounded_lab" src="{{ asset('assets/user/icons/icono-bb-glow-1.webp')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-3" style="">
                    <div class="d-flex justify-content-center">
                        <div class="rounded_lab">
                            <p class="text-center">
                            <img class="img_rounded_lab" src="{{ asset('assets/user/icons/icono-corporal.webp')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-3" style="">
                    <div class="d-flex justify-content-center">
                        <div class="rounded_lab">
                            <p class="text-left">
                            <img class="img_rounded_lab" src="{{ asset('assets/user/icons/icono-facial.webp')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-3" style="">
                    <div class="d-flex justify-content-center">
                        <div class="rounded_lab">
                            <p class="text-left">
                            <img class="img_rounded_lab" src="{{ asset('assets/user/icons/icono-relex-1.webp')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <a class="btn btn-cuarto" style="margin-left: 1rem;">
                        Ver Catalogo
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="row">

                <div class="col-12 mb-3">
                    <div class="img_lab_principal" style="background-image: url('{{ asset('assets/user/utilidades/lab.jpg')}}')">
                    </div>
                </div>

                <div class="col-4">
                    <img class="img_lab_secundary px-3" src="{{ asset('assets/user/utilidades/doctiura.jpg')}}" alt="">
                </div>

                <div class="col-4">
                    <img class="img_lab_secundary px-3" src="{{ asset('assets/user/utilidades/manos_product.jpg')}}" alt="">
                </div>

                <div class="col-4">
                    <img class="img_lab_secundary px-3" src="{{ asset('assets/user/utilidades/producto_palciacion.jpg')}}" alt="">
                </div>

            </div>
        </div>
    </div>
</section>

{{--Productos --}}
<section class="primario bg_overley" style="background-color:#836262;">
    <div class="row">
        <div class="col-12">
            <h2 class="titulo_alfa text-center" style="color: #fff!important">
                Nuestro Catalogo
            </h2>
            <p class="text-center mt-5">
                <img class="px-3" src="{{ asset('assets/user/utilidades/captura_productos.png')}}" alt="" style="width:80%;">
            </p>
        </div>
    </div>
</section>

{{--UNAM --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row">
        <div class="col-12 col-md-6">
            <div id="slide_unam" class="carousel slide">

                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="">
                                <img class="card_image" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" class="card-img-top" alt="...">
                                <div class="card-body card_body_custom">
                                <h5 class="card-title card_modalidad">Presencial</h5>
                                <h3 class="card_titulo">CURSO DE PIEDRAS CALIENTES</h3>
                                <h4 class="card_date">Jueves 16 de Febrero</h4>

                                <a class="btn btn-primario me-3">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            Comprar ahora
                                        </p>
                                        <div class="card_bg_btn ">
                                            <i class="fas fa-cart-plus card_icon_btn"></i>
                                        </div>
                                    </div>
                                </a>

                                <a class="btn btn-secundario me-1">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            Saber mas
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fas fa-plus card_icon_btn_secundario"></i>
                                        </div>
                                    </div>
                                </a>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#slide_unam" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#slide_unam" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <h2 class="titulomin_alfa text-left mb-4">
                !Avalados ante la casa maxima <br>
                casa de estudios UNAM!
            </h2>
            <p class="text-left text_beneficios mb-4" style="margin-left: 0px!important">
                Cosmetria Estetica <br>
                Medicina Estetica <br>
            </p>
            <p class="registro_num2 mt-3 mb-5">
                Numero de Registro : 60616-1236-17-x-22
            </p>
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="d-flex justify-content-center">
                        <div class="card_certificaciones">
                            <p class="text-center">
                                <img class="img_card_certificaciones" src="{{ asset('assets/user/logotipos/DOCTORA.png')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="d-flex justify-content-center">
                        <div class="card_certificaciones">
                            <p class="text-center">
                                <img class="img_card_certificaciones" src="{{ asset('assets/user/logotipos/unam.png')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- testimonios --}}
<section class="primario bg_overley" style="background-color:#836262;">
    <div class="row">
        <div class="col-12">
            <h2 class="titulo_alfa text-center" style="color: #fff!important">
                Lo que dicen de  <br>
                nuestros estudiantes...
            </h2>
            <p class="text-center mt-5">
                <img class="px-3" src="{{ asset('assets/user/utilidades/captura.png')}}" alt="">
            </p>
        </div>
    </div>
</section>
{{-- testimonios --}}

{{-- Ubicacion --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">

<div class="row">
    <div class="col-12">

        <div class="d-flex justify-content-center">

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                <li class="nav-item" role="presentation" style="margin-right: 30px;">
                  <button class="nav-link active" id="pills-alamos-tab" data-bs-toggle="pill" data-bs-target="#pills-alamos" type="button" role="tab" aria-controls="pills-alamos" aria-selected="true">
                    <i class="fas fa-map-marker-alt"></i> Alamos
                  </button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-churubusco-tab" data-bs-toggle="pill" data-bs-target="#pills-churubusco" type="button" role="tab" aria-controls="pills-churubusco" aria-selected="false">
                    <i class="fas fa-map-marker-alt"></i> Churubusco
                  </button>
                </li>

              </ul>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-alamos" role="tabpanel" aria-labelledby="pills-alamos-tab" tabindex="0">

                    <iframe class="map_custom" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30110.056826145097!2d-99.14852410230698!3d19.379667296620767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses-419!2smx!4v1678243651126!5m2!1ses-419!2smx"  style="" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>

                <div class="tab-pane fade" id="pills-churubusco" role="tabpanel" aria-labelledby="pills-churubusco-tab" tabindex="0">
                    <iframe class="map_custom" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15057.050845494474!2d-99.12426469013091!3d19.35777413013712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe13ff298e83%3A0xbf7af804aa5b83a4!2sSur%20109-A%20260%2C%20H%C3%A9roes%20de%20Churubusco%2C%20Iztapalapa%2C%2009090%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1678243972623!5m2!1ses-419!2smx"  style="" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

              </div>
        </div>



    </div>
</div>

</section>
{{-- Ubicacion --}}

{{-- footer --}}

@include('admin.users.components.footer')

{{-- footer --}}

@endsection

@section('js')


@endsection


