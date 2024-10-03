@extends('layouts.app_registro')

@section('template_title')
    Registro Nacional Buscador
@endsection


@section('content')

<div class="row " style="background-color: #fff">
    <div class="col-12 col-sm-12 col-md-12 my-auto">

        <h2 class="text-dark text-center mt-5" style="">
            Explora el Registro Nacional de Certificación IMNAS
        </h2>

        <p class="text-dark text-center mb-5" style="">
            verifica la autenticidad de los  registros  emitidas. <br> Tu confianza y respaldo es nuestra prioridad.
        </p>
    </div>

    <div class="col-2"></div>

    <div class="col-8">

        <form id="" class="d-flex" action="{{ route("folio.buscador") }}">
            <input class="form-control me-2" placeholder="Ingresa Folio" name="folio" id="folio">
            <button class="btn btn-success" type="submit" style="background: #66C0CC">Buscar</button>
        </form>

    </div>

    <div class="col-2">

    </div>

    <div class="col-12 mt-4 p-5">
        @if(Route::currentRouteName() != 'folio.index')
            @include('admin.registro_imnas.plantilla_buscador_general')
        @endif
    </div>

</div>

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

<div class="row" style="background-color: #66C0CC" id="afiliados">
    <div class="col-12 m-auto">
        <h1 class="text-white text-center titulo mt-5 mb-5" style="">Conocer Nuestros Afiliados </h1>
        <p class="text-center " style="color:#000!important;">

        </p>

        <div class="row">
            @foreach ($registros_imnas as $item)
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
</div>

@endsection

