@extends('layouts.app_user')

@section('template_title')
    Inicio
@endsection

@section('content')

<section class="primario bg_overley" style="heigth:500px;background-image: url('{{ asset('assets/user/utilidades/cosmetologa_bg.jpg')}}')">

<div class="row">
    <div class="col-6">
        <h1 class="text-white titulo" style="">
            Instituto Mexicano <br>
            Naturales Ain Spa
        </h1>
        <p class="text-white parrafo" style="">
            Plataforma número uno de cursos en línea y <br>
            presenciales dedicados a la cosmetología y <br>
            cosmiatría a nivel nacional e internacional.
        </p>
        <div class="d-flex justify-content-start">
            <a class="btn btn-primario me-4">
                Certificaciones
            </a>
            <a class="btn btn-secundario">
                Saber mas
            </a>
        </div>
    </div>

    <div class="col-6">

    </div>
</div>

</section>


@endsection
