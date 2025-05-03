@extends('layouts.app_user')

@section('template_title')
   Facturacion Cosmica
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/nosotros.css')}}" rel="stylesheet" />
{{-- css carrusel --}}

@endsection

@section('content')


<section class="primario bg_overley margin_home_nav" style="background-color:#F5ECE4;" id="cafeteria">
    <div class="row">


        <div class="col-12 col-md-12  m-auto">
            <h1 class="text-white text-center titulo mt-5 " style="color:#836262!important;">Facturacion </h1>
            <p class="text-center text-white mt-auto parrafo_instalaciones" style="color:#836262!important;">
                Realiza tu facuracion dentro del mes que hiciste tu compra.
            </p>

            @include('user.facturacion.botones_facturacion')


        </div>

    </div>
</section>

@endsection

@section('js')
@endsection




