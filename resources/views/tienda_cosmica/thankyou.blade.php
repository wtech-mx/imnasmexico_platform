@extends('layouts.app_tienda_cosmica')

@section('template_title') Single @endsection

@section('css_custom')
<style>
.container_order_item{
    background-color: #fff;
    border-radius: 26px;
    border: solid 2px #FDE9B8;
    padding: 10px 20px 10px 20px;
}
</style>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center">

        <div class="col-12 mb-2">
            <div class="container_error" style="">

                @if ($order->estatus == '1')
                <h3 class="text-center Quinsi titulos"> Orden Competada con exito</h3>
                <h2 class="text-center Avenir titulos">¡Felicidades!</h2>
                <p class="text-center">
                    <img src="{{asset('cosmika/inicio/ESTRELLAS-DORADAS.png')}}" alt="">
                </p>

                @else
                    <h2 class="text-center title_thankyou mt-5" style="color: #d38919f8">Tu compra se encuentra en estado Pendiente</h2>
                @endif

                <p class="text-center ">
                    <img src="{{asset('cosmika/INICIO/TIENDA.png')}}" class="img_thankyou">
                </p>

                <div class="d-flex justify-content-center">
                    <p class="text-center  mt-4">
                        <a href="{{ route('tienda.home') }}" class="Quinsi btn btn_all_gradient_border">Regresar al inicio</a>
                    </p>

                    <p class="text-center  mt-4"  style="margin-left: 1rem">
                        <a href="" class="Quinsi btn btn_all_gradient">Contactar</a>
                    </p>
                </div>

            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6 my-auto p-4">
            <h2 class="thankyou_subtitle Quinsi mb-4">Resumen de la Orden</h2>
            <h4 class=" mb-4">Folio: #<b>{{$order->id}} </b></h4>

            @foreach ($order_ticket as $item)
                <div class="container_order_item row mb-4">
                    <div class="col-2 my-auto">
                        <div class="mx-auto img_portada_thankyou" style="background: url('{{ $item->Producto->imagenes }}') #ffffff00  50% / contain no-repeat;"></div>
                    </div>

                    <div class="col-6 my-auto">
                        <p class="title_product_tahnkyou m-0">{{$item->Producto->nombre}}</p>
                    </div>

                    <div class="col-2 my-auto">
                        <p class="tittle_cantidad_thankyou m-0">{{$item->cantidad}}</p>
                    </div>

                    <div class="col-2 my-auto">
                        <p class="title_price_thankyou m-0">${{number_format($item->precio, 2, '.', ',')}}</p>
                    </div>
                </div>
            @endforeach
            <h4 class=" mb-4 Avenir">Total: $<b>{{number_format($order->pago, 2, '.', ',')}} </b></h4>

        </div>

        <div class="col-12 col-md-6 col-lg-6 my-auto p-4">

            <div class="row">
                <div class="col-12">
                    <h2 class="thankyou_subtitle Quinsi mb-4">Datos de Cliente</h2>
                    <p class="texto_order_thanks Avenir ">
                        <strong class="subtitle_order_datos">Cliente: </strong> <br>
                        {{$order->User->name}} <br> <br>
                        <strong class="subtitle_order_datos">Correo: </strong> <br>
                        {{$order->User->correo}} <br>
                    </p>
                </div>

                <div class="col-12">
                    <h2 class="thankyou_subtitle Quinsi mb-4">Dirección</h2>
                </div>

                @if ($order->tipo_envio == 'envio')
                    <div class="col-6">
                        <p class="texto_order_thanks Avenir">
                            <strong class="subtitle_order_datos">CP:</strong> <br>
                            {{$order->User->postcode}}
                        </p>
                        <p class="texto_order_thanks Avenir">
                            <strong class="subtitle_order_datos">Estado:</strong> <br>
                            {{$order->User->state}}
                        </p>
                    </div>

                    <div class="col-6">
                        <p class="texto_order_thanks Avenir">
                            <strong class="subtitle_order_datos">Municipio Alcaldia:</strong> <br>
                            {{$order->User->country}}
                        </p>
                        <p class="texto_order_thanks Avenir">
                            <strong class="subtitle_order_datos">Calle y Numero:</strong> <br>
                            {{$order->User->direccion}}
                        </p>
                    </div>

                    <div class="col-12">
                        <p class="texto_order_thanks Avenir">
                            <strong class="subtitle_order_datos">Referencias:</strong> <br>
                            {{$order->User->city}}
                        </p>
                    </div>
                @else
                    <h4 class=" mb-4 Avenir">Recoge en tienda <b> con tu numero de Folio: #{{$order->id}}</b></h4>
                    <div class="container_pickup row mt-3">
                        <p>
                            <a href="https://maps.app.goo.gl/WoEycdRbmkpVLquXA">
                                Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México, CDMX
                            </a>
                        </p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.3490269944937!2d-99.14528382431148!3d19.397319941805755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ffd944963ec3%3A0xb529339c57f86ca6!2sPARADISUS%20SPA!5e0!3m2!1sen!2smx!4v1738685384595!5m2!1sen!2smx" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>

@endsection

