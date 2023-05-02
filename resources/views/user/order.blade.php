@extends('layouts.app_user')

@section('template_title')
    Gracias por tu compra
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/thankyou.css')}}" rel="stylesheet" />
@endsection

@section('content')
@php
    $date = $order->fecha;
    $newDate = date("d-m-Y", strtotime($date));
@endphp
<section class="primario bg_overley" style="background-color:#836262;">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <div class="card_thanks">
                    <p class="text-center">
                        @if ($order->estatus == '1')
                            <img class="img_card_certificaciones" src="{{asset('assets/user/icons/cracker.png')}}" alt="">
                        @else
                            <img class="img_card_certificaciones" src="{{asset('assets/user/icons/payment.png')}}" alt="">
                        @endif

                    </p>
                </div>
            </div>
            <h1 class="text-center tittle_thanks">¡Felicidades!</h1>
            <h2 class="text-center subtittle_thanks">{{$order->User->name }}</h2>
            @if ($order->estatus == '1')
                <h2 class="text-center subtittle_thanks">Compra Realizada con éxito</h2>
            @else
            <h2 class="text-center subtittle_thanks">Tu compra se encuentra en estado Pendiente</h2>
            @endif
            <h4 class="text-center text-white tittle_mensaje mt-4">
                Te llegará un correo de confirmación de pago y posteriormente uno con la liga y/o de la direccion de clase, <br>
                 es necesario revisar la bandeja de spam.
            </h4>


            <div class="d-flex justify-content-center">
                <button class="btn btn_thanks me-3" onclick="scrollDown()">
                    <div class="d-flex justify-content-around">
                        <p class="card_tittle_btn my-auto">
                            Ver detalles del pedido
                        </p>
                        <div class="card_thanks_btn ">
                            <i class="fas fa-cart-plus card_icon_thanks"></i>
                        </div>
                    </div>
                </button>
            </div>

        </div>
    </div>
</section>

<section class="primario bg_overley" style="background-color:#F5ECE4;">

<div class="row">

    <div class="col-12 col-md-6">
        <div class="card_tanks">
            <h3 class="tittle_card_thanks">Datos del cliente</h3>
            <p class="facts_thanks"><strong>Nombre:</strong> {{$order->User->name }}</p>
            <p class="facts_thanks"><strong>Correo:</strong> {{$order->User->email }}</p>
            <p class="facts_thanks"><strong>Teléfono:</strong> {{$order->User->telefono }}</p>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card_tanks">
            <h3 class="tittle_card_thanks">Datos del pedido</h3>
            @foreach ($order_ticket as $item)
                <p class="facts_thanks"><strong>Curso: </strong>{{$item->CursosTickets->nombre}}</p>
            @endforeach
            <p class="facts_thanks"><strong>Método de pago: </strong>{{$order->forma_pago}} </p>
            <p class="facts_thanks"><strong>Estado:</strong>
                @if ($order->estatus == 1)
                    Aprobado
                @else
                    Pendiente
                @endif

            </p>
            <p class="facts_thanks"><strong>Costo: </strong>${{$order->pago}} mxn</p>
            <p class="facts_thanks"><strong>Fecha: </strong> {{ $newDate}}</p>
            <p class="facts_thanks"><strong>Num pedido:</strong> #{{$order->id}}</p>
        </div>
    </div>

    <div class="col-12">
        <div class="d-flex justify-content-center">
            <a class="btn btn_thanks_2 me-3" href="{{ route('cursos.index_user') }}">
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

    <script>
        function scrollDown() {
         window.scrollBy(0, 300);
        }
    </script>

@endsection


