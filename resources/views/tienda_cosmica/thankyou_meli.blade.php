@extends('layouts.app_tienda_cosmica')

@section('template_title') Gracias por su Compra @endsection

@section('css_custom')
<style>
.container_order_item{
    background-color: #fff;
    border-radius: 26px;
    border: solid 2px #FDE9B8;
    padding: 10px 20px 10px 20px;
}

.button_collapse_cart {
    border-radius: 13px;
    padding: 20px;
    border-top-left-radius: 13px !important;
    border-top-right-radius: 13px !important;
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
                        <h2 class="text-center title_thankyou Quinsi mt-5" style="color: #000">
                            Tu compra se encuentra en estado Pendiente
                        </h2>
                    @endif

                <p class="text-center ">
                    @if($order->item_descripcion_permalink)
                        <img class="mt-3 mb-3" style="width: 300px;" src="{{asset('assets/user/utilidades/meli.png')}}" alt="">
                    @else
                        <img src="{{asset('cosmika/INICIO/TIENDA.png')}}" class="img_thankyou">
                    @endif
                </p>

                @if($order->item_descripcion_permalink)

                    <h2 class="thankyou_subtitle Quinsi mb-4 text-center" style="color:#000;">
                        <a href="{{ $order->item_descripcion_permalink }}" target="_blank" rel="noopener noreferrer" style="text-decoration: none">
                            Enlace de Compra de Mercado Libre
                        </a>
                    </h2>

                    <div class="row">
                        <div class="col-6">
                            <p class="text-center texto_order_thanks Avenir ">
                                <a href="{{ $order->item_descripcion_permalink }}" target="_blank" style="color: #000;text-decoration: none">
                                    <strong class="subtitle_order_datos">Link: </strong> <br>
                                    {{ $order->item_descripcion_permalink }} <br> <br>
                                </a>
                            </p>
                        </div>

                        <div class="col-6 my-auto">
                            <p class="text-center texto_order_thanks Avenir ">
                                <a class="button_collapse_cart" href="{{ $order->item_descripcion_permalink }}" target="_blank"  style="background: #FFE900;color: #000;text-decoration: none">
                                    <img class="" style="width: 100px;" src="{{asset('assets/user/utilidades/meli.png')}}" alt=""> Comprar ahora
                                </a>
                            </p>
                        </div>
                    </div>

                    <p class="text-center">
                        <strong>Nota:</strong> Tomara alrededor de un minuto que Mercado libre Ponga la publcacion activa
                    </p>

                @else

                @endif

                <div class="d-flex justify-content-center">
                    <p class="text-center  mt-4">
                        <a href="{{ route('tienda.home') }}" class="Quinsi btn btn_all_gradient_border">Regresar al inicio</a>
                    </p>

                    <p class="text-center mt-4" style="margin-left: 1rem">
                        <a id="whatsapp-btn" href="#" class="Quinsi btn btn_all_gradient" style="background: #128c7e">
                            <i class="bi bi-whatsapp"></i> Confirmar pedido por WhatsApp
                        </a>
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
                        {{$order->User->email}} <br>
                    </p>
                </div>

                @if($order->item_descripcion_permalink)

                    <div class="col-12">
                        <h2 class="thankyou_subtitle Quinsi mb-4">Datos de Mercado Libre</h2>
                        <p class="texto_order_thanks Avenir ">
                            <strong class="subtitle_order_datos">ID Meli: </strong> <br>
                            {{$order->item_id_meli}} <br> <br>

                            <strong class="subtitle_order_datos">Titulo de Publicacion: </strong> <br>
                            {{$order->item_title_meli}} <br><br>

                            <strong class="subtitle_order_datos">Descripcion: </strong> <br>
                            {{$order->item_descripcion_meli}} <br><br>

                            <strong class="subtitle_order_datos">Enlace de publicacion: </strong> <br>
                            <a href="{{$order->item_descripcion_permalink}}" target="_blank" rel="noopener noreferrer">{{$order->item_descripcion_permalink}}</a> <br>
                        </p>
                    </div>


                @else

                    <div class="col-12">
                        <h2 class="thankyou_subtitle Quinsi mb-4">Dirección</h2>
                    </div>

                    @if ($order->forma_envio == 'envio')
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

                @endif



            </div>

        </div>

    </div>

<!-- Modal de WhatsApp -->
<div class="modal fade" id="modalWhatsapp" tabindex="-1" aria-labelledby="modalWhatsappLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalWhatsappLabel">¿Prefieres hacer tu pedido por WhatsApp? 📲</h5>
            </div>
            <div class="modal-body text-center">
                <p>Podemos ayudarte con tu compra directamente por WhatsApp. ¿Te gustaría continuar?</p>
                <a  id="whatsapp-btn-modal"  href="#" class="btn btn-success w-100">Sí, quiero WhatsApp 💬</a>
                <button type="button" class="btn btn-secondary w-100 mt-2" data-bs-dismiss="modal">Ver orden completa 🛒</button>
            </div>
        </div>
    </div>
</div>


</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Número de WhatsApp de la empresa
        const numeroWhatsApp = "5637540093";

        // Obtener datos de la orden desde Laravel (asegúrate de pasar estos datos desde el backend)
        const numeroOrden = "{{ $order->id }}";
        const totalOrden = "{{ number_format($order->pago, 2, '.', ',') }}";
        const clienteNombre = "{{ $order->User->name }}";
        const clienteCorreo = "{{ $order->User->email }}";
        const urlCompra = "{{ url()->current() }}"; // Obtener la URL actual
        const urlMeli = "{{ $order->item_descripcion_permalink }}"; // Obtener la URL actual

        // Recorrer los productos y generar un mensaje con la lista de productos
        let mensajeProductos = "";
        @foreach ($order_ticket as $item)
            mensajeProductos += "🛒 *{{ $item->Producto->nombre }}* - Cantidad: {{ $item->cantidad }} - Precio: ${{ number_format($item->precio, 2, '.', ',') }}\n";
        @endforeach

        // Crear el mensaje para WhatsApp
        let mensajeWhatsApp = `👋 Hola, deseo confirmar mi pedido en Cosmica que realice por Meli. Aquí están los detalles:\n\n`;
        mensajeWhatsApp += `📌 *Número de orden:* #${numeroOrden}\n`;
        mensajeWhatsApp += `👤 *Cliente:* ${clienteNombre}\n`;
        mensajeWhatsApp += `📧 *Correo:* ${clienteCorreo}\n\n`;
        mensajeWhatsApp += `🛍 *Productos:* \n${mensajeProductos}\n`;
        mensajeWhatsApp += `💰 *Total:* $${totalOrden}\n\n`;
        mensajeWhatsApp += `✅ *URL de Compra* ${urlCompra}\n\n`;
        mensajeWhatsApp += `✅ *URL de Meli* ${urlMeli}\n\n`;
        mensajeWhatsApp += `✅ Por favor confirmen mi pedido. ¡Gracias!`;

        // URL codificada para WhatsApp
        let urlWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensajeWhatsApp)}`;

        // Asignar la URL al botón de WhatsApp
        document.getElementById("whatsapp-btn").setAttribute("href", urlWhatsApp);
        document.getElementById("whatsapp-btn-modal").setAttribute("href", urlWhatsApp);

    });

    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById('modalWhatsapp'), {
            keyboard: false,
            backdrop: 'static' // Evita que el usuario lo cierre manualmente
        });
        myModal.show(); // Muestra el modal automáticamente al cargar la página

        });
    </script>

@endsection

