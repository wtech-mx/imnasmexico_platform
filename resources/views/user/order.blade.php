@extends('layouts.app_user')

@section('template_title')
    Gracias por tu compra
@endsection

@section('css_custom')
<link href="{{ asset('assets/user/custom/thankyou.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="primario bg_overley" style="background-color:#836262;">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <div class="card_thanks">
                    <p class="text-center">
                        <img class="img_card_certificaciones" src="{{ asset('assets/user/icons/cracker.png')}}" alt="">
                    </p>
                </div>
            </div>
            <h1 class="text-center tittle_thanks">¡Felicidades!</h1>
            <h2 class="text-center subtittle_thanks">Compra Realizada con éxito</h2>

            <div class="d-flex justify-content-center">
                <a class="btn btn_thanks me-3">
                    <div class="d-flex justify-content-around">
                        <p class="card_tittle_btn my-auto">
                            Ver detalles del pedido
                        </p>
                        <div class="card_thanks_btn ">
                            <i class="fas fa-cart-plus card_icon_thanks"></i>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;">

<div class="row">

    <div class="col-12 col-md-6">
        <div class="card_tanks">
            <h3 class="tittle_card_thanks">Datos del pedido</h3>
            <p class="facts_thanks"><strong>Nombre:</strong> Josue Adrian </p>
            <p class="facts_thanks"><strong>Apellido:</strong> Ramirez Hernandez</p>
            <p class="facts_thanks"><strong>Correo:</strong> dinopiza@yahoo.com</p>
            <p class="facts_thanks"><strong>Teléfono:</strong> 5529291962</p>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card_tanks">
            <h3 class="tittle_card_thanks">Datos del cliente</h3>
            <p class="facts_thanks"><strong>Curso:</strong> Josue Adrian </p>
            <p class="facts_thanks"><strong>Método de pago:</strong> Ramirez Hernandez</p>
            <p class="facts_thanks"><strong>Correo:</strong> dinopiza@yahoo.com</p>
            <p class="facts_thanks"><strong>Costo:</strong> 5529291962</p>
        </div>
    </div>

    <div class="col-12">
        <div class="d-flex justify-content-center">
            <a class="btn btn_thanks_2 me-3">
                <div class="d-flex justify-content-around">
                    <p class="card_tittle_btn_2 my-auto">
                        Ver todas las Certificaciones
                    </p>

                    <div class="card_thanks_btn_2">
                        <i class="fas fa-cart-plus card_icon_thanks_2"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>


</section>

@endsection

@section('js')


@endsection


