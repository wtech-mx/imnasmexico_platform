@extends('layouts.app_user')

@section('template_title')
    Cerficación Webinar
@endsection

@section('css_custom')


<style>
    .kbw-signature { width: 100%; height: 200px;}
    #sig canvas{
        width: 100% !important;
        height: auto;
    }

    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: var(--bs-nav-pills-link-active-color);
    background: #836262!important;
    color: #fff!important;

    }

    .nav-link {
    display: block;
    padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
    font-size: var(--bs-nav-link-font-size);
    font-weight: var(--bs-nav-link-font-weight);
    color: #836262!important;
    text-decoration: none;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
}

@media only screen and (max-width: 500px) {
  .carta {
    font-size: 12px;
  }
}

</style>

@endsection

@section('content')


<section class="primario bg_overley " style="background-color:#F5ECE4;">


        <div class="row">
            <div class="col-12 d-flex justify-content-center" style="margin-top: 10rem !important;">

                <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                    <li class="nav-item" role="primera-vez">
                        <button class="nav-link active" id="pills-primera-vez-tab" data-bs-toggle="pill" data-bs-target="#pills-primera-vez" type="button" role="tab" aria-controls="pills-primera-vez" aria-selected="true">
                          ¿Primera vez? <img src="{{asset('assets/user/icons/clic.png')}}" style="width: 30px">
                        </button>
                    </li>
                    <li class="nav-item" role="continuar">
                        <button class="nav-link" id="pills-continuar-tab" data-bs-toggle="pill" data-bs-target="#pills-continuar" type="button" role="tab" aria-controls="pills-continuar" aria-selected="false">
                             Continuar con mi proceso <img src="{{asset('assets/user/icons/cuaderno.webp')}}" style="width: 30px">
                        </button>
                    </li>
                </ul>

            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-primera-vez" role="tabpanel" aria-labelledby="pills-primera-vez-tab" tabindex="0">
                <form role="form" action="{{ route('certificaion.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-12 col-md-12 col-lg-6 col-xl-6">

                            <h3 class="text-center titulomin_alfa mb-3">Carta Compromiso</h3>

                            <div class="container_carta_compriso" style="background: #fff;padding: 15px;font-size: 15px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);border-radius: 13px;">
                                    <p class="text-center">
                                        <img src="{{asset('assets/user/icons/logos.png')}}" style="width:80%">
                                    </p>

                                    <h4 class="text-center mt-2 mb-2">CARTA COMPROMISO</h4>

                                    <p class="carta">
                                        <strong>CAM by IMNAS ECE356-18</strong> se compromete a otorgar al candidato/a, que se comprometa,
                                        a subir en tiempo y forma sus documentos y proyecto (creación de carta descriptiva) para
                                        integración de portafolio de evidencias, a partir del día 5 de Mayo 2024 al día 15 de Junio
                                        2024 como fecha límite. <br><br>
                                        <strong>ECE356-18</strong> otorgará gratuitamente el proceso de evaluación y certificado del estándar:
                                        <strong>EC0217.01 IMPARTICIÓN DE CURSOS DE FORMACIÓN DEL CAPITAL HUMANO DEMANERA PRESENCIAL GRUPAL</strong>
                                        Este proceso es únicamente para los candidatos presentes y conectados en el WEBINAR
                                        del Domingo 5 de mayo 2024 que se comprometan a realizar todo el proceso. Para esta
                                        certificación SEP CONOCER, se necesita de la integración portafolio, documentos
                                        personales, evaluación y se necesita ser competente para que SEP CONOCER emita tu
                                        certificación. <br><br>
                                        <strong>
                                            SI EL PARTICIPANTE NO REALIZA TODOS LOS PASOS A SEGUIR, QUE INDICA EL
                                            GOBIERNO DE MEXICO, PARA EMITIR UNA CERTIFICACIÓN O NO ES
                                            COMPETENTE, LA ENTIDAD DE CERTIFICACIÓN Y EVALUACIÓN ECE356-18 NO SE
                                            HARÁ RESPONSABLE, NI PODRÁ OTROGAR AL CANDIDATO/A NINGÚN PROCESO
                                            DE EVALUACIÓN NI CERTIFICADO GRATUITO.
                                        </strong> <br><br>

                                        Por medio de la presente, me <strong>COMPROMETO</strong> con la Entidad de Certificación y
                                        <strong>Evaluación ECE356-18 IMNAS</strong> a subir toda la documentación personal y proyecto previo
                                        al día <strong>15 de Junio 2024</strong>, tomando en cuenta lo estipulado al acuerdo No. 1/SPC publicado
                                        en el diario Oficial de la Federación. Estando consciente que de no hacerlo así: Se me
                                        suspenda la oportunidad de obtener el proceso de evaluación y certificado gratuito. Si la
                                        fecha de entrega del proceso de evaluación especificada en dicho documento rebasa el
                                        día 15 de Junio 2024, se me dará de baja y no obtendré gratuitamente el proceso de
                                        evaluación ni el certificado SEP CONOCER, la entidad de certificación y evaluación ECE
                                        356-18 podrá realizar procesos de evaluación y certificación siempre, pero ya no será de
                                        manera gratuita, en caso de hacerlo después de las fechas estipuladas en este
                                        documento.
                                    </p>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="" for="">Firma:</label>
                                            <br/>
                                            <div id="sig" ></div>
                                            <br/>
                                            <button id="clear" class="btn btn-danger btn-sm">Repetir Firma</button>
                                            <textarea id="signature64" name="signed" style="display: none" required></textarea>
                                        </div>
                                        <br/>
                                    </div>
                            </div>

                                <hr style="height: 4px;background: black;margin-bottom: 10px;">
                                <p class="text-center">Firma de conformidad</p>

                        </div>


                        <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                            <h3 class="text-center titulomin_alfa mb-3">Documentación</h3>

                                <div class="mb-3 col-12">
                                    <label for="basic-url" class="form-label">Telefono *</label>
                                    <div class="input-group">
                                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/complain.png')}}" style="width: 40px">
                                    </span>
                                    <input class="form-control" type="tel" minlength="10" maxlength="10" id="username" name="username"   placeholder="Telefono" required>
                                    </div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label for="basic-url" class="form-label">INE *</label>
                                    <div class="input-group">
                                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/tarjeta-de-identificacion.png')}}" style="width: 40px">
                                    </span>
                                    <input id="ine" name="ine" type="file" class="form-control " required>
                                    </div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label for="basic-url" class="form-label">CURP *</label>
                                    <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/carta.png')}}" style="width: 40px"></span>
                                    <input id="curp" name="curp" type="file" class="form-control" required>
                                    </div>

                                    <button type="submit mt-5" class="btn btn-success w-100">Guardar</button>
                                </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="tab-pane fade" id="pills-continuar" role="tabpanel" aria-labelledby="pills-continuar-tab" tabindex="0">
                <div class="d-flex justify-content-center">
                    <form method="POST" action="{{ route('login.custom') }}">
                        @csrf

                        <h3 class="text-center titulomin_alfa mb-3">Ingresa tu telefono con el que iniciaste tu proceso</h3>

                        <div class="input-group flex-nowrap mt-4">
                            <span class="input-group-text span_custom_login" ><i class="fas fa-phone-alt"></i></span>
                            <input class="form-control input_custom_login" type="number" id="username" name="username"  placeholder="Telefono" required>
                        </div>

                        <input class="form-control input_custom_login" type="text" id="password" name="password" value="certificaion" style="display: none">

                        <p class="text-center mt-5">
                            <button class="btn btn_login_modal">
                                Continuar <i class="fas fa-arrow-circle-right"></i>
                            </button>
                        </p>

                    </form>
                </div>
            </div>
        </div>

</section>
@endsection

@section('js')

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://keith-wood.name/js/jquery.signature.js"></script>

    <script type="text/javascript">
        var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>

@endsection

