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
