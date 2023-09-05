@extends('layouts.app_user')

@section('template_title')
    Nuestras Instalaciones
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/instalaciones.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="primario bg_overley" style="position:relative;background-image: url('{{asset('webpage/'.$webpage->stone_instalaciones_bg) }}')">
    <span class="mask"></span>
    <div class="row margin_home_nav ">

        <div class="col-12 col-sm-12 col-md-6">
            <div id="carouselExample" class="carousel slide">

                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/1.jpg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/2.jpg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/3.jpg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/4.jpg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/5.jpg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/6.jpg')}}" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="d-flex justify-content-center">
                            <div class="card card-custom" style="margin-top: 5rem">
                                <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/7.jpg')}}" class="card-img-top" alt="...">
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
                {{ $webpage->stone_instalaciones_tittle }}
            </h1>
            <p class="text-white parrafo parrafo_instalaciones" style="">
                {{ $webpage->stone_instalaciones_text }}
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
                    <img class="card_image" src="{{asset('assets/user/instalaciones/Areas_Comunes.png')}}"  alt="...">
                </div>
            </div>

            <p class="text-center mt-3">
                <a href="#cafeteria" class="btn btn_instalaciones" >
                    Áreas Comunes
                </a>
            </p>

        </div>

        <div class="col-12 col-md-4">
             <div class="d-flex justify-content-center">
                <div class="card card-custom space_Card" style="">
                    <img class="card_image" src="{{asset('assets/user/instalaciones/tiendita.jpg')}}"  alt="...">
                </div>
            </div>
            <p class="text-center mt-3">
                <a href="#tienda" class="btn btn_instalaciones" >
                    Tienda
                </a>
            </p>
        </div>

        <div class="col-12 col-md-4">
             <div class="d-flex justify-content-center">
                <div class="card card-custom space_Card" style="">
                    <img class="card_image" src="{{asset('assets/user/instalaciones/salon.jpg')}}"  alt="...">
                </div>
            </div>
            <p class="text-center mt-3">
                <a href="#aulas" class="btn btn_instalaciones" >
                    Aulas
                </a>
            </p>
        </div>

    </div>

</section>

<section class="primario bg_overley" style="background-color:#836262;"id="aulas">
    <div class="row">

        <div class="col-12 col-md-6 m-auto">
            <h1 class="text-white text-center titulo mt-3 mb-3  mt-md-5 mb-md-5" style="">Aulas</h1>
            <p class="text-center text-white mt-auto parrafo_instalaciones">
                Nuestras Aulas están equipadas con todo <br> lo necesario para que aprendas de la mejor manera, <br> con los mejores equipos y materiales.
            </p>
        </div>

        <div class="col-12 col-md-6">
            <div class="d-flex justify-content-center">
            <div class="card card-custom space_Card mb-3" style="">
                <div id="carousel_interior" class="carousel slide">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/1.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/2.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/3.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/4.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/7.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/8.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/9.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/10.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/11.jpg')}}"  style="width: 100%;">
                      </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel_interior" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel_interior" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
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
                    <div id="carousel_exterior" class="carousel slide">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/5.jpg')}}"  style="width: 100%;">
                            </div>
                            <div class="carousel-item ">
                              <img class="card_image" src="{{asset('assets/user/instalaciones/retocadas/6.jpg')}}"  style="width: 100%;">
                            </div>
                            <div class="carousel-item ">
                              <img class="card_image" src="{{asset('assets/user/instalaciones/terraza1.jpg')}}"  style="width: 100%;">
                            </div>
                          </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel_exterior" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carousel_exterior" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 order-uno m-auto">
            <h1 class="text-white text-center titulo mt-5 " style="color:#836262!important;">Áreas Comunes</h1>
            <p class="text-center text-white mt-auto parrafo_instalaciones" style="color:#836262!important;">
                Porque sabemos que después de una buena clase, necesitan <br>un buen descanso, contamos con áreas comunes para que <br>puedan relajarse un rato y disfrutar de sus alimentos.
            </p>
        </div>

    </div>
</section>


<section class="primario bg_overley" style="background-color:#836262;"id="tienda">
    <div class="row">

        <div class="col-12 col-md-6 m-auto">
            <h1 class="text-white text-center titulo mt-3 mb-3  mt-md-5 mb-md-5" style="">Tienda</h1>
            <p class="text-center text-white mt-auto parrafo_instalaciones">
                Aquí encontrarás toda nuestra gama de <br>productos y más para tus clases y para empezar<br> tu negocio al finalizar tu formación académica.<br> Todos los productos que encontrarás, son de la<br> mejor calidad y con los mejores precios.
            </p>
        </div>

        <div class="col-12 col-md-6">
            <div class="d-flex justify-content-center">
            <div class="card card-custom space_Card mb-3" style="">
                <div id="carousel_tiendita" class="carousel slide">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/tienda/1.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/tienda/2.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/tienda/3.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/tienda/4.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/tienda/7.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/tienda/8.jpg')}}"  style="width: 100%;">
                      </div>
                      <div class="carousel-item ">
                        <img class="card_image" src="{{asset('assets/user/instalaciones/tienda/9.jpg')}}"  style="width: 100%;">
                      </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel_tiendita" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel_tiendita" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
            </div>
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


@endsection


