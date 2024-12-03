@extends('layouts.app_registro')

@section('template_title')
    Registro Nacional LG
@endsection
<link href="{{asset('assets/user/custom/custom.css')}}" rel="stylesheet" />

@section('content')

    <form id="searchForm" class="d-flex" role="search">
        <div class="row">
            <div class="col-12 text-center">
                <label class="text-center mt-3 mt-md-3 mt-lg-5" for="">Emisiones</label> <br>
                <input class="mt-3 input_redoundedos " type="text" placeholder="Ingresa Folio del alumno" name="folio" id="folio">
                <button class="submit_buttom text-white"  type="submit">verificar</button>
            </div>

            <div class="col-12 text-center mt-3 mt-md-3 mt-lg-5">
                <label class="text-center" for="">Afiliaciones</label> <br>
                <input class="mt-3 input_redoundedos " type="text" placeholder="Ingresa nombre de la escuela o institución">
                <button class="submit_buttom text-white"  type="submit">buscar </button>
            </div>
        </div>
    </form>

@endsection


@section('content_result')

<div id="resultsContainer" class="p-0 p-md-2 p-lg-2"></div>

@endsection

@section('registros_emitidos')

<form id="searchForm2" class="row" role="search">
        <div class="col-12 text-center">
            <p class="text-center mt-5 texto_pag" for="">
                Verifica la autenticidad de los <br> registros emitidos
            </p>
            <input class="mt-3 input_redoundedos " type="text" placeholder="Ingresa Folio del alumno">
            <button class="submit_buttom text-white"  type="submit">verificar</button>
        </div>
</form>

@endsection

@section('content_result2')

<div id="resultsContainer2" class="p-0 p-md-2 p-lg-2"></div>

@endsection

@section('content_dinamico')

<style>
    .image-container {
        width: 100%;
        height: 270px; /* Ajusta la altura según lo necesites */
        overflow: hidden;
    }

    .image-fit {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Hace que la imagen ocupe todo el contenedor y mantenga su proporción */
    }

</style>

<div id="registrosCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @php
            $chunks = $registros_imnas->chunk(4); // Divide los registros en grupos de 4
        @endphp

        @foreach ($chunks as $index => $chunk)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="row">
                    @foreach ($chunk as $item)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                            <div class="card p-3 m-4" style="box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);">
                                <p class="text-center">
                                    <div class="image-container">
                                        @if($item->User->escuela == NULL)
                                            <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/registro_nacional.png" class="image-fit">
                                        @else
                                            <img src="{{ asset('documentos/' . $item->User->telefono . '/' . $item->User->logo) }}" class="image-fit">
                                        @endif
                                    </div>
                                </p>
                                <p class="text-center">
                                    @if($item->User->escuela == NULL)
                                        {{ $item->User->name }}
                                    @else
                                        {{ $item->User->escuela }}
                                    @endif
                                </p>
                                <div class="d-flex justify-content-center">
                                    <a target="_blank" href="{{ $item->User->facebook }}" class="mt-2 mb-2" style="margin-left: 1rem;">
                                        <img src="{{ asset('assets/user/utilidades/facebook.png') }}" style="width:25px">
                                    </a>
                                    <a target="_blank" href="{{ $item->User->instagram }}" class="mt-2 mb-2" style="margin-left: 1rem;">
                                        <img src="{{ asset('assets/user/utilidades/instagram.png') }}" style="width:25px">
                                    </a>
                                    <a target="_blank" href="https://api.whatsapp.com/send?phone=521{{ $item->User->celular_casa }}&text=Hola" class="mt-2 mb-2" style="margin-left: 1rem;">
                                        <img src="{{ asset('assets/user/utilidades/whatsapp.png') }}" style="width:25px">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Controles del slider -->
    <button class="carousel-control-prev" type="button" data-bs-target="#registrosCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#registrosCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

@endsection
