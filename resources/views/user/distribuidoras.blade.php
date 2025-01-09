@extends('layouts.app_cosmika')

@section('template_title')
    Nuestras Distribuidoras Autorizadas
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
            <img class="img_reality" src="{{asset('assets/user/utilidades/rating.png') }}">
           </p>
        </div>

        <div class="col-12 col-sm-12 col-md-8 index_superior my-auto">
            <h1 class="text-white titulo space_title_instalaciones space_tiitle_slide" style="">
                ¡Conoce a Nuestras Distribuidoras Autorizadas!
            </h1>
            <p class="text-white parrafo parrafo_instalaciones" style="">
                1° - <strong>Confianza y Calidad:</strong> Solo las distribuidoras autorizadas ofrecen productos genuinos y garantizados. <br>
                2° - <strong>Atención Personalizada:</strong> Disfruta de un servicio cercano, con asesoramiento experto y recomendaciones hechas a medida.  <br>
                3° - <strong>Disponibilidad Local:</strong>Encuentra nuestros productos en tu zona, sin complicaciones ni demoras.<br>
            </p>
            <p class="text-white parrafo parrafo_instalaciones" style="">
                Encuentra tu distribuidora más cercana y descubre la diferencia de comprar con la confianza que solo Cosmica pueden ofrecer. ¡Estamos aquí para servirte mejor!
            </p>
        </div>

    </div>
</section>

<section class="primario bg_overley" style="background-color:#E1D7E6;" id="cafeteria">
    <div class="row">

        {{-- <div class="col-12">
            <h1 class="text-white text-center titulo mt-5 mb-lg-5 mb-md-5" style="color:#2D2034!important;">
                ¡Únete a Nuestra Red de Distribuidoras Autorizadas de IMNAS y Cosmica!
            </h1>
            <p class="text-center mb-5" style="color:#2D2034!important;">
                ¿Te apasionan los productos de calidad y te gustaría emprender con el respaldo de marcas reconocidas? En IMNAS y Cosmica, estamos buscando personas entusiastas y comprometidas para unirse a nuestra familia de distribuidoras autorizadas.
            </p>
        </div> --}}

        <div class="col-12">
            <h4 class="text-white text-center titulo mt-5 mb-lg-5 mb-md-5" style="color:#2D2034!important;">
                Distribuidoras
            </h4>
        </div>

        @foreach ($distribuidora as $item)

        <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-xl-3 mb-lg-3 mb-md-2 m-auto">
            <div class="card_reality" style="position: relative">
                <p class="text-center">
                    <img class="img_reality_alumnas " src="{{asset('utilidades/distribuidoras.jpeg') }}" style="width: 80%;">
                </p>
                <p class="text-center">
                    <strong>{{ $item->User->name }}</strong> <br>
                    {{ $item->direccion_local }}
                </p>
                <div class="d-flex justify-content-center">
                    <a target="_blank" href=" {{ $item->direccion_rs_face }}" class="mt-2 mb-2" style="margin-left: 1rem;">
                        <img src="{{asset('assets/user/utilidades/facebook.png') }}" style="width:25px">
                    </a>
                    <a target="_blank" href=" {{ $item->direccion_rs_insta }}" class="mt-2 mb-2" style="margin-left: 1rem;">
                        <img src="{{asset('assets/user/utilidades/instagram.png') }}" style="width:25px">
                    </a>
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=521{{ $item->direccion_rs_whats }}&text=Hola" class="mt-2 mb-2" style="margin-left: 1rem;">
                        <img src="{{asset('assets/user/utilidades/whatsapp.png') }}" style="width:25px">
                    </a>
                </div>

                {{-- <p class="text-center">
                    <button class="btn-votar" style="background: #fff;color: #2D2034;border-color: #2D2034;">
                        Ver ubicación <span><img src="{{asset('assets/user/utilidades/google-maps.png')}}" style="width: 30px;">
                    </button>
                </p> --}}
            </div>
        </div>

        @endforeach

    </div>
</section>

@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>

@endsection


