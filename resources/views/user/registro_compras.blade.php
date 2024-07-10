@extends('layouts.app_user')

@section('template_title')
Registro compras
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/perfil.css')}}" rel="stylesheet" />
@endsection

<style>
    .accordion-button:not(.collapsed) {
        color: #fff!important;
    }

    @keyframes blinking {
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0.6;
        }
        100% {
            opacity: 1;
        }
    }

        .blinking {
        animation: blinking 1.7s infinite;
        }
</style>

@section('content')

<section class="primario bg_overley" style="background-color:#F5ECE4;" id="contenido">

    <div class="row space_newprofile" style="">

        <div class="col-12">
            <div class="card_single_horizon">
                <div class="d-flex justify-content-between">
                    <h3 class="title_curso mb-3">Registro compra</h3>
                    <img class="icon_nav_course" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                </div>
                <form   method="POST" action="{{ route('registro_compras.store') }}" enctype="multipart/form-data" role="form" >
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="row">
                        <div class="col-12 col-lg-6 form-group ">
                            <label for="">Nombre completo *</label>
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_profile_label" src="{{asset('assets/user/icons/ESTUDIANTE-.webp')}}" alt="">
                                </span>

                                <input class="form-control" type="text"  id="nombre" name="nombre" required>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 form-group ">
                            <label for="">Telefono *</label>
                            <div class="input-group input-group-alternative mb-4">
                            <span class="input-group-text">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/complain.png')}}" alt="">
                            </span>
                            <input class="form-control" type="number"  id="nom_curso" name="nom_curso" required>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 form-group ">
                            <label for="">Correo *</label>
                            <div class="input-group input-group-alternative mb-4">
                            <span class="input-group-text">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/email.png')}}" alt="">
                            </span>
                            <input class="form-control" type="email"  id="fecha_curso" name="fecha_curso" required>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 form-group ">
                            <label for="">Ciudad *</label>
                            <div class="input-group input-group-alternative mb-4">
                            <span class="input-group-text">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/rascacielos.png')}}" alt="">
                            </span>
                            <input class="form-control" type="text"  id="fecha_curso" name="fecha_curso" required>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 form-group ">
                            <label for="">Monto *</label>
                            <div class="input-group input-group-alternative mb-4">
                            <span class="input-group-text">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/bolsa-de-dinero.png')}}" alt="">
                            </span>

                            <input class="form-control" type="number"  id="fecha_curso" name="fecha_curso" required>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 form-group ">
                            <label for="">¿Compraste Distribucion? *</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioNo" id="flexRadioDefault1" value="No" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    No
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioSi" id="flexRadioDefault2" value="Si">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Si
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 form-group ">
                            <label for="">Sugerencia</label>
                            <div class="input-group input-group-alternative mb-4">
                            <span class="input-group-text">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="">
                            </span>

                            <textarea class="form-control" cols="10" rows="2"  id="comentario_cliente" name="comentario_cliente"></textarea>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 form-group ">
                            <button type="submit" class="btn_save_profile btn-lg" style="border: solid 0px;">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

</section>

@endsection

@section('js')

@endsection


