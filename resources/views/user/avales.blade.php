@extends('layouts.app_user')

@section('template_title')
NUESTROS AVALES Y ACREDITACIONES
@endsection

@section('css_custom')
<link href="{{ asset('assets/user/custom/avales.css')}}" rel="stylesheet" />
<link href="{{ asset('assets/user/hotspot/bootstrap-hotspots.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/metriz/Font-Face/style.css')}}" />

{{-- css carrusel --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
crossorigin="anonymous" />
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
crossorigin="anonymous" />

@endsection

@section('content')

<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row">
        <div class="col-12 tittle_section2 espace_tittle_avales mb-3">
            <h2 class="titulo_alfa text-center">NUESTROS AVALES</h2>
            <h3 class="titulo_beta text-center">Y ACREDITACIONES</h3>
        </div>
    </div>
</section>

<section class="primario bg_overley" style="background-color:#fff;padding: 2rem 5rem 0rem 5rem;">
    <div class="row">
        <div class="col-2 col-md-4">
            <div class="container_img_avales">
                <p class="text-center">
                    <img class="img_avales" src="{{ asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                </p>
            </div>
        </div>

        <div class="col-10 col-md-8">
            <h2 class="tittle_avales">
                Entidad de Certificación y Evaluación
                ECE356-18 Instituto Mexicano Naturales Ain Spa
            </h2>
            <p class="parrafo_avales">
                Es un documento oficial de alcance nacional expedido por el gobierno federal
                a través del cual se reconocen conocimientos, habilidades, destrezas y actitudes
                individuales que una persona demuestra para brindar un servicio laboral con la calidad y excelencia que los sectores especializados requieren
            </p>
            {{-- <span class="highlight-spot " data-toggle="popover" data-content="This is an example hotspot!"></span> --}}
        </div>

        <div class="col-12 col-md-4 mt-5">
          <div class="container_nums">
            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07b;"></div>
                    <p class="text_hotspot">Logos oficiales</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe077;"></div>
                    <p class="text_hotspot">Curp</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe078;"></div>
                    <p class="text_hotspot">Nombre completo</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07d;"></div>
                    <p class="text_hotspot">Nombre del estándar</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07e;"></div>
                    <p class="text_hotspot">Organismo certificado</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe079;"></div>
                    <p class="text_hotspot">QR SEP Conocer</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07a;"></div>
                    <p class="text_hotspot">Número de folio</p>
                </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-8 mt-5">
                <p class="text-center">
                    <img src="{{ asset('assets/user/certificaciones/RECONOCIMIENTO-CONOCER.webp')}}" alt="" class="img_certificados">
                </p>
        </div>

    </div>
</section>

<section class="primario bg_overley" style="background-color:#fff;">
    <div class="row">
        <div class="col-12 mb-5">
            <h2 class="titulo_alfa text-center">¿Con cuáles</h2>
            <h3 class="titulo_beta text-center">estándares contámos?</h3>
        </div>

        <div class="col-12 m-auto">

            <div class="owl-carousel owl-theme">

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC0046</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0046.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">Prestación de servicios cosmetológicos faciales.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC0186</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0186.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">Gestión de negocios spa</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC0217.01</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0217.01.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">
                                    lmpartición de cursos de formación del capital humano de manera presencial grupal.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC0361</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0361.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">Aplicación de uñas acrílicas postizas en nivel básico.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC0613</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0613.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">Aplicación de uñas acrílicas con técnica escultural.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC0616</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0616.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">
                                    Prestación de servicios auxiliares de enfermería en cuidados básicos y orientación a personas en unidades de atención médica
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC0715.01</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0715.01.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">
                                    Aplicación de micropigmentación estética facial.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC0792</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0792.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">
                                    Prestación de servicios auxiliares en el manejo del material de consumo en unidades de atención médica
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC0793</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0793.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">
                                    Prestación de servicios auxiliares en el uso de equipo médico e instrumental en unidades de atención médica
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC0859</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0859.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">Diseño de maquillaje profesional</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC0899</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0899.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">Aplicacion de masaje tejido profundo.</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC0900</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0900.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">Prestación de servicios cosmetológicos faciales.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC0902</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C0902.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">Aplicación de Masaje Drenaje Linfático Manual</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC1045</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C1045.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">
                                    Diseño de cejas con efecto pelo a pelo con pigmento semipermanente/microblading
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC1313</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C1313.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">
                                    Aplicación de técnicas para el mejoramiento de la apariencia cutánea facial mediante dermapen
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC1336</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C1336.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">Cosmetológicos faciales y corporales</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC1391</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C1391.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">Prestación de servicios de cosmiatría estética</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC1414</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C1414.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">
                                    Aplicación de sistemas de alisado progresivo procedimiento para la reparación y nutrición de la fibra capilar
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC1463</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/C1463.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">Aplicación de procedimiento para el cambio direccional de cejas y pestañas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC0010</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/EC0010.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">Prestación de servicios estéticos corporales.</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC0611</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/ec0611.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">Prestación de servicios cosmetológicos faciales.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC0954</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/ec0954.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">Cuidado estético de uñas, manos y pies y acabado gel semipermanente</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC1049</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/ec1049.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">Aplicación de masaje de reflexología podal</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC1467</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/ec1467.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">Manejo integral de tratamientos estéticos capilares y vello facial</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">EC1468</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/estandares/ec1468.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">Manejo integral de tratamientos estéticos corporales</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="primario bg_overley" style="background-color:#fff;">
    <div class="row">
        <div class="col-4">
            <div class="container_img_avales">
                <p class="text-center">
                    <img class="img_avales" src="{{ asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                </p>
            </div>
        </div>

        <div class="col-8">
            <h2 class="tittle_avales">
                Validez Oficial ante la Dirección General de Centro
                De Formación para el Trabajo (D.G.C.F.T) con
                Acuerdo 17FT274
            </h2>
            <p class="parrafo_avales">
                Es el reconocimiento de validez oficial de estudios e incorporación de un programa o plan de estudios al sistema educativo nacional
                Si un Diplomado o Carrera lo tiene, cuenta con el aval de la Secretaría de Educación Pública a nivel federal.
            </p>
        </div>

        <div class="col-4 mt-5">
          <div class="container_nums">
            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07b;"></div>
                    <p class="text_hotspot">Logos oficiales</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe077;"></div>
                    <p class="text_hotspot">Curp</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe078;"></div>
                    <p class="text_hotspot">Nombre completo</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07d;"></div>
                    <p class="text_hotspot">Nombre del estándar</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07e;"></div>
                    <p class="text_hotspot">Organismo certificado</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe079;"></div>
                    <p class="text_hotspot">QR SEP Conocer</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07a;"></div>
                    <p class="text_hotspot">Número de folio</p>
                </div>
            </div>
          </div>
        </div>

        <div class="col-8 mt-5">
                <p class="text-center">
                    <img src="{{ asset('assets/user/certificaciones/Rectangulo-103.webp')}}" alt="" class="img_certificados">
                </p>
        </div>

    </div>
</section>

<section class="primario bg_overley" style="background-color:#fff;">
    <div class="row">
        <div class="col-12 mb-5">
            <h2 class="titulo_alfa text-center">¿Con cuáles</h2>
            <h3 class="titulo_beta text-center">RVOE contámos?</h3>
        </div>

        <div class="col-12 m-auto">

            <div class="owl-carousel owl-theme">

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">17FT275</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/revoes/RVOE-17FT275-1.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">Cuidado de manos y pies</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">17FT229</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/revoes/RVOE-17FT229-min.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">Micropigmentación Facial</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">17FT274</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/revoes/RVOE-17FT274-1.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">Cosmetología Facial</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">EC1467</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{ asset('assets/user/revoes/RVOE-17FT273-1-1.webp')}}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">Cosmetología corporal</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>


<section class="primario bg_overley" style="background-color:#fff;">
    <div class="row">
        <div class="col-4">
            <div class="container_img_avales">
                <p class="text-center">
                    <img class="img_avales" src="{{ asset('assets/user/logotipos/stps.webp')}}" alt="">
                </p>
            </div>
        </div>

        <div class="col-8">
            <h2 class="tittle_avales">
                Validez Oficial ante la Dirección General de Centro
                De Formación para el Trabajo (D.G.C.F.T) con
                Acuerdo 17FT274
            </h2>
            <p class="parrafo_avales">
                Es el reconocimiento de validez oficial de estudios e incorporación de un programa o plan de estudios al sistema educativo nacional
                Si un Diplomado o Carrera lo tiene, cuenta con el aval de la Secretaría de Educación Pública a nivel federal.
            </p>
        </div>

        <div class="col-4 mt-5">
          <div class="container_nums">
            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07b;"></div>
                    <p class="text_hotspot">Logos oficiales</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe077;"></div>
                    <p class="text_hotspot">Curp</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe078;"></div>
                    <p class="text_hotspot">Nombre completo</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07d;"></div>
                    <p class="text_hotspot">Nombre del estándar</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07e;"></div>
                    <p class="text_hotspot">Organismo certificado</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe079;"></div>
                    <p class="text_hotspot">QR SEP Conocer</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07a;"></div>
                    <p class="text_hotspot">Número de folio</p>
                </div>
            </div>
          </div>
        </div>

        <div class="col-8 mt-5">
                <p class="text-center">
                    <img src="{{ asset('assets/user/certificaciones/DIPLOMA-ONLINE.png')}}" alt="" class="img_certificados">
                </p>
        </div>

    </div>
</section>

<section class="primario bg_overley" style="background-color:#fff;">
    <div class="row">
        <div class="col-4">
            <div class="container_img_avales">
                <p class="text-center">
                    <img class="img_avales" src="{{ asset('assets/user/logotipos/registro_nmacional.png')}}" alt="">
                </p>
            </div>
        </div>

        <div class="col-8">
            <h2 class="tittle_avales">
                Registro nacional instituto naturales ain spa

            </h2>
            <p class="parrafo_avales">
                El registro nacional del  instituto mexicano naturales ain spa es un registro interno donde se lleva un padrón detallado de cada uno de los alumnos que han acreditado las carreras, diplomados y certificaciones de acuerdo a los estatus requeridos en cada uno de ellos otorgando así credibilidad y sustento de los conocimientos , capacidades y aptitudes del egresado
            </p>
        </div>

        <div class="col-4 mt-5">
          <div class="container_nums">
            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07b;"></div>
                    <p class="text_hotspot">Logos oficiales</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe077;"></div>
                    <p class="text_hotspot">Curp</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe078;"></div>
                    <p class="text_hotspot">Nombre completo</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07d;"></div>
                    <p class="text_hotspot">Nombre del estándar</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07e;"></div>
                    <p class="text_hotspot">Organismo certificado</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe079;"></div>
                    <p class="text_hotspot">QR SEP Conocer</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07a;"></div>
                    <p class="text_hotspot">Número de folio</p>
                </div>
            </div>
          </div>
        </div>

        <div class="col-8 mt-5">
                <p class="text-center">
                    <img src="{{ asset('assets/user/certificaciones/Rectangulo-103.webp')}}" alt="" class="img_certificados">
                </p>
        </div>

    </div>
</section>

@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>

<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 15,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })
</script>
@endsection


