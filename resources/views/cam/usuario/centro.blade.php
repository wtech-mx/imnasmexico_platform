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
            <h1 class="text-center tittle_bold_cam">Bienvenido <br> Centro evaluador: </h1> <h3 class="text-center tittle_border_cam">{{ auth()->user()->name }}</h3>
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
                    <a href="{{ route('videos.centro') }}">
                        <img src="{{ asset('assets/cam/reproductor-de-video.png') }}" alt="" width="80px">
                    </a>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('videos.centro') }}" style="text-decoration: none;">
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

