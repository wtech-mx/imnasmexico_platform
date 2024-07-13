@extends('layouts.app_cosmika')

@section('template_title')
Registro Bienvenida
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/perfil_cosmika.css')}}" rel="stylesheet" />
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

<section class="primario bg_overley" style="background-color:#E1D7E6;" id="contenido">

    <div class="row space_newprofile" style="">

        <div class="col-12 mt-5">
            <div class="card_single_horizon">
                <div class="d-flex justify-content-between">
                    <h3 class="title_curso mb-3" style="color:#2D2034">Registro Bienvenida</h3>
                    <img class="icon_nav_course" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                </div>
                <form   method="POST" action="{{ route('registro_llegada.store') }}" enctype="multipart/form-data" role="form" >
                    @csrf
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
                            <input class="form-control" type="number"  id="telefono" name="telefono" required>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 form-group ">
                            <label for="">Correo *</label>
                            <div class="input-group input-group-alternative mb-4">
                            <span class="input-group-text">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/email.png')}}" alt="">
                            </span>
                            <input class="form-control" type="email"  id="correo" name="correo" required>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 form-group ">
                            <label for="">Ciudad *</label>
                            <div class="input-group input-group-alternative mb-4">
                            <span class="input-group-text">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/rascacielos.png')}}" alt="">
                            </span>
                            <input class="form-control" type="text"  id="ciudad" name="ciudad" required>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 form-group ">
                            <label for="">¿Como te enteraste? *</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadio" id="flexRadioFacebook" value="Facebook" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Facebook
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadio" id="flexRadioInstagram" value="Instagram">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Instagram
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadio" id="flexRadioTikTok" value="TikTok">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    TikTok
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadio" id="flexRadioFamiliar" value="Familiar / Amigo">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Familiar / Amigo
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 form-group mt-3">
                            <label for="">Expectativa</label>
                            <div class="input-group input-group-alternative mb-4">
                            <span class="input-group-text">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="">
                            </span>

                            <textarea class="form-control" cols="10" rows="2" id="espectativa" name="espectativa"></textarea>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 form-group m-3">
                            <button type="submit" class="btn_save_profile btn-lg" style="border: solid 0px;background:#2D2034">
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


