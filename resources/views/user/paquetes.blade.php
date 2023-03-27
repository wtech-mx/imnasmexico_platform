@extends('layouts.app_user')

@section('template_title')
    Paquetes
@endsection

@section('css_custom')
    <link href="{{ asset('assets/user/custom/paquetes.css')}}" rel="stylesheet" />
@endsection

@section('content')


<section class="primario bg_overley" style="background-color:#fff;">

    <div class="row">
        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{ asset('assets/user/utilidades/PAQUETE-01.png')}}" alt="">
        </div>

        <div class="col-6 space_paquetes">

        </div>
    </div>

</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;">

    <div class="row">
        <div class="col-6 space_paquetes">

        </div>

        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{ asset('assets/user/utilidades/PAQUETE-02.png')}}" alt="">
        </div>
    </div>

</section>

<section class="primario bg_overley" style="background-color:#fff;">

    <div class="row">
        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{ asset('assets/user/utilidades/PAQUETE-03.png')}}" alt="">
        </div>

        <div class="col-6 space_paquetes">

        </div>
    </div>

</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;">

    <div class="row">
        <div class="col-6 space_paquetes">

        </div>

        <div class="col-6 space_paquetes">
            <img class="img_paquetes" src="{{ asset('assets/user/utilidades/PAQUETE-04.png')}}" alt="">
        </div>
    </div>

</section>


@section('js')


@endsection


