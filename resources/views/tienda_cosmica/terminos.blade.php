@extends('layouts.app_tienda_cosmica')

@section('template_title')
Términos y Condiciones de Uso
@endsection

@section('body_custom')
    bg_single_product
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/ecommerce_about.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="container">

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <h3 class="text-center titulo_hola mt-5">Términos y Condiciones de Uso</h3>

            <p class="text-center">
                <img class="text-center img_logo" src="{{ asset('cosmika/logo_2.png') }}" alt="">
            </p>

            <p class="text-center parrafo_about">
               <strong> Última actualización: 5/02/25</strong> <br><br>
                Bienvenido a www.cosmicaskin.com. Al acceder y utilizar nuestro sitio web, aceptas los siguientes términos y condiciones. Si no estás de acuerdo con alguno de estos términos, te recomendamos no utilizar nuestros servicios.
                <br><br> 1. Información General
                Este sitio web es operado por Cósmica Skin. Nos dedicamos a la venta de productos de cuidado de la piel y cosmética. Al utilizar este sitio web, declaras que tienes al menos la mayoría de edad en tu país o que cuentas con el consentimiento de tus padres o tutores legales.
                <br> <br> 2. Uso del Sitio
                * No puedes usar nuestros productos para ningún propósito ilegal o no autorizado.
                * Queda prohibida la reproducción, duplicación, venta o explotación de cualquier contenido del sitio sin nuestro permiso expreso.
                * Nos reservamos el derecho de rechazar el servicio a cualquier persona por cualquier motivo en cualquier momento.
                <br> <br> 3. Precios y Pagos
                * Todos los precios están en [moneda local] e incluyen impuestos, salvo indicación en contrario.
                * Aceptamos métodos de pago como tarjeta de crédito, PayPal, transferencia bancaria, entre otros.
                * Nos reservamos el derecho de cambiar los precios en cualquier momento sin previo aviso.
                <br> <br> 4. Envíos y Entregas
                * Realizamos envíos a [países/regiones a los que envían].
                * Los tiempos de entrega pueden variar según la ubicación y la disponibilidad del producto.
                * No nos hacemos responsables por retrasos causados por terceros como transportistas.
                <br> <br> 5. Política de Devoluciones
                * Aceptamos devoluciones dentro de los [2] días de haber recibido el pedido, siempre que los productos no hayan sido abiertos ni utilizados.
                * Los costos de envío para devoluciones corren por cuenta del cliente, salvo que el producto esté defectuoso.
                <br> <br> 6. Propiedad Intelectual
                Todo el contenido de www.cosmicaskin.com, incluidos textos, imágenes, logotipos y diseños, está protegido por derechos de autor y es propiedad de Cósmica Skin. No está permitido el uso sin nuestro consentimiento expreso.
                <br> <br> 7. Responsabilidad
                * No garantizamos que el uso de nuestro sitio sea ininterrumpido o libre de errores.
                * No somos responsables de daños indirectos o consecuentes derivados del uso de nuestros productos o servicios.
                <br> <br> 8. Modificaciones a los Términos y Condiciones
                Nos reservamos el derecho de actualizar, cambiar o reemplazar cualquier parte de estos términos en cualquier momento. Es responsabilidad del usuario revisar periódicamente esta sección.
                Para cualquier consulta, contáctanos en [correo de contacto].

            </p>
        </div>
    </div>

</div>


@endsection

@section('js')

@endsection


