@extends('layouts.app_user')

@section('template_title')
Términos y Condiciones de Pago
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/avales.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/hotspot/bootstrap-hotspots.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/metriz/Font-Face/style.css')}}" />

{{-- css carrusel --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
crossorigin="anonymous" />
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
crossorigin="anonymous" />

@endsection

@section('content')

<section class="primario bg_overley" style="background-color:#836262;">
    <div class="row">
        <div class="col-12 tittle_section2 espace_tittle_avales mb-3">
            <h2 class="titulo_alfa text-center text-white"> Términos y Condiciones </h2>
            <h3 class="titulo_beta text-center text-white">de Pago</h3>
        </div>
    </div>
</section>

<section class="" style="background-color:#F5ECE4;">
    <div class="row">

        <div class="col-12">
            <p class="text_beneficios mt-5 p-2 p-xs-2 p-md-3 p-lg-5">
                        1. Alcance y Aceptación de los Términos
                        <br><br><br>
                        1.1. Estos Términos y Condiciones de Pago (“Términos”) regulan la relación entre el Instituto Mexicano Naturales AIN SPA y Naturales AIN SPA (“El Instituto”) y cualquier persona (“El Cliente”) que realice pagos por servicios educativos o de laboratorio proporcionados por El Instituto y Laboratorio.
                        <br><br>
                        1.2. Al efectuar un pago a El Instituto o/y laboratorio, El Cliente acepta plenamente estos Términos, reconociendo que ha leído, comprendido y acordado sin reservas todas las condiciones aquí establecidas.
                        <br><br><br>
                        2. Política de No Reembolso
                        <br><br>
                        2.1. Todos los pagos efectuados por El Cliente a El Instituto y/o laboratorio son *definitivos y no reembolsables*. Esto aplica a cualquier tipo de servicio ofrecido, incluyendo pero no limitándose a, servicios educativos, cursos, talleres, seminarios, y servicios de laboratorio.
                        <br>
                        2.2. No se realizarán devoluciones de dinero bajo ninguna circunstancia, incluyendo pero no limitándose a cancelaciones, interrupciones de servicio, desistimiento por parte del Cliente, o cualquier otro motivo.
                        <br><br><br>
                        3. Obligaciones del Cliente
                        <br><br>
                        3.1. El Cliente es responsable de asegurarse de que entiende claramente los términos del servicio que está pagando antes de realizar cualquier transacción.
                        <br><br>
                        3.2. Al realizar un pago, El Cliente acepta que ha recibido toda la información necesaria sobre el servicio contratado y que está de acuerdo con el precio y las condiciones ofrecidas por El Instituto.
                        <br><br><br>
                        4. Proceso de Pago
                        <br><br>
                        4.1. Los pagos deben ser realizados a través de los métodos especificados por El Instituto y/o laboratorio que pueden incluir transferencias bancarias, pagos con tarjeta de crédito o débito, o cualquier otro medio autorizado.
                        <br><br>
                        4.2. El Cliente es responsable de proporcionar información precisa y veraz en el proceso de pago. El Instituto no se hace responsable por pagos fallidos o retrasos debidos a errores del Cliente.
                        <br><br><br>
                        5. Modificaciones a los Términos y Condiciones
                        <br><br>
                        5.1. El Instituto se reserva el derecho de modificar estos Términos en cualquier momento. Las modificaciones entrarán en vigor una vez publicadas en el sitio web de El Instituto o notificadas al Cliente por cualquier otro medio.
                        <br><br>
                        5.2. Es responsabilidad del Cliente revisar periódicamente estos Términos para estar al tanto de cualquier cambio. El uso continuado de los servicios de El Instituto después de cualquier modificación constituye la aceptación de dichos cambios por parte del Cliente.
                        <br><br><br>
                        6. Limitación de Responsabilidad
                        <br><br>
                        6.1. El Instituto no será responsable por cualquier daño directo, indirecto, incidental, especial, consecuente o punitivo que surja de la utilización de sus servicios o de la imposibilidad de utilizarlos.
                        <br><br><br>
                        7. Jurisdicción y Ley Aplicable
                        <br><br>
                        7.1. Estos Términos se regirán e interpretarán de acuerdo con las leyes de [país o estado correspondiente].
                        <br><br>
                        7.2. Cualquier disputa que surja en relación con estos Términos será resuelta ante los tribunales competentes de México , a los que las partes se someten con renuncia expresa a cualquier otro fuero que pudiera corresponderles.
            </p>
        </div>

        <form action="" class="row">

            <div class="col-12">
                <p class="text-center"><strong>He leído y acepto los  términos y condicionesdel sitio</strong></p>
            </div>

            <div class="col-4"></div>

            <div class="col-4">
                <div class="d-flex justify-content-center">
                    <div class="input-group flex-nowrap mt-4">
                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                        <input type="text" name="name" id="name" class="form-control input_custom_checkout" placeholder="Nombre completo *" required>
                    </div>
                </div>
            </div>

            <div class="col-4"></div>


            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <button class="btn_pagar_checkout " type="submit">Aceptar</button>
                </div>
            </div>

        </form>

    </div>
</section>

@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>

@endsection


