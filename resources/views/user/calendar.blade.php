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
        @include('user.components.navbar')
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
            <div class="d-flex mb-3">
                <div class="me-auto p-2">Próximas Certificaciones</div>
                <div class="p-2">Flex item</div>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">

            <div class="card" style="width: 18rem;">
                <img src="{{ asset('assets/user/utilidades/cosmetologa.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <div class="row">
                    <div class="col-2">
                        SEP <br> 15
                    </div>
                    <div class="col-10">
                        <h3>Carrera de Cosmiatría Estética Avanzada</h3>
                    </div>
                  </div>
                </div>
              </div>

        </div>
    </div>

</section>
{{-- Grid --}}

{{-- footer --}}

@include('admin.users.components.footer')

{{-- footer --}}

@endsection

@section('js')


@endsection


