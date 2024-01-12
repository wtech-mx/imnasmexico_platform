@extends('layouts.app_user')

@section('template_title')
NUESTROS AVALES Y ACREDITACIONES
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/avales.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/hotspot/bootstrap-hotspots.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/metriz/Font-Face/style.css')}}" />

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

{{-- section unam --}}
<section class="primario bg_overley padding_avales_cont" style="background-color:#fff;">
    <div class="row">
        <div class="col-4">
            <div class="container_img_avales">
                <p class="text-center">
                    <img class="img_avales" src="{{asset('assets/user/logotipos/unam.png')}}" alt="">
                </p>
            </div>
        </div>

        <div class="col-8">
            <h2 class="tittle_avales">
                DIPLOMA UNAM
            </h2>
            <h5 class="parrafo_avales">
                El Instituto Naturales Ain Spa, se complace en hacer
                de su conocimiento, que ya contamos con aval ante la
                máxima casa de estudios, UNAM, mediante la Red de
                Educación Continua.
            </h5>
            <p class="parrafo_avales">
                Esto quiere decir que al cursar
                algún diplomado UNAM con nosotros, se podrán
                hacer acreedores de un Diploma totalmente avalado
                ante dicha Institución por medio de la Facultad de
                Estudios Superiores Zaragoza.
            </p>
        </div>

        <div class="col-12">
            <p class="parrafo_avales_2">
                Dicho Diploma, contará
                con validez Oficial, ya que cuenta con todos los sellos
                Institucionales y la firma del Director, validando este
                Documento.
            </p>
        </div>

        <div class="col-12 col-md-4 mt-5">
          <div class="container_nums">
            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07b;"></div>
                    <p class="text_hotspot">Sellos Institucionales en relieve </p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe077;"></div>
                    <p class="text_hotspot">Nombre de la Institución</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe078;"></div>
                    <p class="text_hotspot">Nombre del Alumno</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07d;"></div>
                    <p class="text_hotspot">Nombre Diplomado</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07e;"></div>
                    <p class="text_hotspot">Lugar y Fecha</p>
                </div>
            </div>


            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe079;"></div>
                    <p class="text_hotspot">Nombre y firma del Director</p>
                </div>
            </div>

          </div>
        </div>

        <div class="col-12 col-md-8 mt-5">
                <p class="text-center">
                    <img src="{{asset('webpage/'.$webpage->stavalesunam_image) }}" alt="" class="img_certificados">
                </p>
        </div>

    </div>
</section>

<section class="primario bg_overley padding_avales_cont" style="">
    <div class="row">
        <div class="col-4">
            <div class="container_img_avales">
                <p class="text-center">
                    <img class="img_avales" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                </p>
            </div>
        </div>

        <div class="col-8">
            <h2 class="tittle_avales">
                ¿Qué es un documento SEP CONOCER?
            </h2>
            <h5 class="parrafo_avales">
                Entidad de Certificación y Evaluación
                ECE356-18 Instituto Mexicano Naturales Ain Spa
            </h5>
            <p class="parrafo_avales">
                Es un Documento Oficial de alcance nacional expedido por el Gobierno Federal
                a través del cual se reconocen conocimientos, habilidades, destrezas y actitudes
                individuales que una persona demuestra para brindar un servicio laboral con la calidad y excelencia que los sectores especializados requieren.
            </p>
            {{-- <span class="highlight-spot " data-toggle="popover" data-content="This is an example hotspot!"></span> --}}
        </div>

        <div class="col-12">
            <p class="parrafo_avales_2">
                Es un Documento Oficial de alcance nacional expedido por el Gobierno Federal
                a través del cual se reconocen conocimientos, habilidades, destrezas y actitudes
                individuales que una persona demuestra para brindar un servicio laboral con la calidad y excelencia que los sectores especializados requieren.
            </p>
        </div>

        <div class="col-12 col-md-4 mt-5 ">
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
                    <p class="text_hotspot">Entidad de Certificación</p>
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

        <div class="col-12 col-md-8 mt-5 ">
                <p class="text-center">
                    <img src="{{asset('webpage/'.$webpage->stavalesconocer_image) }}" alt="" class="img_certificados">
                </p>
        </div>

    </div>
</section>

@include('user.components.estandares')

<section class="primario bg_overley padding_avales_cont" style="background-color:#fff;">
    <div class="row">
        <div class="col-4">
            <div class="container_img_avales">
                <p class="text-center">
                    <img class="img_avales" src="{{asset('assets/user/logotipos/revoe.webp')}}" alt="">
                </p>
            </div>
        </div>

        <div class="col-8">
            <h2 class="tittle_avales">
                ¿Qué es un diploma SEP RVOE?
            </h2>
            <h5 class="parrafo_avales">
                Validez Oficial ante la Dirección General de Centro
                De Formación para el Trabajo (D.G.C.F.T) con
                Acuerdo 17FT274
            </h5>
            <p class="parrafo_avales">
                Es un reconocimiento con validez oficial de estudios incorporado
                a un programa o plan de estudios al sistema educativo nacional,
                que cuenta con el aval de la Secretaría de Educación Pública a
                nivel Federal.
            </p>
        </div>

        <div class="col-12">
            <p class="parrafo_avales_2">
                Es un reconocimiento con validez oficial de estudios incorado
                a un programa o plan de estudios al sistema educativo nacional,
                que cuenta con el aval de la Secretaría de Educación Pública a
                nivel Federal.
            </p>
        </div>

        <div class="col-12 col-md-4 mt-5">
          <div class="container_nums">
            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07b;"></div>
                    <p class="text_hotspot">Sello del águila</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe077;"></div>
                    <p class="text_hotspot">Nombre completo</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe078;"></div>
                    <p class="text_hotspot">Curp</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07d;"></div>
                    <p class="text_hotspot">Estudios que cursaste</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07e;"></div>
                    <p class="text_hotspot">Programa de estudios</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe079;"></div>
                    <p class="text_hotspot">Sello y firma digital</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07a;"></div>
                    <p class="text_hotspot">QR único</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07f;"></div>
                    <p class="text_hotspot">Folio único</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07c;"></div>
                    <p class="text_hotspot">Página oficial
                    </p>
                </div>
            </div>

          </div>
        </div>

        <div class="col-12 col-md-8 mt-5">
                <p class="text-center">
                    <img src="{{asset('webpage/'.$webpage->stavalesrevoe_image) }}" alt="" class="img_certificados">
                </p>
        </div>

    </div>
