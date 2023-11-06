@extends('layouts.app_user')

@section('template_title')
   Videos
@endsection

@section('css_custom')

<link href="{{asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/nosotros.css')}}" rel="stylesheet" />

{{-- css carrusel --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
@endsection

@php
    use Carbon\Carbon;
    use Carbon\CarbonInterface;
@endphp

@section('content')

<div id="carousel_full" class="carousel slide" data-bs-ride="carousel">
    <span class="mask_calendar"></span>

    <div class="carousel-inner">
        @foreach ($cursos_slide as $curso)
        @php
            $hora_inicial = strftime("%H:%M %p", strtotime($curso->hora_inicial)) ;
            $hora_final = strftime("%H:%M %p", strtotime($curso->hora_final)) ;
            $dia = date("d", strtotime($curso->fecha_inicial));
            $mes = date("M", strtotime($curso->fecha_inicial));

            $fecha_ini = $curso->fecha_inicial;
            $fechaInicialCarbon = Carbon::createFromFormat('Y-m-d', $fecha_ini);
            $nombreDia = $fechaInicialCarbon->locale('es')->isoFormat('dddd');
            $nombreDiaCapitalizado = ucfirst($nombreDia);
            $fecha_inicial = $nombreDiaCapitalizado . ' ' . $fechaInicialCarbon->isoFormat('D [de] MMMM');

            $fecha_f = $curso->fecha_final;
            $fechaInicialCarbon2 = Carbon::createFromFormat('Y-m-d', $fecha_f);
            $nombreDia2 = $fechaInicialCarbon2->locale('es')->isoFormat('dddd');
            $nombreDiaCapitalizado2 = ucfirst($nombreDia2);
            $fecha_final = $nombreDiaCapitalizado2 . ' ' . $fechaInicialCarbon2->isoFormat('D [de] MMMM');

            $horaInicial = $curso->hora_inicial;
            $hora_inicial = Carbon::createFromFormat('H:i:s', $horaInicial)->format('h:i A');

            $horaFinal = $curso->hora_final;
            $hora_final = Carbon::createFromFormat('H:i:s', $horaFinal)->format('h:i A');
        @endphp
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="background-image: url('{{asset('curso/'. $curso->foto) }}')">
                <div class="row postion_row_caledanrio">
                    <div class="col-12 col-md-8">
                        <div class="conten_slilder_full">
                            <h1 class="text-white titulo titulo_full" style="">
                                {{$curso->nombre}}
                            </h1>

                            <a class="btn btn-secundario_grid me-3 mb-2 mb-lg-5 mb-md-4 mt-4 mt-md-4 mt-lg-5">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        {{$curso->modalidad}}
                                    </p>
                                </div>
                            </a>

                            <h3 class="text-white parrafo_full mb-4 mb-lg-5 mb-md-4">
                                {{$fecha_inicial}} @if ($curso->fecha_inicial == $curso->fecha_final) @else
                                al {{$fecha_final}} <br>
                                @endif
                                @if ($curso->sin_fin == '1')
                                    {{$hora_inicial}}</p>
                                @else
                                    {{$hora_inicial}} - {{$hora_final}}</p>
                                @endif
                            </h3>

                            <div class="d-flex justify-content-start">
                                <a class="btn btn-secundario me-1" href="{{ route('cursos.show',$curso->slug) }}">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            Saber más
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fas fa-plus card_icon_btn_secundario"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carousel_full" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carousel_full" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>

</div>


<section class="primario bg_overley" style="background-color:#F5ECE4;"id="tienda">
    <div class="row">

        <div class="col-12">
            <h3 class="text-center" style="color:#836262;">
                Videos Productos
            </h3>
        </div>

        <div class="col-12 p-3">
                    <div id="carousel_tiendita" class="carousel slide">
                        <div class="carousel-inner">
                           @foreach ($noticias_producto as $item)
                            @if ($item->estatus === 'Activo')
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row">
                                        <div class="col-12 col-lg-6 col-md-6 my-auto">
                                            <div class="d-flex justify-content-center">
                                                <div class="card card-custom space_Card mb-3 mt-lg-3 mt-md-5" style="">
                                                    @if ($item->tipo === 'imagen')

                                                        <img class="card_image" src="{{asset('noticias/'.$item->multimedia) }}"  style="width: 100%;">

                                                    @elseif ($item->tipo === 'Video')

                                                    <video controls autoplay>
                                                            <source src="{{asset('noticias/'.$item->multimedia) }}" type="video/mp4">
                                                        </video>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 col-md-6 my-auto">
                                            <h1 class="text-dark text-center titulo mt-3 mb-3  mt-md-5 mb-md-5" style="">{{ $item->titulo }}</h1>
                                            <p class="text-center text-dark mt-auto parrafo_instalaciones">
                                                {{ $item->descripcion }}
                                            </p>

                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-sm bg-white text-dark" style="margin-left: 1rem;" target="_blank" href="{{ $item->link }}">
                                                    Ver
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                           @endforeach
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
</section>

<section class="primario bg_overley" style="background-color:#836262;"id="tienda">
    <div class="row">
        <h3 class="text-center" style="color:#F5ECE4;">
            Videos Alumnas
        </h3>
        <div class="col-12 p-3">
                    <div id="carousel_productos" class="carousel slide">
                        <div class="carousel-inner">
                           @foreach ($noticias_alumnas as $item)
                            @if ($item->estatus === 'Activo')
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row">

                                        <div class="col-12 col-lg-6 col-md-6 my-auto">
                                            <h1 class="text-white text-center titulo mt-3 mb-3  mt-md-5 mb-md-5" style="">{{ $item->titulo }}</h1>
                                            <p class="text-center text-white mt-auto parrafo_instalaciones">
                                                {{ $item->descripcion }}
                                            </p>

                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-sm btn-cuarto" style="margin-left: 1rem;" target="_blank" href="{{ $item->link }}">
                                                    Ver
                                                </a>

                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 col-md-6 my-auto">
                                            <div class="d-flex justify-content-center">
                                                <div class="card card-custom space_Card mb-3 mt-lg-3 mt-md-5" style="">
                                                    @if ($item->tipo === 'imagen')

                                                        <img class="card_image" src="{{asset('noticias/'.$item->multimedia) }}"  style="width: 100%;">

                                                    @elseif ($item->tipo === 'Video')

                                                    <video controls autoplay>
                                                            <source src="{{asset('noticias/'.$item->multimedia) }}" type="video/mp4">
                                                        </video>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif
                           @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel_productos" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carousel_productos" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

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


