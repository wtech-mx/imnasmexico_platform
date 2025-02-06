@extends('layouts.app_tienda_cosmica')

@section('template_title')
Aviso de Privacidad
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
            <h3 class="text-center titulo_hola mt-5">Aviso de Privacidad
            </h3>

            <p class="text-center">
                <img class="text-center img_logo" src="{{ asset('cosmika/logo_2.png') }}" alt="">
            </p>
            </h4>
            <p class="text-center parrafo_about">
                <strong> Última actualización: 5/02/25</strong> <br><br>
                Cósmica Skin se compromete a proteger tu privacidad. Este aviso explica cómo recopilamos, usamos y protegemos tu información personal.
                <br><br> 1. Información que Recopilamos
                Podemos recopilar la siguiente información cuando interactúas con nuestro sitio:
                * Datos personales: nombre, correo electrónico, dirección, teléfono.
                * Información de pago y facturación.
                * Datos de navegación y cookies.
                <br><br> 2. Uso de la Información
                Utilizamos tu información para:
                * Procesar tus compras y gestionar envíos.
                * Brindarte atención al cliente.
                * Enviar promociones y novedades (si así lo autorizas).
                * Mejorar nuestra plataforma y experiencia de usuario.
                <br><br> 3. Protección de Datos
                Implementamos medidas de seguridad para proteger tu información personal contra accesos no autorizados o uso indebido.
                <br><br> 4. Compartición de Información
                No vendemos ni compartimos tu información personal con terceros, salvo en los siguientes casos:
                * Proveedores de servicios de pago y envíos.
                * Autoridades legales en caso de ser requerido por ley.
                <br><br> 5. Derechos del Usuario
                Tienes derecho a:
                * Acceder, rectificar o eliminar tus datos personales.
                * Retirar tu consentimiento para el uso de datos con fines de marketing.
                * Solicitar más información sobre cómo manejamos tus datos.
                Para ejercer estos derechos, contáctanos en [correo de contacto].
                <br><br> 6. Uso de Cookies
                Utilizamos cookies para mejorar la experiencia de usuario en nuestro sitio. Puedes gestionar las preferencias de cookies desde la configuración de tu navegador.
                <br><br> 7. Cambios en el Aviso de Privacidad
                Nos reservamos el derecho de modificar este aviso en cualquier momento. Publicaremos la versión actualizada en nuestra página web.
                Si tienes preguntas o inquietudes sobre tu privacidad, contáctanos en cosmicaskin@icloud.com.

            </p>
        </div>
    </div>

</div>


@endsection

@section('js')

@endsection


