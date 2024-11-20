@extends('layouts.app_cosmika')

@section('template_title')
    Workshop Reconocimiento
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/nosotros.css')}}" rel="stylesheet" />
{{-- css carrusel --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
@endsection

@section('content')

<section class="primario bg_overley" style="position:relative;background-image: url('{{asset('assets/user/utilidades/estrellas.png') }}')">
    <span class="" style="position: absolute;background-size: cover;background-position: center center;top: 0;left: 0;width: 100%;height: 100%;opacity: 0.6;background-color: #2D2034!important"></span>
    <div class="row margin_home_nav ">

        <div class="col-12 col-sm-12 col-md-4 index_superior my-auto">
           <p class="text-center">
            <img class="img_reality" src="{{asset('assets/user/icons/certificate.png') }}">
           </p>
        </div>

        <div class="col-12 col-sm-12 col-md-8 index_superior my-auto">
            <h1 class="text-white titulo space_title_instalaciones space_tiitle_slide mb-5" style="">
                Descarga tu reconocimiento
            </h1>

            <form role="form" action="{{ route('reconocimiento_store.webinar') }}" method="post" enctype="multipart/form-data" style="">
                @csrf
                <input type="hidden" name="tipo_documento" value="Diploma Cosmica">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="text-white" for="basic-url" class="form-label mt-2 mb-2">Nombre completo *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/mujer.png')}}" style="width: 40px">
                            </span>
                            <input class="form-control" type="text" id="nombre" name="nombre" required>
                        </div>
                    </div>

                    <div class="col-2">
                        <button type="submit mt-5" class="btn btn-success w-100">Descargar</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</section>

@endsection

@section('js')

@endsection

