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
                        <h5 class="text-left mb-3">El folio ingresado no se ha encontrado. Por favor, verifica que esté correctamente escrito e inténtalo nuevamente.</h5>
                        <h6><strong>{{$folio}}</strong></h6>
                    </div>
                @else
                    @if ($tickets_generador == "")
                        <h5 class="text-left mt-5 mb-3"><strong>Resultado de Busqueda del Folio : {{ $folio}}</strong></h5>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="card card-body card_colapsable_comprar">

                                    <h2 class="text-center">{{$tickets->User->name}}</h2><br><br>

                                    <div class="row">
                                        <div class="col-8 my-auto">
                                            <p><b> Especializado en: </b>{{$tickets->Cursos->nombre}}</p>
                                            <p><b>Cursado del: </b>{{ \Carbon\Carbon::parse($tickets->Cursos->fecha_inicial)->isoFormat('DD [de] MMMM [del] YYYY') }}</p>
                                            <p><b>Al: </b>{{ \Carbon\Carbon::parse($tickets->Cursos->fecha_final)->isoFormat('DD [de] MMMM [del] YYYY') }}</p>
                                            <p><b>Este folio: </b>{{$tickets->folio}} certifica que el alumno ha completado satisfactoriamente el curso/diplomado mencionado anteriormente.</p>
                                        </div>

                                        <div class="col-4">
                                            <a href="{{ route('folio.index_cedula',$tickets->id) }}" class="btn btn-xs mt-3 w-100 text-dark" style="background-color: #DDD78D">Cedulda de Identidad de Papel</a>
                                            <a href="" class="btn btn-xs mt-3 w-100 text-dark" style="background-color: #DCBF85">Credencial Plastificada</a>
                                            <a href="" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #8B635C">Diploma Imnnas</a>
                                            <a href="" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">Titulo Honorifico</a>
                                            <a href="" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #93A29B">Tira de Materias</a>
                                        </div>

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
                    <div class="row mb-3">
                            <div class="col-12">
                                <div class="card card-body card_colapsable_comprar" style="border-radius: 16px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);">

                                    <div class="row">
                                        <div class="col-8">
                                            <h2 class="text-left">{{$tickets_generador->cliente}}</h2><br><br>
                                            <p><b>Especializado en: </b>{{$tickets_generador->curso}}</p>
                                            <p><b>Cursado el dia: </b>{{ \Carbon\Carbon::parse($tickets_generador->fecha_inicial)->isoFormat('DD [de] MMMM [del] YYYY') }}</p>
                                            <p><b>Este folio: </b>{{$tickets_generador->folio}} certifica que el alumno ha completado satisfactoriamente el curso/diplomado mencionado anteriormente.</p>
                                        </div>

                                        <div class="col-4">
                                            <a href="{{ route('folio.index_cedula',$tickets_generador->id) }}" class="btn btn-xs mt-3 w-100 text-dark" style="background-color: #DDD78D">Cedulda de Identidad de Papel</a>
                                            <a href="" class="btn btn-xs mt-3 w-100 text-dark" style="background-color: #DCBF85">Credencial Plastificada</a>
                                            <a href="" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #8B635C">Diploma Imnnas</a>
                                            <a href="" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">Titulo Honorifico</a>
                                            <a href="" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #93A29B">Tira de Materias</a>
                                        </div>

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


