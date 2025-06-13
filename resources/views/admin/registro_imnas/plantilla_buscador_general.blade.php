@if ($tickets == NULL && $tickets_generador == "")


    @else
        @if ($tickets_generador == "")
            <h5 class="text-left mt-2 mb-3"><strong>Resultado de Busqueda del Folio : {{ $folio}}</strong></h5>

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
                                <strong>Escuela donde estudió:</strong> INSTITUTO MEXICANO NATURALES AIN SPA<br>
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
                            @if(in_array($tickets->Cursos->nombre, [
                                'Diplomado en Drenaje Linfático Facial y Corporal',
                                'Micropuntura Brasileña',
                                'Micropuntura Brasileña',
                            ]))
                                <a href="{{ route('folio.index_titulo',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">
                                    Título Honorífico
                                </a>
                            @else
                                <a href="{{ route('folio.index_cedula',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-dark" style="background-color: #DDD78D">Cédula de Identidad de Papel</a>
                                <a href="{{ route('folio.index_crednecial',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-dark" style="background-color: #DCBF85">Credencial Plastificada</a>
                                <a href="{{ route('folio.index_diploma',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #8B635C">Diploma de Profesionalización</a>
                                <a href="{{ route('folio.index_titulo',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">Título Honorífico</a>

                                @if($tickets->Cursos->nombre === 'Carrera de Cosmiatria Estética')
                                    <a href="{{ route('folio.index_tira',$tickets->id) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #93A29B">Tira de Materias</a>
                                @endif

                            @endif
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
                            {{ $tickets_generador->User->clave_clasificacion ?? 'RIFC680910-879-0013' }}  hace constar que el alumno con número de FOLIO <strong>{{ $folio}}</strong>
                            ha terminado satisfactoriamente la especialidad <strong>{{$folio}}</strong> con los créditos honoríficos
                            requeridos respecto al plan de estudios vigente.
                        </p>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 my-auto">
                        <a href="{{ route('folio.index_cedula',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-dark" style="background-color: #DDD78D">Cédula  de Identidad de Papel</a>
                        <a href="{{ route('folio.index_crednecial',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-dark" style="background-color: #DCBF85">Credencial Plastificada</a>
                        <a href="{{ route('folio.index_diploma',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #8B635C">Diploma de Profesionalización</a>
                        <a href="{{ route('folio.index_titulo',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">Titulo Honorífico</a>
                        <a href="{{ route('folio.index_tira',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #93A29B">Tira de Materias</a>
                    </div>

                </div>

            </div>
        </div>

    @endif

@endif

@if ($tickets == NULL && $tickets_generador == "" && $tickets_externo == "")
<h5 class="text-left mt-2 mb-3"><strong>No se han encontrado resultados para: {{ $folio}}</strong></h5>

@endif

@if($tickets_externo != "")
{{-- Externos --}}
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
                    <strong>Nombre del Alumno:</strong> {{$tickets_externo->cliente}} <br>
                    <strong>Especialidad:</strong> {{$tickets_externo->curso}} <br>
                    <strong>Escuela donde estudió:</strong> INSTITUTO MEXICANO NATURALES AIN SPA <br>
                </p>
                <p class="text-center mt-4">
                    La coordinación de asuntos escolares del Registro Nacional IMNAS con registro en la
                    Secretaría del Trabajo y Previsión Social (STPS) como agente capacitador externo
                    RIFC680910-879-0013 hace constar que el alumno con número de FOLIO <strong>{{ $folio}}</strong>
                    ha terminado satisfactoriamente la especialidad <strong>{{$folio}}</strong> con los créditos honoríficos
                    requeridos respecto al plan de estudios vigente.
                </p>
            </div>

            @php
                if($tickets_externo->cliente == 'Ana Cristina Ferrusca Rivera'){
                    $tickets_externo->folio = 'FCDCE-6012-F';
                }elseif($tickets_externo->cliente == 'MICHELLE GARCIA ZAMILPA'){
                     $tickets_externo->folio = 'FCDCE-6012-FC';
                }
            @endphp

            <div class="col-12 col-md-6 col-lg-6 my-auto">
                @if(in_array($tickets_externo->curso, [
                    'Diplomado en Drenaje Linfático Facial y Corporal',
                    'Micropuntura Brasileña',
                    'Micropuntura Brasileña',
                ]))
                    <a href="{{ route('folio.index_titulo',$tickets_externo->folio) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">
                        Título Honorífico
                    </a>
                @elseif(in_array($tickets_externo->curso, [
                    'Masoterapia en Técnicas de Masaje Relajante, Descontracturante y Deportivo',
                ]))
                    <a href="{{ route('folio.index_titulo',$tickets_externo->folio) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">
                        Título Honorífico
                    </a>
                    <a href="{{ route('folio.index_diploma',$tickets_externo->folio) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #8B635C">
                        Diploma de Profesionalización
                    </a>

                @else
                    <a href="{{ route('folio.index_cedula',$tickets_externo->folio) }}" class="text-center btn btn-xs mt-3 w-100 text-dark" style="background-color: #DDD78D">Cédula de Identidad de Papel</a>
                    <a href="{{ route('folio.index_crednecial',$tickets_externo->folio) }}" class="text-center btn btn-xs mt-3 w-100 text-dark" style="background-color: #DCBF85">Credencial Plastificada</a>
                    <a href="{{ route('folio.index_diploma',$tickets_externo->folio) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #8B635C">Diploma de Profesionalización</a>
                    <a href="{{ route('folio.index_titulo',$tickets_externo->folio) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">Título Honorífico</a>
                @endif


            </div>

        </div>

    </div>
</div>

@endif

