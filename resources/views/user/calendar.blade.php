@extends('layouts.app_user')

@section('template_title')
    Inicio
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/grid_cursos.css')}}" rel="stylesheet" />
<style>
    .carousel-item {
    height: 100vh;
    min-height: 350px;
    background: no-repeat center center scroll;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    }
</style>
@endsection

@section('content')

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">

        @foreach ($cursos_slide as $curso)
        @php
            $hora_inicial = strftime("%H:%M %p", strtotime($curso->hora_inicial)) ;
            $hora_final = strftime("%H:%M %p", strtotime($curso->hora_final)) ;
            $dia = date("d", strtotime($curso->fecha_inicial));
            $mes = date("M", strtotime($curso->fecha_inicial));
        @endphp
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="background-image: url('{{asset('curso/'. $curso->foto) }}')">
                <div class="row postion_row_caledanrio">
                <div class="col-12 col-md-6">
                    <div class="conten_slilder_full">
                        <h1 class="text-white titulo" style="">
                            {{$curso->nombre}}
                        </h1>

                        <a class="btn btn-secundario_grid me-3">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    {{$curso->modalidad}}
                                </p>
                            </div>
                        </a>

                        <p class="text-white parrafo" style="">
                            <?php echo $curso->descripcion?>
                        </p>

                        <div class="d-flex justify-content-start">
                            <a class="btn btn-primario me-3">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Comprar ahora
                                    </p>
                                    <div class="card_bg_btn ">
                                        <i class="fas fa-cart-plus card_icon_btn"></i>
                                    </div>
                                </div>
                            </a>

                            <a class="btn btn-secundario me-1" href="{{ route('cursos.show',$curso->slug) }}">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Saber mas
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fas fa-plus card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        @endforeach


    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
    </div>
{{-- Grid --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">

    <div class="row">

        <div class="col-12">
            <form class="row form_search_calendar" action="{{ route('advance_search') }}" method="GET" >

                <div class="col-2">
                    <label class="form-label style_search_label">Modalidad</label>
                    <select class="form-control" style="background: #F5ECE4!important;border: solid transparent;color: #836262;font-weight: bold;border-style: solid;border-width: 0px 0px 3px 0px;border-color: #000;border-radius: 0px;" name="modalidad" id="modalidad">
                        <option value="" selected>Seleccione</option>
                        <option value="Presencial">Presencial</option>
                        <option value="Online">Online</option>
                    </select>
                </div>

                <div class="col-2">
                    <label class="form-label style_search_label">Categoria</label>
                    <select class="form-control" style="background: #F5ECE4!important;border: solid transparent;color: #836262;font-weight: bold;border-style: solid;border-width: 0px 0px 3px 0px;border-color: #000;border-radius: 0px;" name="categoria" id="categoria">
                        <option value="" selected>Seleccione</option>
                        <option value="Faciales">Faciales</option>
                        <option value="Corporales">Corporales</option>
                    </select>
                </div>

                <div class="col-2">
                    <label class="form-label style_search_label">Tipo</label>
                    <select class="form-control" style="background: #F5ECE4!important;border: solid transparent;color: #836262;font-weight: bold;border-style: solid;border-width: 0px 0px 3px 0px;border-color: #000;border-radius: 0px;" name="tipo" id="tipo">
                        <option value="" selected>Seleccione</option>
                        <option value="sep">SEP</option>
                        <option value="unam">UNAM</option>
                        <option value="stps">STPS</option>
                        <option value="redconocer">RedConocer</option>
                        <option value="imnas">IMNAS</option>
                    </select>
                </div>

                <div class="col-2">
                    <label class="form-label style_search_label">Fecha</label>
                    <div class="input-group">
                        <input name="fecha_inicial" class="form-control" value="{{$fechaActual}}" style="background: #F5ECE4!important;border: solid transparent;color: #836262;font-weight: bold;border-style: solid;border-width: 0px 0px 3px 0px;border-color: #000;   border-radius: 0px;" type="date">
                    </div>
                </div>

                <div class="col-2">
                    <label class="form-label style_search_label">Nombre</label>
                    <div class="input-group">
                        <input name="nombre" class="form-control" style="background: #F5ECE4!important;border: solid transparent;color: #836262;font-weight: bold;border-style: solid;border-width: 0px 0px 3px 0px;border-color: #000;border-radius: 0px;" type="text" placeholder="nombre">
                    </div>
                </div>

                <div class="col-2">

                    <label class="form-label style_search_label">-</label>
                    <div class="input-group">
                        <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit">
                            <i class="fas fa-search-plus  icon_search_style"></i>
                        </button>
                        <a class="btn btn-sm mb-0 mt-sm-0 mt-1" href="{{ route('cursos.index_user') }}">
                            <i class="fas fa-eraser  icon_search_style_2"></i>
                        </a>
                    </div>

                </div>

            </form>

        </div>

        <div class="col-12">
            <div class="d-flex mb-5">

                <div class="me-auto p-2">
                    <h5 class="tittle_proximas_cer">Próximas Certificaciones</h5>
                </div>

                <div class="p-2">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- card_grid --}}
        @foreach ($cursos as $curso)
        @php
            $hora_inicial = strftime("%H:%M %p", strtotime($curso->hora_inicial)) ;
            $hora_final = strftime("%H:%M %p", strtotime($curso->hora_final)) ;
            $dia = date("d", strtotime($curso->fecha_inicial));
            $mes = date("M", strtotime($curso->fecha_inicial));
        @endphp
        <div class="col-6 col-md-4">

            <div class="card card_grid" style="">
                <img class="img_card_grid" src="{{asset('curso/'. $curso->foto) }}" class="card-img-top" alt="...">

                <p class="precio_grid">${{$curso->precio}} mxn</p>
                <p class="modalidado_grid">{{$curso->modalidad}}</p>
                <p class="wish_grid"><i class="fas fa-heart"></i></p>
                <p class="share_grid"><i class="fas fa-share-alt"></i></p>
                <p class="horario_grid">{{$hora_inicial}} - {{$hora_final}}</p>

                <div class="card-body">
                <div class="row">

                    <div class="col-2 mt-4">
                    <h4 class="fecha_card_grid text-center">
                        {{$mes}} <br> <strong class="fecha_strong_card_grid">{{$dia}}</strong>
                    </h4>
                    </div>

                    <div class="col-10 mt-4">
                        <h3 class="tittle_card_grid">{{$curso->nombre}}</h3>

                        <div class="d-flex mb-3">
                            <div class="me-auto p-2">
                                <a class="btn btn_primario_grd_curso" data-bs-toggle="collapse" href="#collapseobjetivos{{$curso->id}}" role="button" aria-expanded="false" aria-controls="collapseobjetivos">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn_grid my-auto">
                                            Comprar ahora
                                        </p>
                                        <div class="card_bg_btn ">
                                            <i class="fas fa-cart-plus card_icon_btn_grid"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="p-2">
                                <a class="btn btn_secundario_grd_curso" href="{{ route('cursos.show',$curso->slug) }}">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn_grid my-auto">
                                            Saber mas
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fas fa-plus card_icon_btn_secundario_grid"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>


                            <div class="collapse mt-3" id="collapseobjetivos{{$curso->id}}">
                                <div class="card card-body card_colapsable_comprar">
                                    <div class="row mb-3">
                                        @foreach ($tickets as $ticket)
                                        @if ($ticket->id_curso == $curso->id)
                                            <div class="col-12 mt-3">
                                                <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                            </div>
                                            <div class="col-12 mt-3">
                                                @if ($ticket->descuento == NULL)
                                                    <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                @else
                                                    <del style="color: #836262"><strong>${{$ticket->precio}}</strong></del>
                                                    <h5 style="color: #836262"><strong>${{$ticket->descuento}}</strong></h5>
                                                @endif
                                            </div>

                                            <div class="col-12 mt-3">
                                                <p class="btn-holder">
                                                    <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                        <i class="fas fa-ticket-alt"></i> Comprar
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <p style="color: #836262">{{$ticket->descripcion}}</p>
                                            </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                    </div>
                </div>

            </div>
        @endforeach

        {{-- card_grid --}}
    </div>

</section>
{{-- Grid --}}

@endsection

@section('js')


@endsection


