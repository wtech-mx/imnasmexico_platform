@extends('layouts.app_ecommerce')

@section('template_title') Single @endsection

@section('css_custom')
    <link rel="stylesheet" href="{{ asset('assets/css/thankyou.css') }}">
@endsection

@section('ecomeerce')

<div class="container  mt-10">
    <div class="row justify-content-center align-items-center">

        <div class="col-12 mb-5">
            <div class="container_error" style="">

                @if ($order->estatus == '1')
                    <p class="text-center title_thankyou mt-5">
                        Orden Competada con exito <br>
                        ¡Felicidades!
                    </p>
                @else
                    <h2 class="text-center title_thankyou mt-5" style="color: #d38919f8">Tu compra se encuentra en estado Pendiente</h2>
                @endif

                <p class="text-center ">
                    <img src="{{asset('ecommerce/Isotipo_negro.png')}}" class="img_thankyou">
                </p>

                <div class="d-flex justify-content-center">
                    <a href="{{ route('tienda_online.index') }}" class="btn btn_verde_primario">Regresar al inicio</a>
                    <a href="" class="btn btn_verde_secundario">Contactar</a>
                </div>

            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6 my-auto p-4">
            <h2 class="thankyou_subtitle mb-4">Resumen de la Orden</h2>
            <h4 class=" mb-4">Folio: #<b>{{$order->id}} </b></h4>

            @foreach ($order_ticket as $item)
                <div class="container_order_item row mb-4">
                    <div class="col-2 my-auto">
                        <div class="mx-auto img_portada_thankyou" style="background: url('{{ asset('/imagen_principal/empresa1' . $item->Producto->imagen_principal) }}') #ffffff00  50% / contain no-repeat;"></div>
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
            <h4 class=" mb-4">Total: $<b>{{number_format($order->total, 2, '.', ',')}} </b></h4>

            @if ($order->factura == 'Si')
                <div class="col-12">
                    <h2 class="thankyou_subtitle mb-4">Facturación</h2>
                </div>
                <div class="col-12">
                    <p class="texto_order_thanks">
                        <strong class="subtitle_order_datos">Rfc: </strong> <br>
                        {{$order->Factura->rfc}} <br> <br>
                        <strong class="subtitle_order_datos">Régimen fiscal: </strong> <br>
                        {{$order->Factura->razon_social}} <br>
                        <strong class="subtitle_order_datos">CFDI: </strong> <br>
                        {{$order->Factura->cfdi}} <br>
                        <strong class="subtitle_order_datos">Forma pago: </strong> <br>
                        {{$order->Factura->forma_pago}} <br>
                    </p>
                </div>
            @endif
        </div>

        <div class="col-12 col-md-6 col-lg-6 my-auto p-4">

            <div class="row">
                <div class="col-12">
                    <h2 class="thankyou_subtitle mb-4">Datos de Cliente</h2>
                    <p class="texto_order_thanks">
                        <strong class="subtitle_order_datos">Cliente: </strong> <br>
                        {{$order->User->name}} <br> <br>
                        <strong class="subtitle_order_datos">Correo: </strong> <br>
                        {{$order->User->correo}} <br>
                    </p>
                </div>

                <div class="col-12">
                    <h2 class="thankyou_subtitle mb-4">Dirección</h2>
                </div>

                @if ($order->tipo_envio == 'envio')
                    <div class="col-6">
                        <p class="texto_order_thanks">
                            <strong class="subtitle_order_datos">CP:</strong> <br>
                            {{$order->Direccion->codigo_postal}}
                        </p>
                        <p class="texto_order_thanks">
                            <strong class="subtitle_order_datos">Estado:</strong> <br>
                            {{$order->Direccion->estado}}
                        </p>
                    </div>

                    <div class="col-6">
                        <p class="texto_order_thanks">
                            <strong class="subtitle_order_datos">Municipio Alcaldia:</strong> <br>
                            {{$order->Direccion->alcaldia}}
                        </p>
                        <p class="texto_order_thanks">
                            <strong class="subtitle_order_datos">Calle y Numero:</strong> <br>
                            {{$order->Direccion->calle_numero}}
                        </p>
                    </div>

                    <div class="col-12">
                        <p class="texto_order_thanks">
                            <strong class="subtitle_order_datos">Referencias:</strong> <br>
                            {{$order->Direccion->referencia}}
                        </p>
                    </div>
                @else
                    <h4 class=" mb-4">Recoge en tienda <b> con tu numero de Folio: #{{$order->id}}</b></h4>
                    <div class="container_pickup row mt-3">
                        <p>
                            <a href="https://maps.app.goo.gl/WoEycdRbmkpVLquXA">
                                Mérida 64, Cuahutemoc 19-4214, -99.1579, Roma Nte., 06700 Ciudad de México, CDMX
                            </a>
                        </p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.7954834491547!2d-99.16045332523932!3d19.421240581855653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ffbe36afe1f7%3A0x3ea01a1b1ae9104c!2sZoco%20Fresh%20Roma%20Tienda%20org%C3%A1nica!5e0!3m2!1ses-419!2smx!4v1735834614408!5m2!1ses-419!2smx" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>

@include('shop.components.products_slide')

@endsection

