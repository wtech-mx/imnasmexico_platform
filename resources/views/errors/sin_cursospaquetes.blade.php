@extends('layouts.app_user')

@section('template_title')
    Sin Cursos
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/error.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center minh-100">
      <div class="col-12">

        <div class="container_error" style="background-image: url('{{asset('assets/user/utilidades/pattern.jpg')}}')">

            <p class="text-center">
                <img src="{{asset('assets/user/icons/pagina-no-encontrada.png')}}" class="img_errors">
            </p>

            <h2 class="text-center tittle_error">Upps!</h2>

            <p class="text-center text_error">
                Actualmente no contamos con los cursos ofrecidos en este paquete. <br>
                Para obtener más información o ayuda, por favor ponte en contacto con nosotros: <br>
                <a href="https://wa.me/5522208900?text=Hola%2C%20tengo%20problemas%20para%20comprar%20un%20paquete%20ya%20que%20dice%20que%20actualmente%20no%20tienen%20cursos%20disponibles%20para%20el%20paquete" target="_blank">
                    Enviar mensaje de WhatsApp</a><br>
                O llámanos al 55 2220 8900
            </p>

            <div class="d-flex justify-content-center">
                <a href="{{ route('cursos.paquetes') }}" class="btn_error_primario">Regresar</a>
                <a href="https://wa.me/5522208900?text=Hola%2C%20tengo%20problemas%20para%20comprar%20un%20paquete%20ya%20que%20dice%20que%20actualmente%20no%20tienen%20cursos%20disponibles%20para%20el%20paquete" class="btn_error_secundario" target="_blank">Contactar</a>
            </div>

        </div>

      </div>

    </div>
  </div>

@endsection



