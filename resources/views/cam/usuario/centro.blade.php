@extends('layouts.app_cam')

@section('template_title')
    Centro evaluador
@endsection

@section('css_custom')
    <link href="{{asset('assets/cam/estilos/custom.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="cam_bg_users">

    <div class="row">

        <div class="col-12 mb-5">
            <h1 class="text-center tittle_bold_cam">Bienvenido <br> Centro evaluador: </h1>
            <div class="d-flex justify-content-around">
                @if(auth()->user()->num_user == null or auth()->user()->num_user == "" )
                <p class="text-white text-center">
                </p>
                @else
                <p class="text-white text-center"><strong>No SEP:</strong> <br>
                    {{ auth()->user()->num_user }}
                </p>
                @endif

                <h3 class="text-center tittle_border_cam">{{ auth()->user()->name }}</h3>
                @if(auth()->user()->usuario_eva == null or auth()->user()->usuario_eva == "" )
                <p class="text-white text-center">
                </p>
                @else
                <p class="text-white text-center">
                    <strong>Usuario:</strong> <br>
                    {{ auth()->user()->usuario_eva }} <br>
                    <strong>Contraseña:</strong> <br>
                    {{ auth()->user()->contrasena_eva }}
                </p>
                @endif

            </div>
        </div>

        <div class="col-4">
            <div class="d-flex justify-content-center">
                <div class="card_user">
                    <img src="{{ asset('assets/cam/usuario.png') }}" alt="" width="80px"> <br>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <h5 class="tittle_border_cam_min">Datos generales</h5>
            </div>
        </div>

        <div class="col-4">
            <div class="d-flex justify-content-center">
                <div class="card_user">
                    <a href="{{ route('centro.videos', auth()->user()->code) }}">
                        <img src="{{ asset('assets/cam/reproductor-de-video.png') }}" alt="" width="80px">
                    </a>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('centro.videos', auth()->user()->code) }}" style="text-decoration: none;">
                    <h5 class="tittle_border_cam_min">Videos</h5>
                </a>
            </div>
        </div>


        <div class="col-4">
            <div class="d-flex justify-content-center">
                <div class="card_user">
                    <img src="{{ asset('assets/cam/expediente.png') }}" alt="" width="80px">
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <h5 class="tittle_border_cam_min">Expediente</h5>
            </div>
        </div>


    </div>

</section>

@endsection


