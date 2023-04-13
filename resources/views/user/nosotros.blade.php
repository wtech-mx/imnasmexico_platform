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


<section class="primario bg_overley" style="background-color:#836262;">
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
</section>

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


