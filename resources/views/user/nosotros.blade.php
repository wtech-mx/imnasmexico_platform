@extends('layouts.app_user')

@section('template_title')
   Nosotros
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/nosotros.css')}}" rel="stylesheet" />
{{-- css carrusel --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
@endsection

@section('content')

<section class="primario bg_overley" style="position:relative;background-image: url('{{asset('webpage/'.$webpage->stone_nosotros_bg) }}')">
    <span class="mask"></span>
    <div class="row margin_home_nav ">

        <div class="col-12 col-sm-12 col-md-6">
            <div id="carouselExample" class="carousel slide">

                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/nosotros/1.jpeg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/nosotros/2.jpeg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/nosotros/3.jpeg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/nosotros/4.jpeg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/nosotros/5.jpeg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/nosotros/6.jpeg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/nosotros/7.jpeg')}}" class="card-img-top" alt="...">
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

        <div class="col-12 col-sm-12 col-md-6 index_superior">
            <h1 class="text-white titulo space_title_instalaciones  space_tiitle_slide" style="">
                {{ $webpage->stone_nosotros_tittle }}
            </h1>
            <p class="text-white parrafo parrafo_instalaciones" style="">
                {{ $webpage->stone_nosotros_text }}
            </p>

        </div>

    </div>

</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;" id="cafeteria">
    <div class="row">

        <div class="col-12 col-md-6 order-uno m-auto">
            <h1 class="text-white text-center titulo mt-5 " style="color:#836262!important;">Reality</h1>
            <p class="text-center text-white mt-auto parrafo_instalaciones" style="color:#836262!important;">
                ¡Participa en el primer reality de IMNAS! <br>
                Demuestra tu talento y gana increíbles premios.
            </p>
        </div>

        <div class="col-12 col-md-6 order-dos">
            <div class="d-flex justify-content-center">
                <div class="card card-custom space_Card" style="">
                    <div id="carousel_reality" class="carousel slide">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="card_image" src="{{asset('assets/user/nosotros/reality_1.jpg')}}"  style="width: 100%;">
                            </div>

                            <div class="carousel-item ">
                                <img class="card_image" src="{{asset('assets/user/nosotros/reality_2.jpg')}}"  style="width: 100%;">
                            </div>

                            <div class="carousel-item ">
                                <img class="card_image" src="{{asset('assets/user/nosotros/reality_3.jpg')}}"  style="width: 100%;">
                            </div>

                            <div class="carousel-item ">
                                <img class="card_image" src="{{asset('assets/user/nosotros/reality_4.jpg')}}"  style="width: 100%;">
                            </div>

                            <div class="carousel-item ">
                                <img class="card_image" src="{{asset('assets/user/nosotros/reality_5.jpg')}}"  style="width: 100%;">
                            </div>


                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel_reality" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel_reality" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                                </button>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<section class="primario bg_overley" style="background-color:#F5ECE4;" id="cafeteria">
    <div class="row">

        <div class="col-12 col-md-6 order-dos">
            <div class="d-flex justify-content-center">
                <div class="card card-custom space_Card" style="">
                    <div id="carousel_conferencias" class="carousel slide">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <video class="video_nosotros" controls>
                                    <source src="{{asset('assets/user/nosotros/VIDEO_CORTO_CONFERENCIA.MP4')}}" type="video/mp4">
                                </video>                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 order-uno m-auto">
            <h1 class="text-white text-center titulo mt-5 " style="color:#836262!important;">CONFERENCIA</h1>
            <p class="text-center text-white mt-auto parrafo_instalaciones" style="color:#836262!important;">
                Tuvimos la fortuna de llevarles grandes Médicos Certificados, en
                nuestra Conferencia, donde pudimos tener grandes ponencias de
                nivel médico con diversos temas actuales, de la Medicina Estética.
                También hubo demostraciones, rifas, y mucho más. ¡Gracias a todos
                los que nos acompañaron!
            </p>
        </div>

    </div>
</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;" id="cafeteria">
    <div class="row">

        <div class="col-12 col-md-6 order-uno m-auto">
            <h1 class="text-white text-center titulo mt-5 " style="color:#836262!important;">EXPOS</h1>
            <p class="text-center text-white mt-auto parrafo_instalaciones" style="color:#836262!important;">
                Hemos tenido la fortuna de estar presentes en diversas Expos que,
                gracias a todos ustedes, siempre son un éxito. Les damos las gracias a
                todas las personas que nos siguen y a los que se unen en cada
                evento, ¡Bienvenidos!
            </p>
        </div>

        <div class="col-12 col-md-6 order-dos">
            <div class="d-flex justify-content-center">
                <div class="card card-custom space_Card" style="">
                    <div id="carousel_expos" class="carousel slide">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <video class="video_nosotros" controls>
                                    <source src="{{asset('assets/user/nosotros/EXPO.MP4')}}" type="video/mp4">
                                </video>                            </div>
                          </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;" id="cafeteria">
    <div class="row">

        <div class="col-12 col-md-6 order-dos">
            <div class="d-flex justify-content-center">
                <div class="card card-custom space_Card" style="">
                    <div id="carousel_conferencias" class="carousel slide">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <video class="video_nosotros" controls>
                                    <source src="{{asset('assets/user/nosotros/DIPLOMADO_MEDICINA_UNAM.MP4')}}" type="video/mp4">
                                </video>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 order-uno m-auto">
            <h1 class="text-white text-center titulo mt-5 " style="color:#836262!important;">
                DIPLOMADO
            </h1>
            <h2 class="text-center" style="color:#836262!important;font-size:19px">
                UNIVERSITARIO DE MEDICINA ESTÉTICA AVALADO
                ANTE LA UNAM
            </h2>
            <p class="text-center text-white mt-auto parrafo_instalaciones" style="color:#836262!important;">
                Nos honramos en hacer de su conocimiento que ya somos una
                Institución avalada ante la máxima casa de estudios, UNAM.
                Añadimos a nuestra oferta educativa, un Diplomado de nivel Médico
                para todos aquellos egresados de la carrera de Medicina, que quieran
                extender sus estudios en el área de la medicina estética. Al finalizar
                recibirán una Diploma totalmente avalado ante la UNAM a través de
                la Facultad de Estudios Superiores Zaragoza.
            </p>
        </div>

    </div>
</section>


<section class="primario bg_overley" style="background-color:#836262;"id="alumnado">
    <div class="row">

        <div class="col-12 col-md-6 m-auto">

            <h1 class="text-white text-center titulo mt-3 mb-3  mt-md-5 mb-md-5" style="">ALUMNADO</h1>
            <p class="text-center text-white mt-auto parrafo_instalaciones">
                Hemos formado alumnos desde hace más de 35 años y, en todo este tiempo, siempre hemos ofrecido los mejores temas y los más actualizados. <br>
                Cada vez hemos sumado más y más avales para respaldar todos los estudios y así, ofrecer solo educación de primer nivel. <br>
                Estamos muy agradecidos con todas las personas que han pasado por las aulas de IMNAS y han depositado su confianza en nosotros para ser quienes los ayuden a formar sus carreras.
            </p>

        </div>

        <div class="col-12 col-md-6">
            <div class="d-flex justify-content-center">
                <div class="card card-custom space_Card mb-3" style="">
                    <div id="carousel_alumnado" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img class="card_image" src="{{asset('assets/user/nosotros/1.jpeg')}}"  style="width: 100%;">
                            </div>

                            <div class="carousel-item ">
                              <img class="card_image" src="{{asset('assets/user/nosotros/2.jpeg')}}"  style="width: 100%;">
                            </div>

                            <div class="carousel-item ">
                                <img class="card_image" src="{{asset('assets/user/nosotros/3.jpeg')}}"  style="width: 100%;">
                            </div>

                            <div class="carousel-item ">
                                <img class="card_image" src="{{asset('assets/user/nosotros/4.jpeg')}}"  style="width: 100%;">
                              </div>

                              <div class="carousel-item ">
                                  <img class="card_image" src="{{asset('assets/user/nosotros/5.jpeg')}}"  style="width: 100%;">
                              </div>

                              <div class="carousel-item ">
                                <img class="card_image" src="{{asset('assets/user/nosotros/6.jpeg')}}"  style="width: 100%;">
                              </div>

                              <div class="carousel-item ">
                                  <img class="card_image" src="{{asset('assets/user/nosotros/7.jpeg')}}"  style="width: 100%;">
                              </div>

                              <div class="carousel-item ">
                                <img class="card_image" src="{{asset('assets/user/nosotros/8.jpeg')}}"  style="width: 100%;">
                            </div>

                            <div class="carousel-item ">
                                <img class="card_image" src="{{asset('assets/user/nosotros/9.jpeg')}}"  style="width: 100%;">
                            </div>

                            <div class="carousel-item ">
                              <img class="card_image" src="{{asset('assets/user/nosotros/10.jpeg')}}"  style="width: 100%;">
                          </div>

                          </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel_alumnado" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel_alumnado" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- <section class="primario bg_overley" style="background-color:#836262;">
    <div class="row">

        <div class="col-12">
            <h2 class="titulo_alfa tittle_nosotros mt-3 mb-5 text-center" style="color: #fff!important">
                Nosotros
            </h2>
        </div>

        <div class="col-12 m-auto mb-5">
            <div class="owl-carousel owl-theme">

                <div class="item" style="">
                    <div class="d-flex justify-content-center">
                        <div class="card_video">
                            <video class="video_nosotros" controls>
                                <source src="{{asset('assets/user/nosotros/DIPLOMADO_MEDICINA_UNAM.MP4')}}" type="video/mp4">
                            </video>

                            <div class="minicontent_video">
                                <h2 class="tittle_video">Diplomado </h2>
                                <p class="text_video"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item" style="">
                    <div class="d-flex justify-content-center">
                        <div class="card_video">
                            <div class="minicontent_video">
                                <h2 class="tittle_video">Expos</h2>
                                <p class="text_video"></p>
                            </div>

                            <video class="video_nosotros" controls>
                                <source src="{{asset('assets/user/nosotros/EXPO.MP4')}}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>

                <div class="item" style="">
                    <div class="d-flex justify-content-center">
                        <div class="card_video">

                            <video class="video_nosotros" controls>
                                <source src="{{asset('assets/user/nosotros/VIDEO DOCUMENTACIÓN.MP4')}}" type="video/mp4">
                            </video>

                            <div class="minicontent_video">
                                <h2 class="tittle_video">Documentos</h2>
                                <p class="text_video"></p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="item" style="">
                    <div class="d-flex justify-content-center">
                        <div class="card_video">
                            <div class="minicontent_video">
                                <h2 class="tittle_video">Conferencias</h2>
                                <p class="text_video"></p>
                            </div>

                            <video class="video_nosotros" controls>
                                <source src="{{asset('assets/user/nosotros/VIDEO_CORTO_CONFERENCIA.MP4')}}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section> --}}

{{-- Ubicacion --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row">
        <div class="col-12 espaciador_ubicacion">

            <div class="d-flex justify-content-center">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                    <li class="nav-item" role="presentation" style="margin-right: 30px;">
                    <button class="nav-link active" id="pills-alamos-tab" data-bs-toggle="pill" data-bs-target="#pills-alamos" type="button" role="tab" aria-controls="pills-alamos" aria-selected="true">
                        <i class="fas fa-map-marker-alt"></i> Álamos
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


@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>
<style>

</style>
<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 30,
        left:30,
        paddimg:30,
        nav: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
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


