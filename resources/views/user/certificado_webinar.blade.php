@extends('layouts.app_user')

@section('template_title')
    Cerficacion Webinar
@endsection

@section('css_custom')


<style>
    .kbw-signature { width: 100%; height: 200px;}
    #sig canvas{
        width: 100% !important;
        height: auto;
    }
</style>

@endsection

@section('content')


<section class="primario bg_overley " style="background-color:#F5ECE4;">

        <form role="form" action="{{ route('perfil.update_certificaion', $cliente->code) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="row" style="margin-top: 10rem !important;">
                <div class="col-12 col-md-6 col-lg-6">

                    <h3 class="text-center titulomin_alfa mb-3">Carta Compromiso</h3>

                    <div class="container_carta_compriso" style="background: #fff;padding: 15px;font-size: 15px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);border-radius: 13px;">
                        <p class="text-center">
                            <img src="{{asset('assets/user/icons/logos.png')}}" style="width:80%">
                        </p>

                        <h4 class="text-center mt-2 mb-2">CARTA COMPROMISO</h4>

                        <p class="">
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

                        <div id="contenedor_firma">
                            @if ($cliente->Documentos)
                                <p class="text-center ">
                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->firma) }}" alt="Imagen" style="width: 100%;height: auto;"/><br>
                                </p>
                            @else
                        </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="" for="">Signature:</label>
                                    <br/>
                                    <div id="sig" ></div>
                                    <br/>
                                    <button id="clear" class="btn btn-danger btn-sm">Repetir Firma</button>
                                    <textarea id="signature64" name="signed" style="display: none"></textarea>
                                </div>
                                <br/>
                            </div>

                            @endif
                        </div>

                        <hr style="height: 4px;background: black;margin-bottom: 10px;">
                        <p class="text-center">
                            Nombre y Firma de conformidad
                        </p>
                    </div>

                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <h3 class="text-center titulomin_alfa mb-3">Documentacion</h3>

                        <div class="mb-3 col-12">
                            <label for="basic-url" class="form-label">INE *</label>
                            <div class="input-group">
                            <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/tarjeta-de-identificacion.png')}}" style="width: 40px">
                            </span>
                            <input id="ine" name="ine" type="file" class="form-control " >
                            </div>

                            <div id="contenedor_ine">
                                @if ($cliente->Documentos)
                                    @if (pathinfo($cliente->Documentos->ine, PATHINFO_EXTENSION) == 'pdf')
                                        <p class="text-center ">
                                            <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine)}}" style="width: 60%; height: auto"></iframe>
                                        </p>
                                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                        @elseif (pathinfo($cliente->Documentos->ine, PATHINFO_EXTENSION) == 'doc')
                                        <p class="text-center ">
                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto"/>
                                        </p>
                                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                        @elseif (pathinfo($cliente->Documentos->ine, PATHINFO_EXTENSION) == 'docx')
                                        <p class="text-center ">
                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto"/>
                                        </p>
                                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine) }}" alt="Imagen" style="width: 50%;height: auto;"/><br>
                                            </p>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver INE</a>
                                    @endif
                                @endif

                            </div>
                        </div>

                        <div class="mb-3 col-12">
                            <label for="basic-url" class="form-label">CURP *</label>
                            <div class="input-group">
                            <span class="input-group-text" id="basic-addon3"><img src="{{asset('assets/user/icons/carta.png')}}" style="width: 40px"></span>
                            <input id="curp" name="curp" type="file" class="form-control" >
                            </div>

                            <div id="contenedor_curp">
                                @if ($cliente->Documentos)
                                    @if (pathinfo($cliente->Documentos->curp, PATHINFO_EXTENSION) == 'pdf')
                                        <p class="text-center ">
                                            <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp)}}" style="width: 60%; height: auto;"></iframe>
                                        </p>
                                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                        @elseif (pathinfo($cliente->Documentos->curp, PATHINFO_EXTENSION) == 'doc')
                                        <p class="text-center ">
                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                        </p>
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                        @elseif (pathinfo($cliente->Documentos->curp, PATHINFO_EXTENSION) == 'docx')
                                        <p class="text-center ">
                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                        </p>
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                        @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp) }}" alt="Imagen" style="width: 50%;height: auto;"/><br>
                                        </p>
                                            <a class="text-center text-dark btn btn-sm mb-5" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver CURP</a>
                                    @endif
                                @endif
                            </div>

                            <button type="submit mt-5" class="btn btn-success w-100">Guardar</button>

                        </div>

                        <div class="col-12 d-flex align-item-center">

                            <a type="button" class="btn btn-danger" id="btnAbrirModal" style="display: none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Ingresar Datos de Acadamicos
                            </a>
                        </div>

                </div>

            </div>
        </form>


</section>
@include('user.modal_certificado_form')
@endsection

@section('js')

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });

    // Obtener los datos del cliente desde PHP
    var datosCliente = {!! json_encode($datosCliente) !!};

    // Verificar si los campos necesarios están completos
    function verificarCamposCompletos() {
        // Verificar si todos los campos están completos
        if (datosCliente.ine && datosCliente.curp && datosCliente.firma) {
            // Activar el modal
            var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
            document.getElementById('btnAbrirModal').style.display = 'block';
        }else{
            document.getElementById('btnAbrirModal').style.display = 'none';
        }
    }

    // Llamar a la función al cargar la página
    window.onload = function() {
        verificarCamposCompletos();
    };


</script>

@endsection


