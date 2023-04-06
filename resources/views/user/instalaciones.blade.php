@extends('layouts.app_user')

@section('template_title')
    Nuestras Instalaciones
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/instalaciones.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="primario bg_overley" style="background-image: url('{{asset('assets/user/instalaciones/salon.jpg')}}')">

    <div class="row margin_home_nav">

        <div class="col-12 col-md-6">
            <div id="carouselExample" class="carousel slide">

                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/instalaciones/terraza3.jpg')}}" class="card-img-top" alt="...">
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

        <div class="col-12 col-md-6">
            <h1 class="text-white titulo space_tiitle_slide" style="">
                Instituto Mexicano <br>
                Naturales Ain Spa
            </h1>
            <p class="text-white parrafo parrafo_instalaciones" style="">
                Nuestra misión es llegar a más sectores de la educación a nivel global,
                queremos que los mejores conocimientos y la experiencia de los mayores referentes del mundo estén a disposición de todo aquel
                  que tenga inquietud, ambición y ganas de aprender y de emprender.
            </p>

        </div>

    </div>

</section>


<section class="primario bg_overley" style="background-color:#F5ECE4;">

    <h2 class="titulomin_alfa text-center space_tittle_h2_ni" style="">
        Conoce nuestras instalaciones
    </h2>
    <div class="row">

        <div class="col-12 col-md-4">
            <div class="d-flex justify-content-center">
                <div class="card card-custom space_Card_rs" style="">
                    <img class="card_image" src="{{asset('assets/user/instalaciones/terraza3.jpg')}}" class="card-img-top" alt="...">
                </div>
            </div>

            <p class="text-center mt-3">
                <a type="button" class="btn btn_instalaciones" data-bs-toggle="modal" data-bs-target="#cafeteria">
                    Cafeteria
                </a>
            </p>

        </div>

        <div class="col-12 col-md-4">
             <div class="d-flex justify-content-center">
                <div class="card card-custom space_Card" style="">
                    <img class="card_image" src="{{asset('assets/user/instalaciones/tiendita.jpg')}}" class="card-img-top" alt="...">
                </div>
            </div>
            <p class="text-center mt-3">
                <a type="button" class="btn btn_instalaciones" data-bs-toggle="modal" data-bs-target="#tienda">
                    Tienda
                </a>
            </p>
        </div>

        <div class="col-12 col-md-4">
             <div class="d-flex justify-content-center">
                <div class="card card-custom space_Card" style="">
                    <img class="card_image" src="{{asset('assets/user/instalaciones/salon.jpg')}}" class="card-img-top" alt="...">
                </div>
            </div>
            <p class="text-center mt-3">
                <a type="button" class="btn btn_instalaciones" data-bs-toggle="modal" data-bs-target="#aulas">
                    Aulas
                </a>
            </p>
        </div>

    </div>

</section>

<section class="primario bg_overley" style="background-color:#836262;">
    <div class="row">

        <div class="col-12 col-md-6 m-auto">
            <h1 class="text-white text-center titulo mt-3 mb-3  mt-md-5 mb-md-5" style="">Interior</h1>
            <p class="text-center text-white mt-auto parrafo_instalaciones">
                Nuestras Aulas están equipadas con todo <br> lo necesario para que aprendas de la mejor manera, <br> con los mejores equipos y materiales.
            </p>
        </div>

        <div class="col-12 col-md-6">
            <div class="d-flex justify-content-center">
            <div class="card card-custom space_Card mb-3" style="">
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>

                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/salon.jpg')}}" class="card-img-top" alt="...">
                      </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
            </div>
        </div>

    </div>
</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row">

        <div class="col-12 col-md-6 order-dos">
            <div class="d-flex justify-content-center">
                <div class="card card-custom space_Card" style="">
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="card_image" src="{{asset('assets/user/instalaciones/salon.jpg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 order-uno m-auto">
            <h1 class="text-white text-center titulo mt-5 " style="color:#836262!important;">Exterior</h1>
            <p class="text-center text-white mt-auto parrafo_instalaciones" style="color:#836262!important;">
                Nuestras Aulas están equipadas con todo <br> lo necesario para que aprendas de la mejor manera, <br> con los mejores equipos y materiales.
            </p>
        </div>

    </div>
</section>


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


@endsection

@section('js')


@endsection


