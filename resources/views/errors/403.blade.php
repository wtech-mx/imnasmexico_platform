@extends('layouts.app_user')

@section('template_title')
    403
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
                <img src="{{asset('assets/user/icons/falla.png')}}" class="img_errors">
            </p>

            <h2 class="text-center tittle_error">ERROR 403</h2>

            <p class="text-center text_error">
                No tienes permiso para acceder al recurso solicitado. <br>
                Es posible que la página web a la que intentas acceder esté restringida para ciertos usuarios o que esté protegida por contraseña.
            </p>

            @if(session('error_code') && session('error_message'))
                <p class="text-center text_error">
                    <strong>Error Code:</strong> {{ session('error_code') }}<br>
                    <strong>Message:</strong> {{ session('error_message') }}<br>
                    <strong>Trace:</strong> <pre>{{ session('error_trace') }}</pre>
                </p>
            @endif

            <div class="d-flex justify-content-center">
                <a href="{{ route('user.home') }}" class="btn_error_primario">Regresar al inicio</a>
                <a href="https://wa.link/g3e1bj" class="btn_error_secundario">Contactar</a>
            </div>

        </div>

      </div>

    </div>
  </div>

@endsection