</section>


@include('user.components.revoes')

<section class="primario bg_overley padding_avales_cont" style="background-color:#fff;">
    <div class="row">
        <div class="col-4">
            <div class="container_img_avales">
                <p class="text-center">
                    <img class="img_avales" src="{{asset('assets/user/logotipos/stps.webp')}}" alt="">
                </p>
            </div>
        </div>

        <div class="col-8">
            <h2 class="tittle_avales">
                ¿Qué es un diploma STPS?
            </h2>
            <h5 class="parrafo_avales">
                Validez Oficial ante la Dirección General de Centro
                De Formación para el Trabajo (D.G.C.F.T) con
                Acuerdo 17FT274
            </h5>
            <p class="parrafo_avales">
                Es una constancia que se entrega al finalizar un entrenamiento o curso y es avalada por la Secretaría del Trabajo y Previsión Social (STPS)
            </p>
        </div>

        <div class="col-12">
            <p class="parrafo_avales_2">
                Es una constancia que se entrega al finalizar un entrenamiento o curso y es avalada por la Secretaría del Trabajo y Previsión Social (STPS)
            </p>
        </div>


        <div class="col-12 col-md-4 mt-5">
          <div class="container_nums">
            <div class="d-flex justify-content-start ">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07b;"></div>
                    <p class="text_hotspot">Logos oficiales</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe077;"></div>
                    <p class="text_hotspot">Horas cursadas</p>
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
                    <p class="text_hotspot">Curso o diplomado</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07e;"></div>
                    <p class="text_hotspot">Sello STPS</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe079;"></div>
                    <p class="text_hotspot">Firma auténtica</p>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div class="content_icon_hotspot">
                    <div class="icon_hotspot" aria-hidden="true" data-icon="&#xe07a;"></div>
                    <p class="text_hotspot">Institución</p>
                </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-8 mt-5">
                <p class="text-center">
                    <img src="{{asset('webpage/'.$webpage->stavalesstps_image) }}" alt="" class="img_certificados">
                </p>
        </div>

    </div>
</section>

<section class="primario bg_overley" style="background-color:#fff;">
    <div class="row">
        <div class="col-4">
            <div class="container_img_avales">
                <p class="text-center">
                    <img class="img_avales" src="{{asset('assets/user/logotipos/registro_nmacional.png')}}" alt="">
                </p>
            </div>
        </div>

        <div class="col-8">
            <h2 class="tittle_avales">
                ¿Qué es el Registro Nacional del Instituto Mexicano Naturales Ain Spa?
            </h2>
            <h5 class="tittle_avales">
                Registro Nacional del Instituto Mexicano Naturales Ain Spa
            </h5>
            <p class="parrafo_avales">
                Tiene como principal función, que cada alumno pueda encontrar con facilidad su
                registro, el cual va ligado a cada especialidad que haya cursado con el Instituto.
                Esto representa credibilidad y sustento de los Conocimientos, Capacidades y
                Actitudes.
            </p>
        </div>

        <div class="col-12">
            <p class="parrafo_avales_2">
                Tiene como principal función, que cada alumno pueda encontrar con facilidad su
                registro, el cual va ligado a cada especialidad que haya cursado con el Instituto.
                Esto representa credibilidad y sustento de los Conocimientos, Capacidades y
                Actitudes.
            </p>
        </div>



        <div class="col-12">

            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <p class="text-center">
                        <img src="{{asset('webpage/'.$webpage->stavalesregistro_one_image) }}" class="img_slide_avales" alt="...">
                        </p>
                      </div>

                    <div class="carousel-item">
                        <p class="text-center">
                            <img src="{{asset('webpage/'.$webpage->stavalesregistro_two_image) }}" class="img_slide_avales" alt="...">
                        </p>
                    </div>

                    <div class="carousel-item">
                        <p class="text-center">
                            <img src="{{asset('webpage/'.$webpage->stavalesregistro_three_image) }}" class="img_slide_avales" alt="...">
                        </p>
                    </div>

                    <div class="carousel-item">
                        <p class="text-center">
                            <img src="{{asset('webpage/'.$webpage->stavalesregistro_four_image) }}" class="img_slide_avales" alt="">
                        </p>
                    </div>

                      <div class="carousel-item">
                        <p class="text-center">
                        <img src="{{asset('webpage/'.$webpage->stavalesregistro_five_image) }}" class="img_slide_avales" alt="">
                        </p>
                      </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>

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
        dots: false,
        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
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


