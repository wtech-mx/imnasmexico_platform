<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contrato de Afiliación a Registro IMNAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://paradisus.mx/assets/css/jquery.signature.css">


  </head>
  <body>

    <style>

        body{
            background-color: #836262 ;
            padding: 30px;
        }

        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{ width: 100% !important; height: auto;}

        .tab-pane{
            padding: 15px 15px 15px 15px;
        }
        .custom_col{

        }
        .icon-bar {
        position: fixed;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        z-index: 10;
        right: 0;
        }

        .icon-bar a {
        display: block;
        text-align: center;
        padding: 16px;
        transition: all 0.3s ease;
        color: white;
        font-size: 20px;
        }

        .icon-bar a:hover {
        background-color: #000;
        }
        .content {
        margin-left: 75px;
        font-size: 30px;
        }

        .facebook {
        background: #D7819D;
        color: white;
        }

        @media only screen and (max-width: 450px) {
            .text-res {
                font-size: 12px
            }
        }
    </style>

    <section class="row">

        <div class="col-12 mb-3">
            <h3 class="text-white"> <strong>Formato de Registro para Afiliación a <br>Registro IMNAS</strong> <br><hr>
                Por favor, complete la siguiente información para completar su proceso de afiliación.
            </h3>
        </div>

        <div class="col-12">
            <div class="card p-3">
                <div class="row">
                    <div class="col-12 mt-3">
                        <form method="POST" action="{{ route('contrato.update', $user->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="row">

                                <h4 class="text-left mt-3 mb-3 mt-5" style="color: #836262;font-weight: bold;">Datos Personales del Afiliado</h4>

                                <div class="col-12 form-group mt-4 ">
                                    <label for="name">Nombre Completo: <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="name" name="name" type="text" class="form-control" value="{{$user->name}}" required>
                                    </div>
                                </div>

                                <div class="col-12 form-group mt-4 ">
                                    <label for="name">Dirección:  <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/location-pointer.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="direccion" name="direccion" type="text" class="form-control" value="{{$user->direccion}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Ciudad: <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/rascacielos.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="city" name="city" type="text" class="form-control" value="{{$user->city}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Estado: <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/mapa.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="state" name="state" type="text" class="form-control" value="{{$user->state}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Codigo Postal <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/codigo-postal.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="postcode" name="postcode" type="text" class="form-control" value="{{$user->postcode}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Pais <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/naciones-unidas.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="country" name="country" type="text" class="form-control" value="{{$user->country}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Telefono <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/ring-phone.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="telefono" name="telefono" type="text" class="form-control" value="{{$user->telefono}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4 ">
                                    <label for="name">Correo Electronico <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/email.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="email" name="email" type="email" class="form-control" value="{{$user->email}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h4 class="text-left mt-3 mb-3 mt-5" style="color: #836262;font-weight: bold;">Datos de Academia o escuela del Afiliado</h4>
                                <div class="col-12 form-group mt-4 ">
                                    <label for="name">Nombre de escuela o academa(marca, o propio) <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/aprender-en-linea.webp') }}" alt="" width="35px">
                                        </span>
                                        <input id="escuela" name="escuela" type="text" class="form-control" value="{{$user->escuela}}" required>
                                    </div>
                                </div>

                                <div class="col-12 form-group mt-4 ">
                                    <label for="name">Dirección <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/location-pointer.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="direccion_escuela" name="direccion_escuela" type="text" class="form-control" value="{{optional($escuela)->direccion_escuela}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Ciudad <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/rascacielos.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="city_escuela" name="city_escuela" type="text" class="form-control" value="{{optional($escuela)->city_escuela}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Estado <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/mapa.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="state_escuela" name="state_escuela" type="text" class="form-control" value="{{optional($escuela)->state_escuela}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Codigo Postal <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/codigo-postal.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="postcode_escuela" name="postcode_escuela" type="text" class="form-control" value="{{optional($escuela)->postcode_escuela}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Pais <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/naciones-unidas.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="country_escuela" name="country_escuela" type="text" class="form-control" value="{{optional($escuela)->country_escuela}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Telefono <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/ring-phone.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="telefono_escuela" name="telefono_escuela" type="text" class="form-control" value="{{$user->celular_casa}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4 ">
                                    <label for="name">Correo Electronico <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/email.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="email_escuela" name="email_escuela" type="email" class="form-control" value="{{$user->email}}" required>
                                    </div>
                                </div>

                                <h4 class="text-left mt-3 mb-3 mt-5" style="color: #836262;font-weight: bold;">Datos de Academia o escuela del Afiliado</h4>
                                <div class="col-12 col-md-6 col-md-4 form-group mt-4 ">
                                    <label for="name">Instagram</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/instagram.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="instagram_escuela" name="instagram_escuela" type="text" class="form-control" value="{{$user->instagram}}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-md-4 form-group mt-4 ">
                                    <label for="name">Facebook</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/facebook.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="facebook_escuela" name="facebook_escuela" type="text" class="form-control" value="{{$user->facebook}}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-md-4 form-group mt-4 ">
                                    <label for="name">Pagina web</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/web-link.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="pagina_escuela" name="pagina_escuela" type="text" class="form-control" value="{{$user->pagina_web}}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-md-4 form-group mt-4 ">
                                    <label for="name">Telefono o Whatsapp</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/whatsapp.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="telefono_escuela" name="telefono_escuela" type="text" class="form-control" value="{{$user->celular_casa}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h4 class="text-left mt-3 mb-3 mt-5" style="color: #836262;font-weight: bold;">Datos de Familiar, Conocido o Referencia</h4>
                                <div class="col-12 form-group mt-4 ">
                                    <label for="name">Nombre Completo <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="nombre_referencia" name="nombre_referencia" type="text" class="form-control" value="{{optional($escuela)->nombre_referencia}}" required>
                                    </div>
                                </div>

                                <div class="col-12 form-group mt-4 ">
                                    <label for="name">Dirección <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/location-pointer.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="direccion_referencia" name="direccion_referencia" type="text" class="form-control" value="{{optional($escuela)->direccion_referencia}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Ciudad <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/rascacielos.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="city_referencia" name="city_referencia" type="text" class="form-control" value="{{optional($escuela)->city_referencia}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Estado <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/mapa.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="state_referencia" name="state_referencia" type="text" class="form-control" value="{{optional($escuela)->state_referencia}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Codigo Postal <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/codigo-postal.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="postcode_referencia" name="postcode_referencia" type="text" class="form-control" value="{{optional($escuela)->postcode_referencia}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Pais <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/naciones-unidas.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="country_referencia" name="country_referencia" type="text" class="form-control" value="{{optional($escuela)->country_referencia}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4">
                                    <label for="name">Telefono <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/ring-phone.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="telefono_referencia" name="telefono_referencia" type="text" class="form-control" value="{{optional($escuela)->telefono_referencia}}" required>
                                    </div>
                                </div>

                                <div class="col-6 form-group mt-4 ">
                                    <label for="name">Correo Electronico <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/email.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="email_referencia" name="email_referencia" type="email" class="form-control" value="{{optional($escuela)->email_referencia}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h4 class="text-left mt-3 mb-3 mt-5" style="color: #836262;font-weight: bold;">Documentación Requerida del afiliado</h4>
                                <div class="col-6 col-md-4 col-lg-3 form-group mt-4">
                                    <label for="name">INE Frente <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/ine.png') }}" alt="" width="35px">
                                        </span>
                                        @if($documentos->ine == NULL)
                                            <input id="ine" name="ine" type="file" class="form-control" required>
                                        @else
                                            <input id="ine" name="ine" type="file" class="form-control">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 col-lg-3 form-group mt-4">
                                    <label for="name">INE Atras <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/ine.png') }}" alt="" width="35px">
                                        </span>
                                        @if($documentos->ine_atras_registro == NULL)
                                            <input id="ine_atras_registro" name="ine_atras_registro" type="file" class="form-control" required>
                                        @else
                                            <input id="ine_atras_registro" name="ine_atras_registro" type="file" class="form-control">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 col-lg-3 form-group mt-4">
                                    <label for="name">CURP <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/carta.png') }}" alt="" width="35px">
                                        </span>
                                        @if($documentos->curp == NULL)
                                            <input id="curp" name="curp" type="file" class="form-control" required>
                                        @else
                                            <input id="curp" name="curp" type="file" class="form-control">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 col-lg-3 form-group mt-4">
                                    <label for="name">Comprobante domicilio <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/contrato_g.png') }}" alt="" width="35px">
                                        </span>
                                        @if($documentos->curp == NULL)
                                            <input class="custom-file-input" id="domicilio" name="domicilio" type="file" class="form-control" required>
                                        @else
                                            <input class="custom-file-input" id="domicilio" name="domicilio" type="file" class="form-control">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 col-lg-3 form-group mt-4">
                                    <label for="name">Foto infantil del afiliado <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                        </span>
                                        @if($documentos->curp == NULL)
                                            <input id="img_infantil" name="img_infantil" type="file" class="form-control" required>
                                        @else
                                            <input id="img_infantil" name="img_infantil" type="file" class="form-control">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 col-lg-3 form-group mt-4">
                                    <label for="name">Logo de escuela / marca personal <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/imnas.webp" alt="" width="35px">
                                        </span>
                                        @if($documentos->curp == NULL)
                                            <input id="logo" name="logo" type="file" class="form-control" required>
                                        @else
                                            <input id="logo" name="logo" type="file" class="form-control">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 col-lg-3 form-group mt-4">
                                    <label for="name">Firma</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/contrato.png') }}" alt="" width="35px">
                                        </span>
                                        @if($documentos->firma == NULL)
                                            <input id="firma_escuela" name="firma_escuela" type="file" class="form-control">
                                        @else
                                            <input id="firma_escuela" name="firma_escuela" type="file" class="form-control">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h4 class="text-left mt-3 mb-3 mt-5" style="color: #836262;font-weight: bold;">Temario/plan de estudios para tira de materias (6 subtemas como minimo, 12 subtemas como maximo por especialidad)</h4>
                                <div class="col-12 form-group mt-4 ">
                                    <label for="name">Especialidad <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/clase.webp') }}" alt="" width="35px">
                                        </span>
                                        <input id="especialidad" name="especialidad" type="text" class="form-control" value="{{$idMateria->especialidad}}" required>
                                    </div>
                                </div>

                                @for ($i = 1; $i <= 12; $i++)
                                    @php
                                        // Obtener el subtema correspondiente si existe
                                        $subtema = $subtemas->skip($i - 1)->first();
                                    @endphp

                                    <div class="col-12 form-group mt-4 ">
                                        <label for="name">Subtema {{ $i }}
                                            @if($i <= 6)
                                                <b style="color: #f80909;">*</b>
                                            @endif
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/aprender-en-linea-1.webp') }}" alt="" width="35px">
                                            </span>

                                            <input id="subtema_{{ $i }}" name="subtema_{{ $i }}" type="text" class="form-control"
                                            value="{{ $subtema ? $subtema->subtema : '' }}"
                                            @if($i <= 6) required @endif>
                                        </div>
                                    </div>


                                @endfor
                            </div>

                            @if($documentos->firma == NULL)
                                <div class="col-6">
                                    <div id="sig"></div>
                                    <textarea id="signed" name="signed" style="display: none"></textarea>
                                    <h6 class="text-left mt-3 mb-3">Nombre: <br>
                                        {{ $user->name}}
                                    </h6>
                                    <button id="clear" class="btn btn-sm btn-danger ">Repetir</button>
                                </div>
                            @else
                                <img src="{{asset('documentos/'. $user->telefono . '/' .$documentos->firma) }}" alt="" width="30%">
                            @endif


                            <div class="row mt-4">
                                <div class="col-12">
                                    @if ($idMateria->especialidad == NULL)
                                        <button class="btn btn-success mt-3" type="submit"  style=""><img src="{{ asset('assets/user/icons/salvar.png') }}" alt="" width="35px">  Guardar</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="https://paradisus.mx/assets/js/jquery.signature.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>



	<script type="text/javascript" class="init">

        $(document).ready(function(){
            $('#example').DataTable();
            $('#historial').DataTable();

            var sig = $('#sig').signature({syncField: '#signed', syncFormat: 'PNG'});

            $('#clear').click(function (e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signed").val('');
            });

        });

    </script>

  </body>
</html>
