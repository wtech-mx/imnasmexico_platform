@extends('layouts.app_user')

@section('template_title')
    Inicio
@endsection

@section('css_custom')
<link href="{{ asset('assets/user/custom/grid_cursos.css')}}" rel="stylesheet" />
<style>
    .carousel-item {
    height: 100vh;
    min-height: 350px;
    background: no-repeat center center scroll;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    }
</style>
@endsection

@section('content')

  <header>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('https://source.unsplash.com/LAaSoL0LrYs/1920x1080')">
          <div class="carousel-caption">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item" style="background-image: url('https://source.unsplash.com/bF2vsubyHcQ/1920x1080')">
          <div class="carousel-caption">
            <h5>Second slide label</h5>
            <p>Some representative placeholder content for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item" style="background-image: url('https://source.unsplash.com/szFUQoyvrxM/1920x1080')">
          <div class="carousel-caption">
            <h5>Third slide label</h5>
            <p>Some representative placeholder content for the third slide.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </header>

{{-- Grid --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">

    <div class="row">
        <div class="col-12">
            <div class="d-flex mb-5">
                <div class="me-auto p-2">
                    <h5 class="tittle_proximas_cer">Próximas Certificaciones</h5>
                </div>
                <div class="p-2">Flex item</div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- card_grid --}}

        <div class="col-6 col-md-4">

            <div class="card card_grid" style="">
                <img class="img_card_grid" src="{{ asset('assets/user/utilidades/cosmetologa.jpg')}}" class="card-img-top" alt="...">

                <p class="precio_grid">$9,000.0</p>
                <p class="modalidado_grid">Online</p>
                <p class="wish_grid"><i class="fas fa-heart"></i></p>
                <p class="share_grid"><i class="fas fa-share-alt"></i></p>
                <p class="horario_grid">3:00 PM - 7:00 PM</p>

                <div class="card-body">
                  <div class="row">

                    <div class="col-2 mt-4">
                       <h4 class="fecha_card_grid text-center">
                        SEP <br> <strong class="fecha_strong_card_grid"> 15</strong>
                       </h4>
                    </div>

                    <div class="col-10 mt-4">
                        <h3 class="tittle_card_grid">Carrera de Cosmiatría Estética Avanzada</h3>

                        <div class="d-flex mb-3">
                            <div class="me-auto p-2">
                                <a class="btn btn_primario_grd_curso">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn_grid my-auto">
                                            Comprar ahora
                                        </p>
                                        <div class="card_bg_btn ">
                                            <i class="fas fa-cart-plus card_icon_btn_grid"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="p-2">
                                <a class="btn btn_secundario_grd_curso">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn_grid my-auto">
                                            Saber mas
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fas fa-plus card_icon_btn_secundario_grid"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                          </div>

                    </div>

                  </div>
                </div>
              </div>

        </div>

        <div class="col-4">

            <div class="card card_grid" style="">
                <img class="img_card_grid" src="{{ asset('assets/user/utilidades/cosmetologa.jpg')}}" class="card-img-top" alt="...">

                <p class="precio_grid">$9,000.0</p>
                <p class="modalidado_grid">Online</p>
                <p class="wish_grid"><i class="fas fa-heart"></i></p>
                <p class="share_grid"><i class="fas fa-share-alt"></i></p>
                <p class="horario_grid">3:00 PM - 7:00 PM</p>

                <div class="card-body">
                  <div class="row">

                    <div class="col-2 mt-4">
                       <h4 class="fecha_card_grid text-center">
                        SEP <br> <strong class="fecha_strong_card_grid"> 15</strong>
                       </h4>
                    </div>

                    <div class="col-10 mt-4">
                        <h3 class="tittle_card_grid">Carrera de Cosmiatría Estética Avanzada</h3>

                        <div class="d-flex mb-3">
                            <div class="me-auto p-2">
                                <a class="btn btn_primario_grd_curso">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn_grid my-auto">
                                            Comprar ahora
                                        </p>
                                        <div class="card_bg_btn ">
                                            <i class="fas fa-cart-plus card_icon_btn_grid"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="p-2">
                                <a class="btn btn_secundario_grd_curso">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn_grid my-auto">
                                            Saber mas
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fas fa-plus card_icon_btn_secundario_grid"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                          </div>



                    </div>

                  </div>
                </div>
              </div>

        </div>

        <div class="col-4">

            <div class="card card_grid" style="">
                <img class="img_card_grid" src="{{ asset('assets/user/utilidades/cosmetologa.jpg')}}" class="card-img-top" alt="...">

                <p class="precio_grid">$9,000.0</p>
                <p class="modalidado_grid">Online</p>
                <p class="wish_grid"><i class="fas fa-heart"></i></p>
                <p class="share_grid"><i class="fas fa-share-alt"></i></p>
                <p class="horario_grid">3:00 PM - 7:00 PM</p>

                <div class="card-body">
                  <div class="row">

                    <div class="col-2 mt-4">
                       <h4 class="fecha_card_grid text-center">
                        SEP <br> <strong class="fecha_strong_card_grid"> 15</strong>
                       </h4>
                    </div>

                    <div class="col-10 mt-4">
                        <h3 class="tittle_card_grid">Carrera de Cosmiatría Estética Avanzada</h3>

                        <div class="d-flex mb-3">
                            <div class="me-auto p-2">
                                <a class="btn btn_primario_grd_curso">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn_grid my-auto">
                                            Comprar ahora
                                        </p>
                                        <div class="card_bg_btn ">
                                            <i class="fas fa-cart-plus card_icon_btn_grid"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="p-2">
                                <a class="btn btn_secundario_grd_curso">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn_grid my-auto">
                                            Saber mas
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fas fa-plus card_icon_btn_secundario_grid"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                          </div>



                    </div>

                  </div>
                </div>
              </div>

        </div>

        {{-- card_grid --}}
    </div>

</section>
{{-- Grid --}}

@endsection

@section('js')


@endsection


