@extends('layouts.app_user')

@section('template_title')
    Buscar Folio
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/instalaciones.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row">
        <div class="col-12 tittle_section2 espace_tittle_avales mb-3" style="margin-top:11rem;">
            <h2 class="titulo_alfa text-center">FOLIO</h2>
        </div>
    </div>
</section>

{{-- section unam --}}
<section class="primario bg_overley padding_avales_cont" style="background-color:#fff;">
    <div class="row">

        <div class="col-2"></div>

        <div class="col-8">

            <h3 class="text-center mt-4 mb-4">
                Ingresa el Folio de tu documento
            </h3>

            <form method="GET" action="{{ route('folio.buscador') }}" class="d-flex" role="search">
                <input class="form-control me-2" placeholder="Ingresa Folio" name="folio">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>

        </div>

        <div class="col-2">

        </div>

        <div class="col-12 mt-4">

            @if(Route::currentRouteName() != 'folio.index')
            @if ($tickets == NULL && $tickets_generador == "")
            <div class="card card-body card_colapsable_comprar">
                <h6><strong>{{$folio}}</strong></h6>
            </div>
        @else
            @if ($tickets_generador == "")
                <h5 class="text-left mt-5 mb-3"><strong>Resultado de Busqueda del Folio : {{ $folio}}</strong></h5>


                <div class="row card card-body card_colapsable_comprar">
                    <div class="col-12">
                        <h3 class="text-center mb-3 mt-3">REGISTRO NACIONAL IMNAS</h3>
                    </div>

                    <div class="col-12">

                        <div class="row">

                            <div class="col-4">
                                <p class="text-center">
                                    <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/stps.png" class="img_card_certificaciones" >
                                </p>
                            </div>

                            <div class="col-4">
                                <p class="text-center">
                                    <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/imnas.webp" class="img_card_certificaciones" style="width: 80px!important">
                                </p>
                            </div>

                            <div class="col-4">
                                <p class="text-center">
                                    <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/registro_nacional.png" class="img_card_certificaciones" >
                                </p>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <p class="text-center">
                                   <strong> Registro Nacional IMNAS</strong> tiene la finalidad de llevar un padrón detallado de cada uno de
                                    los alumnos que han acreditado carreras, diplomados y certificaciones de acuerdo a los
                                    estatutos requeridos en cada uno de ellos.
                                </p>
                                <p class="text-center mt-4">
                                    <strong>Nombre del Alumno:</strong> {{$tickets->User->name}} <br>
                                    <strong>Especialidad:</strong> {{$tickets->Cursos->nombre}} <br>
                                    <strong>Escuela donde estudió:</strong> INSTITUTO MEXICANO NATURALES AIN SPA <br>
                                    <strong>Fecha que estudió del:</strong> {{ \Carbon\Carbon::parse($tickets->Cursos->fecha_inicial)->isoFormat('DD [de] MMMM [del] YYYY') }} al: {{ \Carbon\Carbon::parse($tickets->Cursos->fecha_final)->isoFormat('DD [de] MMMM [del] YYYY') }}<br>
                                </p>
                                <p class="text-center mt-4">
                                    La coordinación de asuntos escolares del Registro Nacional IMNAS con registro en la
                                    Secretaría del Trabajo y Previsión Social (STPS) como agente capacitador externo
                                    RIFC680910-879-0013 hace constar que el alumno con número de FOLIO <strong>{{ $folio}}</strong>
                                    ha terminado satisfactoriamente la especialidad <strong>{{$tickets->Cursos->nombre}}</strong> con los créditos honoríficos
                                    requeridos respecto al plan de estudios vigente.
                                </p>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 my-auto">
                                <a href="{{ route('folio.index_cedula',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-dark" style="background-color: #DDD78D">Cedulda de Identidad de Papel</a>
                                <a href="{{ route('folio.index_crednecial',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-dark" style="background-color: #DCBF85">Credencial Plastificada</a>
                                <a href="{{ route('folio.index_diploma',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #8B635C">Diploma Imnnas</a>
                                <a href="{{ route('folio.index_titulo',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">Titulo Honorifico</a>
                                {{-- <a href="{{ route('folio.index_tira',$tickets->id) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #93A29B">Tira de Materias</a> --}}
                            </div>

                        </div>

                    </div>
                </div>

            @endif
        @endif

        @if ($tickets == NULL && $tickets_generador == "")

        @else
            @if ($tickets == NULL)
            <h5 class="text-left mt-5 mb-3"><strong>Resultado de Busqueda del Folio : {{ $folio}}</strong></h5>

            <div class="row card card-body card_colapsable_comprar">
                <div class="col-12">
                    <h3 class="text-center mb-3 mt-3">REGISTRO NACIONAL IMNAS</h3>
                </div>

                <div class="col-12">

                    <div class="row">

                        <div class="col-4">
                            <p class="text-center">
                                <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/stps.png" class="img_card_certificaciones" >
                            </p>
                        </div>

                        <div class="col-4">
                            <p class="text-center">
                                <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/imnas.webp" class="img_card_certificaciones" style="width: 80px!important">
                            </p>
                        </div>

                        <div class="col-4">
                            <p class="text-center">
                                <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/registro_nacional.png" class="img_card_certificaciones" >
                            </p>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            <p class="text-center">
                               <strong> Registro Nacional IMNAS</strong> tiene la finalidad de llevar un padrón detallado de cada uno de
                                los alumnos que han acreditado carreras, diplomados y certificaciones de acuerdo a los
                                estatutos requeridos en cada uno de ellos.
                            </p>
                            <p class="text-center mt-4">
                                <strong>Nombre del Alumno:</strong> {{$tickets_generador->nombre}} <br>
                                <strong>Especialidad:</strong> {{$tickets_generador->nom_curso}} <br>
                                <strong>Escuela donde estudió:</strong>  {{$tickets_generador->User->escuela}} <br>
                                <strong>Fecha que estudió :</strong> {{ \Carbon\Carbon::parse($tickets_generador->fecha_curso)->isoFormat('DD [de] MMMM [del] YYYY') }} <br>
                            </p>
                            <p class="text-center mt-4">
                                La coordinación de asuntos escolares del Registro Nacional IMNAS con registro en la
                                Secretaría del Trabajo y Previsión Social (STPS) como agente capacitador externo
                                RIFC680910-879-0013 hace constar que el alumno con número de FOLIO <strong>{{ $folio}}</strong>
                                ha terminado satisfactoriamente la especialidad <strong>{{$folio}}</strong> con los créditos honoríficos
                                requeridos respecto al plan de estudios vigente.
                            </p>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 my-auto">
                            <a href="{{ route('folio.index_cedula',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-dark" style="background-color: #DDD78D">Cedulda de Identidad de Papel</a>
                            <a href="{{ route('folio.index_crednecial',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-dark" style="background-color: #DCBF85">Credencial Plastificada</a>
                            <a href="{{ route('folio.index_diploma',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #8B635C">Diploma Imnnas</a>
                            <a href="{{ route('folio.index_titulo',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">Titulo Honorifico</a>
                            <a href="{{ route('folio.index_tira',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #93A29B">Tira de Materias</a>
                        </div>

                    </div>

                </div>
            </div>

            @endif
        @endif
            @endif

        </div>

    </div>
</section>


@endsection

@section('js')


@endsection


