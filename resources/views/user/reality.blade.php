@extends('layouts.app_user')

@section('template_title')
   Reality
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/nosotros.css')}}" rel="stylesheet" />
{{-- css carrusel --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
@endsection

@section('content')

<section class="primario bg_overley" style="position:relative;background-image: url('{{asset('assets/user/utilidades/reality/BANNER.png') }}')">
    <span class="mask"></span>
    <div class="row margin_home_nav ">

        <div class="col-12 col-sm-12 col-md-6 index_superior">
           <p class="text-center">
            <img class="img_reality" src="{{asset('assets/user/utilidades/reality/PREMIOS.png') }}">
           </p>
        </div>

        <div class="col-12 col-sm-12 col-md-6 index_superior">
            <h1 class="text-white titulo space_title_instalaciones space_tiitle_slide" style="">
               6 Ganadores | 6 Premios
            </h1>
            <p class="text-white parrafo parrafo_instalaciones" style="">
                1° - Podran ganar un <strong>Centro de Evaluacion</strong> o ser un <strong>Evaluador Independeinte</strong> <br>
                2° - <strong>$50,000 en Productos</strong> Naturlaes Ain Spa.  <br>
                3° - <strong>8 Certificaciones</strong> SEP CONOCER. <br>
                4° - <strong>$10,000 en Productos</strong> Naturales Ain Spa. <br>
                5° - <strong>3 Cretificaciones</strong> SEP CONOCER. <br>
                6° - <strong>Paquete 3 del Instituto Mexicano Naturales Ain Spa.</strong> <br>
            </p>

        </div>

    </div>
</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;" id="cafeteria">
    <div class="row">

        <div class="col-12">
            <h1 class="text-white text-center titulo mt-5 mb-lg-5 mb-md-5" style="color:#836262!important;">
                Conoce a nuestros participantes
            </h1>
            <p class="text-center mb-5" style="color:#836262!important;">
                Recuerda que solo podras votar al inicio y hasta el fin de la transmision en vivo. <br>
                Puedes verlo en nuestra pagina de Facebook <a href="https://www.facebook.com/naturalesainspa?mibextid=ZbWKwL" style="color:#836262!important;" target="_blank"><b> Naturales Ain Spa. </b></a><br><br>
                El evento dará inicio este <b> sábado 10 y domingo 11 de junio a las 8:00 p.m.</b><br>
                Asegúrate de sintonizar y ser parte de esta emocionante experiencia.
            </p>
        </div>

        @foreach ($concursantes as $concursante)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-xl-3 mb-lg-3 mb-md-2 m-auto">
                <div class="card_reality" style="position: relative">
                    <p class="text-center">
                        @if ($concursante->estatus == 'Desabilitado')
                        <img class="img_reality_alumnas descalificado" src="{{asset('reality/'.$concursante->foto_perfil) }}" style="width: 80%;">
                        @else
                        <img class="img_reality_alumnas" src="{{asset('reality/'.$concursante->foto_perfil) }}" style="width: 80%;">
                        @endif
                    </p>
                    <div class="d-flex justify-content-center">
                        <a target="_blank" href="{{ $concursante->facebook }}" class="mt-2 mb-2" style="margin-left: 1rem;">
                            <img src="{{asset('assets/user/utilidades/facebook.png') }}" style="width:25px">
                        </a>
                        <a target="_blank" href="{{ $concursante->instagram }}" class="mt-2 mb-2" style="margin-left: 1rem;">
                            <img src="{{asset('assets/user/utilidades/instagram.png') }}" style="width:25px">
                        </a>
                        <a target="_blank" href="{{ $concursante->tiktok }}" class="mt-2 mb-2" style="margin-left: 1rem;">
                            <img src="{{asset('assets/user/utilidades/tik-tok.png') }}" style="width:25px">
                        </a>

                    </div>
                    @if ($concursante->estatus == 'Desabilitado')

                    @else

                    @if ($webpage->btn_votar == 'Activo')
                        <p class="text-center">
                            <button class="btn-votar" data-id="{{ $concursante->id }}">
                                Votar <span><img src="{{asset('assets/user/utilidades/voto.png')}}" style="width: 30px;">
                            </button>
                        </p>
                    @else
                    @endif
                    <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                    @endif
                </div>
            </div>
        @endforeach

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
$(function() {
    $('.btn-votar').click(function() {
        var concursanteId = $(this).data('id');

        // Verificar si se ha alcanzado el límite de votos permitidos por día
        if (getVotosActuales() >= 5) {
            alert('Has alcanzado el límite de votos permitidos por día');
            return;
        }

        $.ajax({
            type: "POST",
            url: "{{ route('votar') }}",
            data: {
                _token: "{{ csrf_token() }}",
                concursanteId: concursanteId
            },
            success: function(response) {
                // Obtener el número total de votos devuelto por el controlador
                var totalVotos = response.votos;

                // Actualizar el contador de votos en tiempo real
                var contadorElement = $('#contador-' + concursanteId);
                contadorElement.text(totalVotos);

                // Guardar el voto del usuario en el día actual
                guardarVotoHoy(concursanteId);
                alert('Voto Guardado');
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

    function getVotosActuales() {
        var votosCookie = getCookie('votos');
        var votosHoy = votosCookie ? JSON.parse(votosCookie) : [];
        return votosHoy.length;
    }

    function guardarVotoHoy(concursanteId) {
        var votosCookie = getCookie('votos');
        var votosHoy = votosCookie ? JSON.parse(votosCookie) : [];

        // Agregar el ID del concursante al arreglo de votos del día actual
        votosHoy.push(concursanteId);

        // Guardar el arreglo actualizado en la cookie
        setCookie('votos', JSON.stringify(votosHoy), 1);
    }

    function getCookie(name) {
        var cookieArr = document.cookie.split(';');

        for (var i = 0; i < cookieArr.length; i++) {
            var cookiePair = cookieArr[i].split('=');
            if (name === cookiePair[0].trim()) {
                return decodeURIComponent(cookiePair[1]);
            }
        }

        return null;
    }

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }
});



</script>

@endsection


