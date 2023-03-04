@extends('layouts.app_user')

@section('template_title')
    Inicio
@endsection

@section('content')

<section class="primario bg_overley" style="background-image: url('{{ asset('assets/user/utilidades/cosmetologa_bg.jpg')}}')">

    @include('user.components.navbar');

    <div class="row">
        <div class="col-6">
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

        <div class="col-6">

            <div id="carouselExample" class="carousel slide">

            <div class="carousel-inner">
                {{-- card slide --}}
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

        <div class="col-3">
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

        <div class="col-3">
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

        <div class="col-3">
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

        <div class="col-3">
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

        <div class="col-6 objetivos_mt">
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
        <div class="col-6 objetivosmin_mt">
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




@endsection
